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
            $this->validarReglasFechaInsertar($request->txtFechaInicio, $request->txtFechaFin);

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
            $request->IdProgramacion = $id;
            $oProgramacion      = $this->fillFromRequest($request);
            $this->validarReglas($oProgramacion);

            // Obtener tiempo promedio de atencion por servicio
            $resultados = EspecialidadCE::SeleccionarPorIdServicio($oProgramacion->IdServicio);
            if(count($resultados)>0)
            {
                $oProgramacion->TiempoPromedioAtencion = $resultados[0]->TiempoPromedioAtencion;
            }

            // Guardar (Dar formato a la fecha)
            $oProgramacion->save();
            $this->agregarAuditoria($oProgramacion, "M", $request->txtNombreMedico);

            DB::commit();
            return imprimeJSON(true, "Actualizado correctamente", null);
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

    public function validarReglasFechaInsertar($fechaInicioString, $fechaFinString)
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
        $oProgramacion = ($request->IdProgramacion != null)?ProgramacionMedica::find($request->IdProgramacion):new ProgramacionMedica();
        $oProgramacion->IdMedico = $request->txtIdMedico;
        $oProgramacion->IdDepartamento = $request->cmbIdDepartamento;

        // Convertir fecha a formato d-m-Y
        if($request->IdProgramacion == null)
        {
            $fecha = Carbon::createFromFormat("Y-m-d", $request->txtFechaInicio);
            $oProgramacion->Fecha = $fecha->format("d-m-Y");
            $oProgramacion->FechaReg = Carbon::now();
        }

        $oProgramacion->HoraInicio = $request->txtHoraInicio;
        $oProgramacion->HoraFin = $request->txtHoraFin;
        $oProgramacion->IdTipoProgramacion = $request->cmbIdTipoProgramacion;
        $oProgramacion->Descripcion = $request->txtDescripcion;
        $oProgramacion->IdTurno = $request->cmbIdTurno;
        $oProgramacion->IdEspecialidad = $request->cmbIdEspecialidad;
        $oProgramacion->Color  = ''.hexdec(ltrim($request->txtColor, "#"));
        $oProgramacion->IdServicio = $request->cmbIdServicio;
        $oProgramacion->IdTipoServicio = $request->cmbIdTipoServicio;
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

        if($oProgramacion->IdProgramacion == null)
        {
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
        }
        else
        {
            // Verificar que hora inicio no sea menor a la hora de fin
            $horaInicio = Carbon::createFromTimeString($oProgramacion->HoraInicio);
            $horaFin = Carbon::createFromTimeString($oProgramacion->HoraFin);
            $segundos = $horaInicio->diffInSeconds($horaFin, false);

            if($segundos<0)
            {
                throw new \Exception("La hora de fin debe estar dentro del rango {$oProgramacion->HoraInicio} - 23:59");
            }

            // Verificar que el medico para esa fecha y hora de inicio - fin no este programado (para este u otro servicio) (Sin considerar este)
            $idMedico = $oProgramacion->IdMedico;
            $fecha = $oProgramacion->Fecha;
            $horaInicio = $oProgramacion->HoraInicio;
            $horaFin = $oProgramacion->HoraFin;
            $programaciones = ProgramacionMedica::SeleccionarPorMedicoFechaHoraOtrosServicios($idMedico, $fecha, $horaInicio, $horaFin, $oProgramacion->IdServicio);

            if(count($programaciones)>0)
            {
                $servicio = Servicios::find($programaciones[0]->IdServicio);
                throw new \Exception("El médico ya ha sido programado para '{$servicio->Nombre}' para la FECHA/HORA indicada.");
            }
        }

    }

    public function show($id)
    {
        $oProgramacion = ProgramacionMedica::find($id);
        $oProgramacion->Fecha = str_replace(" 00:00:00.000", "", $oProgramacion->Fecha);
        //$oProgramacion->Color = "#".dechex($oProgramacion->Color);
        $oProgramacion->NombreMedico = Medicos::getNombreMedico($oProgramacion->IdMedico);

        // Agregar datos de color la objeto $oProgramacion

        $oProgramacion->color_red = floor($oProgramacion->Color / (256 * 256));
        $oProgramacion->color_green = floor($oProgramacion->Color / 256) % 256;
        $oProgramacion->color_blue = $oProgramacion->Color % 256;

        $oProgramacion->color_red = str_pad(dechex($oProgramacion->color_red), 2, "0", STR_PAD_LEFT);
        $oProgramacion->color_green = str_pad(dechex($oProgramacion->color_green), 2, "0", STR_PAD_LEFT);
        $oProgramacion->color_blue = str_pad(dechex($oProgramacion->color_blue), 2, "0", STR_PAD_LEFT);

        $oProgramacion->Color = "#".$oProgramacion->color_red.$oProgramacion->color_green.$oProgramacion->color_blue;

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

    private function getProgramacionMesAPI($idMedico, $mes, $anio)
    {
        try
        {
            $datos = ProgramacionMedica::getProgramacionMesSmall($idMedico, $mes, $anio);
            $respuesta = Array();
            // Cargar fechas
            for($i = 0; $i<count($datos); $i++)
            {
                $bandera = false;
                for($j = 0; $j<count($respuesta); $j++)
                {
                    if($datos[$i]["Fecha"] == $respuesta[$j]["Fecha"])
                    {
                        $respuesta[$j]["Programacion"][]    = $datos[$i]->descripcion;
                        $respuesta[$j]["Resumen"]          .= ", ".$datos[$i]->descripcion;

                        $bandera = true;
                        break;
                    }
                }

                if($bandera == false)
                {
                    $respuesta[] = ["Fecha" => $datos[$i]->Fecha, "dia" => $datos[$i]->dia];
                    $index = (count($respuesta)==0)?0:count($respuesta)-1;
                    $respuesta[$index]["Programacion"] = [$datos[$i]->descripcion];
                    $respuesta[$index]["Resumen"] = $datos[$i]->descripcion;
                }
            }

            return $respuesta;
        }
        catch (\Exception $e)
        {
            return imprimeJSON(false, $e->getMessage());
        }

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
        $cmbIdTipoServicio = TiposServicio::SeleccionarProgramacionTurno();
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
        $data["Fecha"] = date("Y-m-d");

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

    private function getCalendarioAPI($fecha )
    {

        $cantidadFormato = 42;

        $totalDias = date('t', strtotime($fecha) );

        $mesActual = date('m', strtotime($fecha) );

        $anioActual = date('Y', strtotime($fecha) );

        $diaActual = date('d', strtotime($fecha) );

        $numeroPrimerDia = date('N', strtotime($fecha) );

        //crear dias del mes especifico
        $diasArray = [1=>'Lunes', 2=>'Martes', 3=>'Miércoles', 4=>'Jueves', 5=>'Viernes', 6=>'Sábado', 7=>'Domingo'];

        $mesArray = [];
        $numDiaTmp = (int) $numeroPrimerDia;
        $indexDiaTmp = $numeroPrimerDia;
        for ($i=1; $i <=$totalDias ; $i++)
        {
            $oMes['index'] = (int) $indexDiaTmp;
            $oMes['dia'] = $i;
            $oMes['numero_dia'] = $numDiaTmp;
            $oMes['nombre_dia'] = $diasArray[$numDiaTmp];
            $oMes['valido'] = true;
            array_push($mesArray, $oMes);
            $numDiaTmp = $numDiaTmp < 7? $numDiaTmp+1:  1;
            $indexDiaTmp++;
        }

        // completar dias anteriores
        $cantDiasAntes = $numeroPrimerDia - 1;
        $numDiaAntesTmp = 1;
        $diasAntes = [];
        for ($i=1; $i <= $cantDiasAntes; $i++) {
            $oMes = [
                'index' => $i,
                'dia' => 0,
                'numero_dia' => $numDiaAntesTmp,
                'nombre_dia' => $diasArray[$numDiaAntesTmp],
                'valido' => false,
            ];
            $numDiaAntesTmp++;
            array_push($diasAntes, $oMes);
        }

        //completar dias posteriores
        $cantDiasDespues = $cantidadFormato - ($numeroPrimerDia-1 + $totalDias);
        $numDiaDespuesTmp = $numDiaTmp;
        $diasDespues = [];
        $indexDiaDespuesTmp = $cantidadFormato - ($cantDiasDespues-1);
        for ($i=1; $i <= $cantDiasDespues; $i++) {
            $oMes = [
                'index' => $indexDiaDespuesTmp,
                'dia' => 0,
                'numero_dia' => $numDiaDespuesTmp,
                'nombre_dia' => $diasArray[$numDiaDespuesTmp],
                'valido' => false,
            ];
            $numDiaDespuesTmp = $numDiaDespuesTmp < 7? $numDiaDespuesTmp+1:  1;
            $indexDiaDespuesTmp++;
            array_push($diasDespues, $oMes);
        }


        $diasMes = array_merge($diasAntes, $mesArray, $diasDespues );

        $data = [
            'total_dias' => $totalDias,
            'mes_actual' =>  $mesActual,
            'anio_actual' => $anioActual,
            'dia_actual' => $diaActual,
            'sistema_fecha_actual' => Carbon::now()->format("Y-m-d"),
            'sistema_dia_actual' => Carbon::now()->format("d"),
            'sistema_mes_actual' => Carbon::now()->format("m"),
            'sistema_anio_actual' => Carbon::now()->format("Y"),
            'dias' => $diasMes,
        ];

        return $data;
    }

    public function puedeModificarse($IdProgramacion)
    {
        try
        {
            $oProgramacion = ProgramacionMedica::find($IdProgramacion);
            $datos = ProgramacionMedica::CitasSeleccionarPorServicioYfecha($oProgramacion->IdServicio, str_replace(" 00:00:00.000", "", $oProgramacion->Fecha));
            foreach ($datos as $dato)
            {
                if($dato->IdProgramacion == $IdProgramacion)
                {
                    throw new \Exception("No se puede modificar o eliminar porque ya existe un paciente con CITA");
                }
            }
            return imprimeJSON(true);
        }
        catch (\Exception $e)
        {
            return imprimeJSON(false, $e->getMessage());
        }
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
                    $fecha = $request->Fecha;
                    return $this->getProgramacionDiaAPI($IdMedico, $fecha);
                }
                break;
            case 'cargarProgramacionMes':
                {
                    $IdMedico = $request->IdMedico;
                    $mes = $request->mes;
                    $anio = $request->anio;
                    return $this->getProgramacionMesAPI($IdMedico, $mes, $anio);
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
            case 'getCalendario':
                {
                    $fecha = $request->Fecha;
                    return $this->getCalendarioAPI($fecha);
                }
                break;
            case 'puedeModificarse':
                {
                    $IdProgramacion = $request->IdProgramacion;
                    return $this->puedeModificarse($IdProgramacion);
                }
                break;
            default:
                {
                    return null;
                }

        }
    }


}