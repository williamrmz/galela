<?php

namespace App\Http\Controllers\ProgramacionGeneral;

use App\Http\Requests\ProgramacionRequest;
use App\VB\SIGHDatos\DepartamentosHospital;
use App\VB\SIGHDatos\EspecialidadCE;
use App\VB\SIGHDatos\Especialidades;
use App\VB\SIGHDatos\Medicos;
use App\VB\SIGHDatos\ProgramacionMedica;
use App\VB\SIGHDatos\Servicios;
use App\VB\SIGHDatos\TiposProgramacion;
use App\VB\SIGHDatos\TiposServicio;
use App\VB\SIGHDatos\Turno;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProgramacionController extends Controller
{
    const PATH_VIEW = 'programacion-general.programacion.';
    private $idListItem;

    public function __construct()
    {
        $this->idListItem = 55987;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = DB::table('empleados')->select('idEmpleado as id', 'Nombres as name')->paginate(10); //test data
            return view(self::PATH_VIEW . 'partials.item-list', compact('items'));
        }
        return view(self::PATH_VIEW . 'index');
    }

    public function store(ProgramacionRequest $request)
    {
        try
        {
            DB::beginTransaction();

            // Validar reglas generales (Relacionadas a fecha de inicio o fin)
            $this->validarReglasGenerales($request->txtFechaInicio, $request->txtFechaFin);

            // Recorrer los dias acorde al rango de dia indicado
            $fechaInicio = Carbon::createFromFormat("Y-m-d", $request->txtFechaInicio);
            $fechaFin = Carbon::createFromFormat("Y-m-d", $request->txtFechaFin);
            $dias = $fechaInicio->diffInDays($fechaFin, false);
            for($i = 0; $i < $dias+1; $i++)
            {


                $oProgramacion      = $this->fillFromRequest($request);
                $oProgramacionTemp  = $this->generarProgramacionSiguienteDia($oProgramacion);

                if ($oProgramacionTemp != null)
                {
                    $oProgramacion->HoraFin = '23:59';
                }

                // Aplicar reglas de validacion
                $this->validarReglas($oProgramacion);
                $this->validarReglas($oProgramacionTemp);


                // Obtener tiempo promedio de atencion por servicio
                $resultados = EspecialidadCE::SeleccionarPorIdServicio($oProgramacion->IdServicio);
                if(count($resultados)>0)
                {
                    $oProgramacion->TiempoPromedioAtencion = $resultados[0]->TiempoPromedioAtencion;
                    if ($oProgramacionTemp != null) { $oProgramacionTemp->TiempoPromedioAtencion = $resultados[0]->TiempoPromedioAtencion; }
                }


                // Guardar (Dar formato a la fecha)
                $oProgramacion->save();
                $this->agregarAuditoria($oProgramacion, "A", $request->txtNombreMedico);

                if ($oProgramacionTemp != null)
                {
                    $oProgramacionTemp->save();
                    $this->agregarAuditoria($oProgramacionTemp, "A", $request->txtNombreMedico);
                }

                // Cambiar 'txtFechaInicio' del Request a la siguiente fecha
                $fechaInicio->addDay();
                $request->txtFechaInicio = $fechaInicio->format('Y-m-d');

                // Limpiar variables
                unset($oProgramacion);
                unset($oProgramacionTemp);
            }
            DB::commit();
            return imprimeJSON(true, "Registrado correctamente", null);
        } catch (\Exception $e)
        {
            DB::rollBack();
            return imprimeJSON(false, $e->getMessage());
        }
    }

    public function update(ProgramacionRequest $request, $id)
    {
        try
        {
            DB::beginTransaction();

            // Validar reglas generales (Relacionadas a fecha de inicio o fin)
            $this->validarReglasGenerales($request->txtFechaInicio, $request->txtFechaFin);

            // Recorrer los dias acorde al rango de dia indicado
            $fechaInicio = Carbon::createFromFormat("Y-m-d", $request->txtFechaInicio);
            $fechaFin = Carbon::createFromFormat("Y-m-d", $request->txtFechaFin);
            $dias = $fechaInicio->diffInDays($fechaFin, false);
            for($i = 0; $i < $dias+1; $i++)
            {


                $oProgramacion      = $this->fillFromRequest($request);
                $oProgramacionTemp  = $this->generarProgramacionSiguienteDia($oProgramacion);

                if ($oProgramacionTemp != null)
                {
                    $oProgramacion->HoraFin = '23:59';
                }

                // Aplicar reglas de validacion
                $this->validarReglas($oProgramacion);
                $this->validarReglas($oProgramacionTemp);


                // Obtener tiempo promedio de atencion por servicio
                $resultados = EspecialidadCE::SeleccionarPorIdServicio($oProgramacion->IdServicio);
                if(count($resultados)>0)
                {
                    $oProgramacion->TiempoPromedioAtencion = $resultados[0]->TiempoPromedioAtencion;
                    if ($oProgramacionTemp != null) { $oProgramacionTemp->TiempoPromedioAtencion = $resultados[0]->TiempoPromedioAtencion; }
                }


                // Guardar (Dar formato a la fecha)
                $oProgramacion->save();
                $this->agregarAuditoria($oProgramacion, "A", $request->txtNombreMedico);

                if ($oProgramacionTemp != null)
                {
                    $oProgramacionTemp->save();
                    $this->agregarAuditoria($oProgramacionTemp, "A", $request->txtNombreMedico);
                }

                // Cambiar 'txtFechaInicio' del Request a la siguiente fecha
                $fechaInicio->addDay();
                $request->txtFechaInicio = $fechaInicio->format('Y-m-d');

                // Limpiar variables
                unset($oProgramacion);
                unset($oProgramacionTemp);
            }
            DB::commit();
            return imprimeJSON(true, "Registrado correctamente", null);
        } catch (\Exception $e)
        {
            DB::rollBack();
            return imprimeJSON(false, $e->getMessage());
        }
    }

    public function generarProgramacionSiguienteDia(ProgramacionMedica $oProgramacion)
    {
        // Si la hora de fin es menor a la hora de inicio, se trata de otro dia
        $horaInicio = Carbon::createFromTimeString($oProgramacion->HoraInicio);
        $horaFin = Carbon::createFromTimeString($oProgramacion->HoraFin);
        $segundos = $horaInicio->diffInSeconds($horaFin, false);

        if($segundos<0)
        {
            $oProgramacionTemp = new ProgramacionMedica();
            $oProgramacionTemp->fill($oProgramacion->toArray());
            $fechaInicio = Carbon::createFromFormat("d-m-Y", $oProgramacion->Fecha);
            $fechaInicio->addDay();
            $oProgramacionTemp->Fecha         = $fechaInicio->format('d-m-Y');
            $oProgramacionTemp->HoraInicio    = '00:00';
            $oProgramacionTemp->HoraFin       = $horaFin->format('H:i');
            return $oProgramacionTemp;
        }
        return null;
    }

    private function agregarAuditoria($oProgramacion, $accion, $valorAdicionalObs)
    {
        $servicio = Servicios::find($oProgramacion->IdServicio)->Nombre;
        $observacion = "$valorAdicionalObs {$oProgramacion->IdServicio} = $servicio {$oProgramacion->Fecha}";
        AuditoriaAgregarVGood($accion, $oProgramacion->IdProgramacion, $oProgramacion->getTable(), $this->idListItem, $observacion);
    }

    public function validarReglasGenerales($fechaInicioString, $fechaFinString)
    {
        // Verificar que fecha inicio sea fecha actual
        $fechaInicio = Carbon::createFromFormat("Y-m-d", $fechaInicioString);
        $fechaActual = Carbon::now();
        $dias = $fechaActual->diffInDays($fechaInicio, false);

        if($dias<0)
        {
            throw new \Exception("Solo puede programarse para fechas mayores o iguales al: ".date('d-m-Y'));
        }

        // Validar que fecha inicio no sea menor a fecha fin
        $fechaInicio = Carbon::createFromFormat("Y-m-d", $fechaInicioString);
        $fechaFin = Carbon::createFromFormat("Y-m-d", $fechaFinString);
        $dias = $fechaInicio->diffInDays($fechaFin, false);

        if($dias<0)
        {
            throw new \Exception("La fecha de fin no puede ser menor que la fecha de inicio");
        }
    }

    private function fillFromRequest($request)
    {
        $oProgramacion = new ProgramacionMedica();
        $oProgramacion->IdMedico = $request->txtIdMedico;
        $oProgramacion->IdDepartamento = $request->cmbIdDepartamento;

        // Convertir fecha a formato d-m-Y
        $fecha = Carbon::createFromFormat("Y-m-d", $request->txtFechaInicio);
        $oProgramacion->Fecha = $fecha->format("d-m-Y");
        $oProgramacion->HoraInicio = $request->txtHoraInicio;
        $oProgramacion->HoraFin = $request->txtHoraFin;
        $oProgramacion->IdTipoProgramacion = $request->cmbIdTipoProgramacion;
        $oProgramacion->Descripcion = $request->txtDescripción;
        $oProgramacion->IdTurno = $request->cmbIdTurno;
        $oProgramacion->IdEspecialidad = $request->cmbIdEspecialidad;

        // Convertir color a decimal
        /*
            $item->color_blue = floor($item->Color / (256 * 256));
            $item->color_green = floor($item->Color / 256) % 256;
            $item->color_red = $item->Color % 256;
         */
        $oProgramacion->Color  = ''.hexdec(ltrim($request->txtColor, "#"));
        $oProgramacion->IdServicio = $request->cmbIdServicio;
        $oProgramacion->IdTipoServicio = $request->cmbIdTipoServicio;
        $oProgramacion->FechaReg = Carbon::now();
        $oProgramacion->TiempoPromedioAtencion = 0;
        return $oProgramacion;
    }


    public function validarReglas($oProgramacion)
    {
        if($oProgramacion == null ) { return; }

        // Verificar que hora de inicio no sea igual a la hora de fin
        if($oProgramacion->HoraInicio == $oProgramacion->HoraFin)
        {
            throw new \Exception("La hora de inicio y fin no pueden ser iguales");
        }

        // Verificar que el medico para esa fecha y hora de inicio - fin no este programado (para este u otro servicio)
        $idMedico = $oProgramacion->IdMedico;
        $fecha = $oProgramacion->Fecha;
        $horaInicio = $oProgramacion->HoraInicio;
        $horaFin = $oProgramacion->HoraFin;
        $programaciones = ProgramacionMedica::SeleccionarPorMedicoFechaHora($idMedico, $fecha, $horaInicio, $horaFin);

        if(count($programaciones)>0)
        {
            $servicio = Servicios::find($programaciones[0]->IdServicio);
            throw new \Exception("El médico ya ha sido programado para '{$servicio->Nombre}' para la FECHA/HORA indicada.");
        }


        /*

        ----------------------------------- logica para modificar
        Verificar que la hora de fin no sea menor a la hora inicio (y sea dentro del mismo día)
                $horaInicio = Carbon::createFromTimeString($this->oProgramacion->HoraInicio);
        $horaFin = Carbon::createFromTimeString($this->oProgramacion->HoraFin);
        $segundos = $horaInicio->diffInSeconds($horaFin, false);

        if($segundos<0)
        {
            if($this->oProgramacion->HoraFin!='00:00')
            {
                throw new \Exception("La hora de fin debe estar dentro del rango {$this->oProgramacion->HoraInicio} - 00:00");
            }
            else
            {
                $this->oProgramacion->HoraFin = "23:59";
            }
        }
        -------------------------------------------------------------------------------------------------------------------

         */





        // El servicio puede

        // :: FALTA: HACER CAMBIOS PARA MODIFICAR ::

    }

    public function show($id)
    {
        $oProgramacion = ProgramacionMedica::find($id);
        $oProgramacion->Fecha = rtrim($oProgramacion->Fecha, " 00:00:00.000");
        $oProgramacion->Color = "#".dechex($oProgramacion->Color);
        $oProgramacion->NombreMedico = Medicos::getNombreMedico($oProgramacion->IdMedico);

        $data = $this->getDataFormsAPI($oProgramacion->IdMedico);
        $data["programacion"] = $oProgramacion;
        $data["fcmbIdDepartamento"] = $this->getDataDepartamentoAPI();
        $data["fcmbIdEspecialidad"] = $this->getDataEspecialidadesAPI($oProgramacion->IdDepartamento);
        $data["fcmbIdMedico"] = $this->getMedicosAPI($oProgramacion->IdDepartamento, $oProgramacion->IdEspecialidad);
        $data["cmbIdServicio"] = $this->getServiciosAPI($oProgramacion->IdEspecialidad);
        $data["cmbIdTurno"] = $this->getTurnosAPI($oProgramacion->IdTipoServicio);

        return $data;
    }

    public function destroy(Request $request, $id)
    {
        try
        {
            DB::beginTransaction();

            $oProgramacion = ProgramacionMedica::find($id);
            $oProgramacion->delete();

            // Agregar auditoria
            $this->agregarAuditoria($oProgramacion, "E", $request->txtNombreMedico);

            DB::commit();
            return imprimeJSON(true, "Eliminado correctamente", null);
        }
        catch (\Exception $e)
        {
            return imprimeJSON(false, "No es posible eliminar, se está utilizando la programación en otros módulos del sistema.");
        }

    }

    private function getDataDepartamentoAPI()
    {
        // Departamentos
        $cmbIdDepartamento = DepartamentosHospital::SeleccionarTodos();
        foreach ($cmbIdDepartamento as $row) {
            $row->id = $row->IdDepartamento;
            $row->text = $row->DescripcionLarga;
        }
        return $cmbIdDepartamento;
    }

    private function getDataEspecialidadesAPI($idDep)
    {
        // Especialidades
        $cmbIdEspecialidad = Especialidades::SeleccionarPorDepartamento($idDep);
        foreach ($cmbIdEspecialidad as $row) {
            $row->id = $row->IdEspecialidad;
            $row->text = $row->DescripcionLarga;
        }
        return $cmbIdEspecialidad;
    }

    private function getMedicosAPI($IdDepartamento, $IdEspecialidad)
    {
        $cmbIdMedico = Medicos::FiltrarPorDptoYEspecialidad($IdDepartamento, $IdEspecialidad);
        foreach ($cmbIdMedico as $row) {
            $row->id = $row->IdMedico;
            $row->text = $row->DescripcionLarga;
        }
        return $cmbIdMedico;
    }

    private function getProgramacionDiaAPI($idMedico, $fecha)
    {
        $items = ProgramacionMedica::getProgramaciPorMedicoDia($idMedico, $fecha);
        foreach ($items as $item) {
            $item->color_red = floor($item->Color / (256 * 256));
            $item->color_green = floor($item->Color / 256) % 256;
            $item->color_blue = $item->Color % 256;
        }
        return view(self::PATH_VIEW . 'partials.item-list', compact('items'));
    }

    // 04.02.2020 LA { API }
    private function getDataFormsAPI($IdMedico)
    {

        // Tipos de programación
        $cmbIdTipoProgramacion = TiposProgramacion::SeleccionarTodos();
        foreach ($cmbIdTipoProgramacion as $row) {
            $row->id = $row->IdTipoProgramacion;
            $row->text = $row->DescripcionLarga;
        }

        // Tipos de servicio
        $cmbIdTipoServicio = TiposServicio::SeleccionarTodos();
        foreach ($cmbIdTipoServicio as $row) {
            $row->id = $row->IdTipoServicio;
            $row->text = $row->DescripcionLarga;
        }

        // Especialidad
        $cmbIdEspecialidad = Especialidades::SeleccionarPorMedico($IdMedico);
        foreach ($cmbIdEspecialidad as $row) {
            $row->id = $row->IdEspecialidad;
            $row->text = $row->DescripcionLarga;
        }

        // Retornar datos
        $data['cmbIdTipoProgramacion'] = $cmbIdTipoProgramacion;
        $data['cmbIdTipoServicio'] = $cmbIdTipoServicio;
        $data['cmbIdEspecialidad'] = $cmbIdEspecialidad;

        return $data;
    }

    public function getTurnosAPI($idTipoServicio)
    {
        $cmbIdTipoServicio = Turno::SeleccionarPorIdTipoServicio($idTipoServicio);
        foreach ($cmbIdTipoServicio as $row) {
            $row->id = $row->IdTurno;
            $row->text = $row->DescripcionLarga;
        }
        return $cmbIdTipoServicio;
    }

    public function getServiciosAPI($idEspecialidad)
    {
        $cmbIdServicio = Servicios::ServiciosSeleccionarConsultoriosPorEspecialidad($idEspecialidad);
        foreach ($cmbIdServicio as $row) {
            $row->id = $row->IdServicio;
            $row->text = $row->DescripcionLarga;
        }
        return $cmbIdServicio;
    }


    public function apiService(Request $request)
    {
        switch ($request->name) {
            case 'getDepartamentos':
                {
                    return $this->getDataDepartamentoAPI();
                }
                break;
            case 'getEspecialidades':
                {
                    $idDepartamento = $request->IdDepartamento;
                    return $this->getDataEspecialidadesAPI($idDepartamento);
                }
                break;
            case 'getMedicos':
                {
                    $idDepartamento = $request->IdDepartamento;
                    $idEspecialidad = $request->IdEspecialidad;
                    return $this->getMedicosAPI($idDepartamento, $idEspecialidad);
                }
                break;
            case 'getProgramacionDia':
                {
                    $IdMedico = $request->IdMedico;
                    $fecha = '2020-02-08';
                    return $this->getProgramacionDiaAPI($IdMedico, $fecha);
                }
                break;
            case 'getDataForms':
                {
                    $IdMedico = $request->IdMedico;
                    return $this->getDataFormsAPI($IdMedico);
                }
                break;
            case 'getTurnos':
                {
                    $idTipoServicio = $request->IdTipoServicio;
                    return $this->getTurnosAPI($idTipoServicio);
                }
                break;
            case 'getServicios':
                {
                    $idEspecialidad = $request->IdEspecialidad;
                    return $this->getServiciosAPI($idEspecialidad);
                }
                break;
            default:
                {
                    return null;
                }

        }
    }


}