<?php
namespace App\Http\Controllers\ConsultaExterna;

use App\VB\SIGHDatos\Atenciones;
use App\VB\SIGHDatos\Citas;
use App\VB\SIGHDatos\Medicos;
use App\VB\SIGHDatos\ProgramacionMedica;
use App\VB\SIGHDatos\TiposOrigenAtencion;
use App\VB\SIGHNegocios\ReglasFacturacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\VB\SIGHNegocios\ReglasDeProgramacionMedica;

class CitasAdmisionController extends Controller
{
	const PATH_VIEW = 'consulta-externa.citas-admision.';

	private $mo_AdminProgramacionMedica;

	public function __construct()
	{
		$this->mo_AdminProgramacionMedica = new ReglasDeProgramacionMedica;
	}

	public function index(Request $request)
	{
		return view(self::PATH_VIEW.'index');
	}

	public function create()
	{
		if(request()->ajax()) {
			return view(self::PATH_VIEW.'partials.item-create');
		}
	}

	public function store(Request $request)
	{
		dd('Implementar logica para el metodo store');

		if(request()->ajax()) {
			$this->validate($request, [
				'field' => 'required',
			]);

			$success = false;

			//write your code...

			return ['success' => $success];
		}
	}

	public function show($id)
	{
		if(request()->ajax()) {
			//DataFake
			$item = DB::table('empleados')->where('idEmpleado', $id)
				->select('idEmpleado as id', 'Nombres as name')->first();

			return view(self::PATH_VIEW.'partials.item-show', compact('item'));
		}
	}

	public function edit($id)
	{
		if(request()->ajax()) {
			//DataFake
			$item = DB::table('empleados')->where('idEmpleado', $id)
				->select('idEmpleado as id', 'Nombres as name')->first();

			return view(self::PATH_VIEW.'partials.item-edit', compact('item'));
		}
	}

	public function update(Request $request, $id)
	{
		dd('Implementar logica para el metodo update');

		if(request()->ajax()) {
			$this->validate($request, [
				'field' => 'required',
			]);

			$success = false;

			//write your code...

			return ['success' => $success];
		}
	}

	public function delete($id)
	{
		if(request()->ajax()) {
			//DataFake
			$item = DB::table('empleados')->where('idEmpleado', $id)
				->select('idEmpleado as id', 'Nombres as name')->first();

			return view(self::PATH_VIEW.'partials.item-delete', compact('item'));
		}
	}

	public function destroy($id)
	{
		dd('Implementar logica para el metodo destroy');

		if(request()->ajax()) {

			// $this->validate($request, [
			// 	'field' => 'required',
			// ]);

			$success = false;

			//write your code...

			return ['success' => $success];
		}
	}

	private function getConfigAPI()
	{
		$data['fecha'] = date("d-m-Y");
		$data['calendario'] = $this->getCalendarioAPI( $data['fecha'] );
		$data['servicios'] = $this->getServiciosAPI( $data['fecha'] );
		return $data;
	}

	private function getMedicosAPI($request )
	{
		return $this->getMedicosPorServicio( $request->fecha, $request->idServicio );
	}

	private function getProgramacionAPI($request )
	{
		return $this->getProgramacionPorMedico( $request->fecha, $request->idServicio, $request->idMedico );
	}

	private function getServiciosAPI($fecha )
	{
        $mes = date('m', strtotime($fecha) );
        $anio = date('Y', strtotime($fecha) );

        $servicios = ProgramacionMedica::leftJoin("Servicios", "ProgramacionMedica.IdServicio", "=", "Servicios.IdServicio")
            ->where("Servicios.IdTipoServicio", "=", "1")
            ->whereRaw("YEAR(ProgramacionMedica.Fecha) = '$anio' and MONTH(ProgramacionMedica.Fecha)='$mes'")
            ->selectRaw("DISTINCT ProgramacionMedica.IdServicio, Servicios.IdServicio, Servicios.Nombre")
            ->get();

        foreach ($servicios as $row)
        {
            $row->id = $row->IdServicio;
            $row->text = $row->id ." = ".$row->Nombre;
        }
        return $servicios;

		$query = "SELECT DISTINCT  pm.idServicio, s.nombre AS servicio,
		pm.idServicio AS id, s.nombre AS text
		FROM programacionMedica AS pm
		LEFT JOIN servicios AS s ON s.idServicio = pm.idServicio
		WHERE YEAR(pm.fecha) = :anio
		AND MONTH(pm.fecha) = :mes";

	}

	private function getMedicosPorServicio( $fecha, $idServicio = null)
	{
	    $mes = date('m', strtotime($fecha) );
	    $anio = date('Y', strtotime($fecha) );

	    $programacion = ProgramacionMedica::join("Medicos", "ProgramacionMedica.IdMedico", "=", "Medicos.IdMedico")
            ->join("Empleados", "Medicos.IdEmpleado", "=", "Empleados.IdEmpleado")
            ->where("ProgramacionMedica.idServicio", $idServicio)
            ->where("ProgramacionMedica.IdTipoServicio", "1")
            ->whereRaw("YEAR(ProgramacionMedica.fecha) = $anio and MONTH(ProgramacionMedica.fecha) = $mes")
            ->selectRaw("DISTINCT Medicos.IdMedico, Empleados.ApellidoPaterno+' '+Empleados.apellidoMaterno+' '+Empleados.nombres as medico")
            ->get();

	    return $programacion;
	}

	private function getProgramacionPorMedico( $fecha, $idServicio, $idMedico)
	{
		$query = "SELECT pm.idProgramacion, pm.fecha, DAY(pm.fecha) as dia ,
		pm.horaInicio, pm.horaFin, color, pm.tiempoPromedioAtencion
		FROM programacionMedica as pm
		WHERE YEAR(pm.fecha) = :anio
		AND MONTH(pm.fecha) = :mes
		AND pm.idServicio = :idServicio
		and pm.idMedico = :idMedico";

		$params = [
			'mes' => date('m', strtotime($fecha) ),
			'anio' => date('Y', strtotime($fecha) ),
			'idServicio' => $idServicio,
			'idMedico' => $idMedico,
		];

		$data = DB::select($query, $params);

		// Consultar citas por fecha, servicio y medico
		$query = "SELECT
		c.idCita, c.horaInicio, c.horaFin, c.horaSolicitud,
		(CONVERT(VARCHAR, c.fechaSolicitud, 101) ) AS fechaSolicitud,
		p.idPaciente, p.apellidoPaterno, p.apellidoMaterno, p.primerNombre
		FROM citas AS c
		LEFT JOIN pacientes as p on p.idPaciente = c.idPaciente
		WHERE c.fecha = :fecha
		AND idServicio = :idServicio
		AND idMedico = :idMedico
		ORDER BY c.horaInicio";

		foreach($data as $row)
		{
            $fecha = str_replace(" 00:00:00.000", "", $row->fecha);
            $fecha = Carbon::createFromFormat("Y-m-d", $fecha)->format('d-m-Y');
            $row->fecha = $fecha;

			$params = [
				'idServicio' => $idServicio,
				'fecha' => date('d-m-Y', strtotime($row->fecha) ),
				'idMedico' => $idMedico,
			];

			$row->atenciones = DB::select($query, $params);
		}

		return $data;
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

	public function getDataFormPacienteAPI()
    {
        $oPaciente = new PacienteController();
        $data = $oPaciente->getData();
        return $data;
    }

    public function getEdadPacienteAPI($fechaNacimiento)
    {
        $edad = calcularEdad($fechaNacimiento, null);
        return ['edad' => $edad];
    }

    public function getCitasAnterioresAPI($idPaciente)
    {
        try
        {
            $items = ReglasFacturacion::CitasMuestraAteriores($idPaciente);
            foreach ($items as $item)
            {
                $fecha = str_replace(" 00:00:00.000", "", $item->Fecha);
                $fecha = Carbon::createFromFormat("Y-m-d", $fecha);
                $item->Fecha = $fecha->format("d-m-Y");
                $diasDiferencia = Carbon::now()->diffInDays($fecha, false);
                $item->diasDiferencia = $diasDiferencia;
            }
            return imprimeJSON(true, "", $items);
        }
        catch (\Exception $e)
        {
            return imprimeJSON(false, $e->getMessage());
        }
    }

    public function getListaPacientesDia($idServicio, $idMedico, $fecha)
    {
        $citas = Citas::leftJoin("TiposEstadosCita", "Citas.IdEstadoCita", "=", "TiposEstadosCita.IdEstadoCita")
            ->leftJoin("Pacientes", "Citas.IdPaciente", "=", "Pacientes.IdPaciente")
            ->where("Citas.IdServicio", $idServicio)
            ->where("Citas.IdMedico", $idMedico)
            ->whereRaw("CONVERT(DATE, Citas.Fecha) = '$fecha'")
            ->orderBy("Citas.HoraInicio", "asc")
            ->select("Citas.IdAtencion", "Pacientes.IdPaciente", "Pacientes.ApellidoPaterno", "Pacientes.ApellidoMaterno", "Pacientes.PrimerNombre", "Pacientes.NroHistoriaClinica")
            ->selectRaw("Citas.IdCita, Citas.HoraInicio, Citas.HoraFin, Citas.HoraSolicitud, (CONVERT(VARCHAR, Citas.FechaSolicitud, 101) ) AS FechaSolicitud, TiposEstadosCita.Descripcion as EstadoCita")
            ->get();

        $items = $citas;
        return view(self::PATH_VIEW.'partials.item-list-pacientes-dia', compact('items'));

    }

    public function getAtencionesDiaAPI($idServicio, $idMedico, $fecha)
    {
        $programacion = ProgramacionMedica::where('IdServicio', $idServicio)->where('IdMedico', $idMedico)->whereRaw("CONVERT(DATE, Fecha) = '$fecha'")->first();
        $citas = Citas::leftJoin("TiposEstadosCita", "Citas.IdEstadoCita", "=", "TiposEstadosCita.IdEstadoCita")
            ->leftJoin("Pacientes", "Citas.IdPaciente", "=", "Pacientes.IdPaciente")
            ->where("Citas.IdServicio", $idServicio)
            ->where("Citas.IdMedico", $idMedico)
            ->whereRaw("CONVERT(DATE, Citas.Fecha) = '$fecha'")
            ->orderBy("Citas.HoraInicio", "asc")
            ->select("Citas.IdAtencion", "Pacientes.IdPaciente", "Pacientes.ApellidoPaterno", "Pacientes.ApellidoMaterno", "Pacientes.PrimerNombre", "Pacientes.NroHistoriaClinica")
            ->selectRaw("Citas.IdCita, Citas.HoraInicio, Citas.HoraFin, Citas.HoraSolicitud, (CONVERT(VARCHAR, Citas.FechaSolicitud, 101) ) AS FechaSolicitud, TiposEstadosCita.Descripcion as EstadoCita")
            ->get();

        if(empty($programacion))
        {
            $items = [];
            return view(self::PATH_VIEW.'partials.item-list-atenciones', compact('items'));
        }

        // ESTRUCTURA DE TABLA
        $HORA_INICIO    = $programacion->HoraInicio;
        $HORA_FIN       = $programacion->HoraFin;
        $min_atencion   = $programacion->TiempoPromedioAtencion;
        $min_inicio     = horasAMinunos($HORA_INICIO);
        $MIN_FIN        = horasAMinunos($HORA_FIN);
        $MIN_DIF        = $MIN_FIN - $min_inicio;
        $intervalos     = intval($MIN_DIF / $min_atencion);
        $filas          = Array();

        for($i = 0; $i<$intervalos; $i++)
        {


            $filas[$i]["nro_cita"]      = $i+1;
            $filas[$i]["hora_inicio"]   = minutosAHoras($min_inicio);
            $min_inicio                += $min_atencion;
            $filas[$i]["hora_fin"]      = minutosAHoras($min_inicio);

            $temp = $citas->where('HoraInicio', $filas[$i]["hora_inicio"]);
            $filas[$i]["cita"]      = (count($temp)>0) ? $temp->first() : null;
            $atencion = (count($temp)>0) ? collect(Atenciones::AtencionesSeleccionarPorIdAtencion($temp->first()->IdAtencion))->first() : null;
            $filas[$i]["atencion"]  = (!empty($atencion)) ? $atencion : null;
        }
        $items = $filas;

        return view(self::PATH_VIEW.'partials.item-list-atenciones', compact('items'));
    }

    public function getCombosCita($idServicio, $idMedico)
    {
        $data = Array();
        $data["cmbIdTipoReferencia"] = TiposOrigenAtencion::where("IdTipoServicio", 1)->where("Codigo", "!=", "C")->select("IdOrigenAtencion", "Codigo", "Descripcion")->get();
        foreach ($data["cmbIdTipoReferencia"] as $row)
        {
            $row->id = $row->IdOrigenAtencion;
            $row->text = $row->Codigo ." = ". $row->Descripcion;
        }

        $data["cmbIdTipoEdad"] = DB::select("EXEC TiposEdadSeleccionarTodos");
        foreach ($data["cmbIdTipoEdad"] as $row)
        {
            $row->id = $row->IdTipoEdad;
            $row->text = $row->DescripcionLarga;
        }

        $data["cmbIdTipoServicio"] = DB::select("EXEC TiposServicioSeleccionarAsistenciales");
        foreach ($data["cmbIdTipoServicio"] as $row)
        {
            $row->id = $row->IdTipoServicio;
            $row->text = $row->DescripcionLarga;
        }

        $data["cmbIdFuenteFinanciamiento"] = DB::select("EXEC FuentesFinanciamientoSegunFiltro 'UtilizadoEn=1 or UtilizadoEn=3'");
        foreach ($data["cmbIdFuenteFinanciamiento"] as $row)
        {
            $row->id = $row->IdFuenteFinanciamiento;
            $row->text = $row->IdFuenteFinanciamiento.' = '.$row->Descripcion;
        }

        // SERVICIO
        $data["cmbIdServicio"] = DB::select("select IdServicio, codigoServicioHIS, Nombre, IdEspecialidad from  Servicios where IdServicio = $idServicio");
        foreach ($data["cmbIdServicio"] as $row)
        {
            $row->id = $row->IdServicio;
            $row->text = $row->codigoServicioHIS.' = '.$row->Nombre;
        }

        // ESPECIALIDAD EN BASE AL ID DEL SERVICIO
        $idEspecialidad = $data["cmbIdServicio"][0]->IdEspecialidad ?? 0;
        $data["cmbIdEspecialidad"] = DB::select("select IdEspecialidad, Nombre from Especialidades where IdEspecialidad = $idEspecialidad");
        foreach ($data["cmbIdEspecialidad"] as $row)
        {
            $row->id = $row->IdEspecialidad;
            $row->text = $row->IdEspecialidad.' = '.$row->Nombre;
        }

        // MEDICO
        $sql = "select e.ApellidoPaterno, e.ApellidoMaterno, e.Nombres, e.CodigoPlanilla from Medicos m inner join Empleados e on m.IdEmpleado=e.IdEmpleado where m.IdMedico=$idMedico";
        $exec = DB::select($sql);
        $data["medico"] = count($exec)>0?$exec[0]:null;

        // Origen de referencia (MINSA / Otros)
        $sql = "select * from TiposReferencia";
        $data["cmbIdOrigenReferencia"] = DB::select($sql);

        foreach ($data["cmbIdOrigenReferencia"] as $row)
        {
            $row->id = $row->IdTipoReferencia;
            $row->text = $row->IdTipoReferencia.' = '.$row->Descripcion;
        }

        // Tipo de consulta
        $data["cmbIdTipoConsulta"] = DB::select("exec FactCatalogoServiciosSeleccionarTipoConsulta $idEspecialidad");
        foreach ($data["cmbIdTipoConsulta"] as $row)
        {
            $row->id = $row->IdProducto;
            $row->text = $row->Descripcion;
        }

        return $data;
    }

    function getDepartamentosAPI()
    {
        $sql = "exec DepartamentosSeleccionarTodos";
        $data = DB::select($sql);
        foreach ($data as $row)
        {
            $row->id = $row->IdDepartamento;
            $row->text = $row->DescripcionLarga;
        }
        return $data;
    }

    function getEstablecimientosAPI($idDepartamento, $nombre)
    {
        $sql = "select e.*, d.Nombre as distrito, p.Nombre as provincia, dep.Nombre as departamento ";
        $sql.= "from Establecimientos e ";
        $sql.= "inner join Distritos d on e.IdDistrito = d.IdDistrito ";
        $sql.= "inner join Provincias p on d.IdProvincia = p.IdProvincia ";
        $sql.= "inner join Departamentos dep on p.IdDepartamento = dep.IdDepartamento ";
        $sql.= "where dep.IdDepartamento = '$idDepartamento' and upper(e.Nombre) like upper('%$nombre%') ";
        $sql.= "order by e.IdDistrito asc ";

        $items = DB::select($sql);
        return view(self::PATH_VIEW.'partials.item-list-establecimientos', compact('items'));
    }

    function getTiposFinanciamiento($idFuenteFinanciamiento)
    {
        $sql = "TiposFinanciamientosTarifaSeleccionarPorPlan $idFuenteFinanciamiento";
        $items = DB::select($sql);
        foreach ($items as $row)
        {
            $row->id = $row->idTipoFinanciamiento;
            $row->text = $row->id ." ". $row->Descripcion;
        }
        return $items;
    }

    function puedeAgregarseAPI($fecha)
    {
        $fechaTarget = Carbon::createFromFormat("Y-m-d", $fecha);
        $fechaActual = Carbon::now();
        $diasDiff = $fechaActual->diffInDays($fechaTarget, false);
        $status = $diasDiff>0;
        return imprimeJSON($status, date('d-m-Y'));
    }

    // -- API
    public function apiService(Request $request)
    {
        switch($request->name)
        {
            case 'getConfig':
                return $this->getConfigAPI();
            case 'getServicios':
                return $this->getServiciosAPI( $request->fecha );
            case 'getMedicos':
                return $this->getMedicosAPI( $request );
            case 'getProgramacion':
                return $this->getProgramacionAPI( $request );
            case 'getCalendario':
                return $this->getCalendarioAPI( $request->fecha );
            case 'getData':
                return $this->getDataFormPacienteAPI();
            case 'getEdad':
                $fechaNacimiento = $request->fechaNacimiento;
                return $this->getEdadPacienteAPI($fechaNacimiento);
            case 'getCitasAnteriores':
                $idPaciente = $request->idPaciente;
                return $this->getCitasAnterioresAPI($idPaciente);
            case 'getAtencionesDia':
                $idServicio = $request->idServicio;
                $idMedico = $request->idMedico;
                $fecha = $request->fecha;
                return $this->getAtencionesDiaAPI($idServicio, $idMedico, $fecha);
            case 'getListaPacientesDias':
                $idServicio = $request->idServicio;
                $idMedico = $request->idMedico;
                $fecha = $request->fecha;
                return $this->getListaPacientesDia($idServicio, $idMedico, $fecha);
            case 'getCombosCita':
                $idServicio = empty($request->idServicio)?"0":$request->idServicio;
                $idMedico = empty($request->idMedico)?"0":$request->idMedico;
                return $this->getCombosCita($idServicio, $idMedico);
            case 'getDepartamentos':
                return $this->getDepartamentosAPI();
            case 'getEstablecimientos':
                $idDepartamento = $request->idDepartamento ?? 0;
                $nombre = $request->nombre ?? "";
                return $this->getEstablecimientosAPI($idDepartamento, $nombre);
            case 'getTiposFinanciamiento':
                $idFuenteFinanciamiento = $request->idFuenteFinanciamiento ?? 0;
                return $this->getTiposFinanciamiento($idFuenteFinanciamiento);
            case 'puedeAgregarse':
                $fecha = $request->fecha;
                return $this->puedeAgregarseAPI($fecha);
            default:
                return null;
        }
    }
}
