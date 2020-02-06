<?php
namespace App\Http\Controllers\ProgramacionGeneral;

use App\Http\Requests\ProfesionalesSaludRequest;
use App\VB\SIGHDatos\DepartamentosHospital;
use App\VB\SIGHDatos\Empleados;
use App\VB\SIGHDatos\Especialidades;
use App\VB\SIGHDatos\Medicos;
use App\VB\SIGHDatos\MedicosEspecialidad;
use App\VB\SIGHDatos\ProgramacionMedica;
use App\VB\SIGHDatos\TiposCondicionTrabajo;
use App\VB\SIGHNegocios\ReglasComunes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfesionalesSaludController extends Controller
{
    const PATH_VIEW = 'programacion-general.profesionales-salud.';

    // Variables
    private $oEmpleado;
    private $oMedico;
    private $oMedicoEspecialidad;
    private $idListItem;

    /**
     * ProfesionalesSaludController constructor.
     */
    public function __construct()
    {
        $this->idListItem = 403;
        $this->oEmpleado = new Empleados();
        $this->oMedico = new Medicos();
        $this->oMedicoEspecialidad = new MedicosEspecialidad();
    }


    // 29.01.2020 LA
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $codigoPlanilla = $request->ftxtCodPlanilla;
            $apePaterno = $request->ftxtApellidoPaterno;
            $apeMaterno = $request->ftxtApellidoMaterno;
            $nombres = $request->ftxtNombres;

            $items = Medicos::filtrarMedico($codigoPlanilla, $apePaterno, $apeMaterno, $nombres);
            return view(self::PATH_VIEW . 'partials.item-list', compact('items'));
        }
        return view(self::PATH_VIEW . 'index');
    }

    // 31.01.2020 LA
    public function show($idMedico)
    {
        $this->oMedico              = Medicos::find($idMedico);
        $this->oEmpleado            = Empleados::find($this->oMedico->IdEmpleado);
        $this->oEmpleado->DNI = trim($this->oEmpleado->DNI);
        $this->oEmpleado->FechaNacimiento = dateFormat($this->oEmpleado->FechaNacimiento, 'Y-m-d');
        $oMedicosEspecialidad  = MedicosEspecialidad::where('IdMedico', $this->oMedico->IdMedico)->get();

        $respuesta["empleado"] = $this->oEmpleado;
        $respuesta["medico"] = $this->oMedico;
        $respuesta["especialidades"] = $oMedicosEspecialidad;

        return $respuesta;
    }
    // 30.01.2020 LA
    public function store(ProfesionalesSaludRequest $request)
    {
        try
        {
            DB::beginTransaction();

            // Especialidades
            $especialidades = Array();
            foreach ($request->especialidades as $espString)
            {
                $especialidades[] = json_decode($espString);
            }

            // Cargar datos a objetos
            $this->fillFromRequest($request);

            $this->validarReglas();

            // Guardar información :: Empleado
            $tempEmpleado = new Empleados();
            $resultado = $tempEmpleado->Insertar($this->oEmpleado);
            $this->oEmpleado->IdEmpleado = $resultado->idEmpleado;

            // :: Guardar información :: Médico
            //$this->oMedico->procedencia = "PROFESIONALESSALUD";
            $this->oMedico->IdEmpleado = $this->oEmpleado->IdEmpleado;
            $this->oMedico->save();

            // :: Guardar información :: MedicosEspecialidad
            foreach ($especialidades as $especialidad)
            {
                if($especialidad->estado=='NUEVO')
                {
                    $exito = $this->insertarMedicosEspecialidad($this->oMedico->IdMedico, $especialidad->IdEspecialidad);
                    if(!$exito) { throw new \Exception("La especialidad no ha podido ser registrada."); }
                }
            }

            // Insertar registro auditoria
            AuditoriaAgregarVGood('A', $this->oMedico->IdMedico, $this->oMedico->getTable(), $this->idListItem, $this->oEmpleado->nombre_completo);

            DB::commit();
            return imprimeJSON(true, "Registrado correctamente", null);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return imprimeJSON(false, $e->getMessage());
        }
    }

    // 31.01.2020 LA
    public function update(ProfesionalesSaludRequest $request, $id)
    {
        try
        {
            DB::beginTransaction();

            // 1. Cargar datos medico desde DB
            $this->oMedico = Medicos::find($id);
            // 2. Cargar datos empleado desde DB
            $this->oEmpleado = Empleados::find($this->oMedico->IdEmpleado);

            // 3. Reemplazar datos con los del request (datos enviados desde la vista)
            $this->fillFromRequest($request);

            // 4. Validar reglas ::
            $this->validarReglas();

            // 6. Guardar cambios empleado, medico y (eliminar especialidad y registrarlas nuevamente)
            unset($this->oEmpleado->procedencia);
            $this->oEmpleado->FechaNacimiento .= " 00:00:00.000";
            $this->oEmpleado->save();
            $this->oMedico->save();

            MedicosEspecialidad::where('IdMedico', $this->oMedico->IdMedico)->delete();

            $especialidades = Array();
            foreach ($request->especialidades as $espString)
            {
                $especialidades[] = json_decode($espString);
            }

            foreach ($especialidades as $especialidad)
            {
                if($especialidad->estado=='NUEVO')
                {
                    $exito = $this->insertarMedicosEspecialidad($this->oMedico->IdMedico, $especialidad->IdEspecialidad);
                    if(!$exito) { throw new \Exception("La especialidad no ha podido ser registrada."); }
                }
            }

            AuditoriaAgregarVGood('M', $this->oMedico->IdMedico, $this->oMedico->getTable(), $this->idListItem, $this->oEmpleado->nombre_completo);


            DB::commit();
            return imprimeJSON(true, "Actualizado correctamente", null);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return imprimeJSON(false, $e->getMessage());
        }
    }

    private function fillFromRequest($request)
    {
        // Cargar datos a empleado
        $this->oEmpleado->procedencia           = "PROFESIONALESSALUD";
        $this->oEmpleado->IdEmpleado            = ($this->oEmpleado->IdEmpleado!=null)?$this->oEmpleado->IdEmpleado:0;
        $this->oEmpleado->idTipoDocumento       = $request->cmbIdDocIdentidad;
        $this->oEmpleado->DNI                   = $request->txtNroDocumento;
        $this->oEmpleado->ApellidoPaterno       = $request->txtApellidoPaterno;
        $this->oEmpleado->ApellidoMaterno       = $request->txtApellidoMaterno;
        $this->oEmpleado->Nombres               = $request->txtNombres;
        $this->oEmpleado->IdCondicionTrabajo    = $request->cmbIdCondicionTrabajo;
        $this->oEmpleado->IdTipoEmpleado        = $request->cmbIdTipoEmpleado;
        $this->oEmpleado->FechaNacimiento       = $request->txtFechaNacimiento;
        $this->oEmpleado->CodigoPlanilla        = $request->txtCodigoPlanilla;
        $this->oEmpleado->idTipoDestacado       = $request->cmbIdDestacado;
        $this->oEmpleado->idSupervisor          = $request->cmbIdSupervisor;

        // Cargar datos a medico
        $this->oMedico->Colegiatura = $request->txtColegiatura;
        $this->oMedico->LoteHIS = $request->txtLote;
        $this->oMedico->idColegioHIS = $request->cmbIdColegio;

        //Cargar datos de MedicoEspecialidad
        $this->oMedicoEspecialidad->IdEspecialidad = $request->cmbIdEspecialidad;
    }

    // 31.01.2020 LA
    public function destroy($id)
    {
        try
        {
            DB::beginTransaction();

            // 1. Consultar que no tenga atenciones
            $programacion = ProgramacionMedica::programacionPorMedico($id);
            if(count($programacion)>0)
            {
                throw new \Exception("No se puede eliminar el médico dado que tiene programaciones médicas, debe eliminar antes las programaciones y luego eliminar el médico.");
            }

            // 2. Eliminar (1. MedicosEspecialidad, 2. Medico, 3. Empleado)
            MedicosEspecialidad::where('IdMedico', $id)->delete();
            $this->oMedico = Medicos::find($id);
            $this->oMedico->delete();
            $this->oEmpleado = Empleados::find($this->oMedico->IdEmpleado);
            $this->oEmpleado->delete();

            // 3. Registrar auditoria
            AuditoriaAgregarVGood('E', $this->oMedico->IdMedico, $this->oMedico->getTable(), $this->idListItem, $this->oEmpleado->nombre_completo);

            DB::commit();
            return imprimeJSON(true, "Registrado correctamente", null);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return imprimeJSON(false, $e->getMessage());
        }
    }

    private function insertarMedicosEspecialidad($idMedico, $idEspecialidad)
    {
        $oMedicoEspecialidad = new MedicosEspecialidad();
        $oMedicoEspecialidad->IdMedico = $idMedico;
        $oMedicoEspecialidad->IdEspecialidad = $idEspecialidad;
        return $oMedicoEspecialidad->save();
    }




    private function validarReglas()
    {
        // :: Reglas que aplican para cualquier operacion
        // Validar que tipo de empleado se programe
        if(!ReglasComunes::TiposEmpleadosSeleccionarSiSeProgramaPorId($this->oEmpleado->IdTipoEmpleado))
        {
            throw new \Exception("El tipo de empleado no se programa. Para registrarlo utilice el módulo de EMPLEADOS.");
        }

        // :: Reglas que aplican solo para registrar
        if($this->oEmpleado->IdEmpleado == 0 || $this->oEmpleado->IdEmpleado == null)
        {
            // Validar código de planilla e ID de empleados (El SP en realidad busca el empleado por ID & Codigo
            if(count(ReglasComunes::EmpleadosObtenerConElMismoCodigoPlanillaGood($this->oEmpleado->IdEmpleado, $this->oEmpleado->CodigoPlanilla))>0)
            {
                throw new \Exception("Ya existe un empleado con el mismo código de planilla.");
            }

            // Verificar que colegiatura no se repita
            $datos = ReglasComunes::EmpleadosObtenerConLaMismaColegiatura($this->oMedico->Colegiatura);
            if(count($datos)>0)
            {
                $mensaje = "Ese número de colegiatura ya está registrado para: {$datos[0]->ApellidoPaterno} {$datos[0]->ApellidoMaterno} {$datos[0]->Nombres}";
                throw new \Exception($mensaje);
            }

            // Verificar que el DNI no esté registrado
            $datos = ReglasComunes::EmpleadosObtenerConelMismoDNIGood($this->oEmpleado->DNI, $this->oEmpleado->idTipoDocumento);
            if(count($datos)>0)
            {
                $mensaje = "Ese NRO. DOCUMENTO. ya está registrado para: {$datos[0]->ApellidoPaterno} {$datos[0]->ApellidoMaterno} {$datos[0]->Nombres}";
                throw new \Exception($mensaje);
            }

        }
        else
        {
            // Verificar codigo planilla no se repita
            $datos = Empleados::whereTrim("CodigoPlanilla", $this->oEmpleado->CodigoPlanilla)
                ->where('IdEmpleado', '!=', $this->oEmpleado->IdEmpleado)->first();
            if($datos)
            {
                throw new \Exception("Ya existe un empleado con el mismo código de planilla.");
            }

            // Verificar que colegiatura no se repita
            $datos = Medicos::whereTrim("Colegiatura", $this->oMedico->Colegiatura)
                ->where('IdEmpleado', '!=', $this->oEmpleado->IdEmpleado)->first();
            if($datos)
            {
                $mensaje = "Ese número de colegiatura ya está registrado para: ".Empleados::find($datos->IdEmpleado)->nombre_completo;
                throw new \Exception($mensaje);
            }

            // Verificar que el DNI no esté registrado
            $datos = Empleados::whereTrim("DNI", $this->oEmpleado->DNI)
                ->where('IdEmpleado', '!=', $this->oEmpleado->IdEmpleado)->first();
            if($datos)
            {
                $mensaje = "Ese NRO. DOCUMENTO. ya está registrado para: ".$datos->nombre_completo;
                throw new \Exception($mensaje);
            }

        }

    }
    // 30.01.2020 LA { API }
    private function getDataFormsAPI()
    {
        $oReglasComunes = new ReglasComunes();

        // Documentos de identidad
        $cmbIdDocIdentidad = $oReglasComunes->TiposDocIdentidadSeleccionarTodos();
        foreach ($cmbIdDocIdentidad as $row)
        {
            $row->id = $row->IdDocIdentidad;
            $row->text = $row->DescripcionLarga;
        }

        // Condicion de trabajo
        $oCondTrabajo = new TiposCondicionTrabajo();
        $cmbIdCondicionTrabajo = $oCondTrabajo->SeleccionarTodos();
        foreach ($cmbIdCondicionTrabajo as $row)
        {
            $row->id = $row->IdCondicionTrabajo;
            $row->text = $row->DescripcionLarga;
        }

        // Tipo de empleado
        $cmbIdTipoEmpleado = $oReglasComunes->TiposEmpleadosSeleccionarSegunFiltro('where esProgramado=1');
        foreach ($cmbIdTipoEmpleado as $row)
        {
            $row->id = $row->IdTipoEmpleado;
            $row->text = $row->DescripcionLarga;
        }

        // Tipo destacado
        $cmbIdDestacado = $oReglasComunes->TiposDestacadosSeleccionarTodos();
        foreach ($cmbIdDestacado as $row)
        {
            $row->id = $row->idDestacado;
            $row->text = $row->Destacado;
        }

        // Colegio profesional
        $cmbColegio = $oReglasComunes->ColegiosHISseleccionarTodos();
        foreach ($cmbColegio as $row)
        {
            $row->id = $row->cod_col;
            $row->text = $row->des_col;
        }

        // Departamentos (salud)
        $cmbIdDepartamento = DepartamentosHospital::SeleccionarTodos();
        foreach ($cmbIdDepartamento as $row)
        {
            $row->id = $row->IdDepartamento;
            $row->text = $row->DescripcionLarga;
        }

        $data['cmbIdDocIdentidad'] = $cmbIdDocIdentidad;
        $data['cmbIdCondicionTrabajo'] = $cmbIdCondicionTrabajo;
        $data['cmbIdTipoEmpleado'] = $cmbIdTipoEmpleado;
        $data['cmbIdDestacado'] = $cmbIdDestacado;
        $data['cmbIdColegio'] = $cmbColegio;
        $data['cmbIdDepartamento'] = $cmbIdDepartamento;

        return $data;
    }

    // 30.01.2020 LA
    public function getEspecialidadesAPI(Request $request)
    {
        $idDepartamento = $request->IdDepartamento;
        $cmbIdEspecialidad = Especialidades::SeleccionarPorDepartamento($idDepartamento);

        foreach ($cmbIdEspecialidad as $row)
        {
            $row->id = $row->IdEspecialidad;
            $row->text = $row->DescripcionLarga;
        }

        return $cmbIdEspecialidad;
    }

    // 31.01.2020
    public function getEmpleadosPorCoincidencia(Request $request)
    {
        $termino = $request->term;
        $cmbIdSupervisor = Empleados::select('IdEmpleado', 'ApellidoPaterno', 'ApellidoMaterno', 'Nombres')
            ->whereLike('ApellidoPaterno', $termino)->whereLike('ApellidoMaterno', $termino)->whereLike('Nombres', $termino)->get();
        foreach ($cmbIdSupervisor as $row)
        {
            $row->id = $row->IdEmpleado;
            $row->text = $row->nombre_completo;
        }
        return $cmbIdSupervisor;
    }

    // 30.01.2020 LA
    public function apiService(Request $request)
    {
        switch ($request->name)
        {
            case 'getDataForms':
                {
                    return $this->getDataFormsAPI();
                } break;
            case 'getEspecialidades':
                {
                    return $this->getEspecialidadesAPI($request);
                } break;
            case 'getEmpleadosCoincidencia':
                {
                    return $this->getEmpleadosPorCoincidencia($request);
                } break;
            default:
                {
                    return null;
                }

        }
    }

}