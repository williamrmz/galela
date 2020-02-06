<?php
namespace App\Http\Controllers\ConsultaExterna;

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


		if($request->ajax()) {

			$this->inicializar();

			$items = DB::table('empleados')->select('idEmpleado as id', 'Nombres as name')->paginate(10); //test data
			return view(self::PATH_VIEW.'partials.item-list', compact('items'));
		}

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

	public function inicializar()
	{
		// 'mgaray20141014
		// $cmbMedicos = $this->cargarMedicos(0, 0);
		// dd( $cmbMedicos );

		$servicios = $this->getServiciosPorMedico (66);
		dd($servicios);
		$especialidades = $this->getEspecialidadesPorMedico(66);
		dd( $consultorios );

	}

	private function cargarMedicos($idDepartamento, $idEspecialidad)
	{
		$query = DB::table('medicos as m')
            ->leftJoin('medicosEspecialidad as me', 'm.idMedico', '=', 'me.idMedico')
            ->leftJoin('especialidades as es', 'es.idEspecialidad', '=', 'me.idEspecialidad')
            ->leftJoin('empleados as em', 'm.idEmpleado ', '=', 'em.idEmpleado')
            ->selectRaw("distinct m.idMedico, em.apellidoPaterno+'-'+em.apellidoMaterno+' '+em.nombres as 'nombre' ");

        if( $idDepartamento > 0) $query->where('es.idDepartamento', $idDepartamento);
        if( $idEspecialidad > 0) $query->where('es.idEspecialidad', $idEspecialidad);

        return $query->get();
	}

	private function getServiciosPorMedico( $idMedico )
	{
		$data = DB::table('medicosEspecialidad as me')
			->leftJoin('servicios as s', 's.idEspecialidad', 'me.idEspecialidad')
			->where('me.idMedico', $idMedico)
			->select('s.idServicio',  's.nombre')
			->get();
		return $data;
	}

	private function getEspecialidadesPorMedico( $idMedico )
	{
		$data = DB::table('medicosEspecialidad as me')
			->leftjoin('especialidades as es', 'es.idEspecialidad', 'me.idEspecialidad')
			->where('me.idMedico', $idMedico)
			->select('es.idEspecialidad', 'es.nombre', 'es.idDepartamento', 'tiempoPromedioAtencion')
			->get();
		return  $data;
		// mo_cmbIdServicio.RowSource = mo_AdminProgramacionMedica.MedicosFiltrarPorProgramacionsql2000(Val(mo_cmbDepartamento.BoundText), Val(mo_cmbEspecialidad.BoundText), Val(mo_cmbIdServicio.BoundText), Diario.CurrentDate)
	}


	

	// -- Api


	public function apiService(Request $request)
	{
		switch($request->name)
		{
			case 'getConfig':
				return $this->getConfig( $request );
			case 'getServicios':
				return $this->getServicios( $request->fecha );
			case 'getMedicos':
				return $this->getMedicos( $request );
			case 'getProgramacion':
				return $this->getProgramacion( $request );
			case 'getCalendario':
				return $this->getCalendario( $request->fecha );
			default:
				return null;
		}
	}

	private function getConfig( $request )
	{
		// $fechaActual = date('d-m-Y');
		// $fechaActual = '21-05-2018';
		$fechaActual = '13-04-2018';
		$anioActual = date('Y', strtotime($fechaActual));
		$mesActual = date('m', strtotime($fechaActual));

		$anios = [];
		for( $i=2000; $i<=2500; $i++) {
			array_push($anios, [ 'id' => $i, 'text' => $i ] );
		}

		$meses = [
			[ 'id' => 1, 'text' => 'Enero'],
			[ 'id' => 2, 'text' => 'Febrero'],
			[ 'id' => 3, 'text' => 'Marzo'],
			[ 'id' => 4, 'text' => 'Abril'],
			[ 'id' => 5, 'text' => 'Mayo'],
			[ 'id' => 6, 'text' => 'Junio'],
			[ 'id' => 7, 'text' => 'Julio'],
			[ 'id' => 8, 'text' => 'Agosto'],
			[ 'id' => 9, 'text' => 'Septiembre'],
			[ 'id' => 10, 'text' => 'Octubre'],
			[ 'id' => 11, 'text' => 'Noviembre'],
			[ 'id' => 12, 'text' => 'Diciembre'],
		];

		$data['anios'] = $anios;
		$data['meses'] = $meses;
		$data['fecha_actual'] = $fechaActual;
		$data['anio_actual'] = $anioActual;
		$data['mes_actual'] = $mesActual;
		$data['calendario'] = $this->getCalendario( $fechaActual );
		$data['servicios'] = $this->getServicios( $fechaActual );

		return $data;
	}

	private function getMedicos( $request )
	{
		return $this->getMedicosPorServicio( $request->fecha, $request->idServicio );
	}

	private function getProgramacion( $request )
	{
		return $this->getProgramacionPorMedico( $request->fecha, $request->idServicio, $request->idMedico );
	}
	
	private function getServicios( $fecha )
	{
		$query = "SELECT DISTINCT  pm.idServicio, s.nombre AS servicio,
		pm.idServicio AS id, s.nombre AS text
		FROM programacionMedica AS pm
		LEFT JOIN servicios AS s ON s.idServicio = pm.idServicio
		WHERE YEAR(pm.fecha) = :anio
		AND MONTH(pm.fecha) = :mes";

		$params = [
			'mes' => date('m', strtotime($fecha) ),
			'anio' => date('Y', strtotime($fecha) ),
		];

		$data = DB::select($query, $params);
		return $data;
	}

	private function getMedicosPorServicio( $fecha, $idServicio = null)
	{
		$query = "SELECT DISTINCT 
		pm.horaInicio, pm.horaFin,
		e.idEmpleado, m.idMedico,
		e.ApellidoPaterno+' '+e.apellidoMaterno+' '+e.nombres as medico
		FROM programacionMedica AS pm
		LEFT JOIN medicos AS m ON m.idMedico = pm.idMedico
		LEFT JOIN empleados AS e ON e.idEmpleado = m.idEmpleado
		WHERE YEAR(pm.fecha) = :anio
		AND MONTH(pm.fecha) = :mes
		AND pm.idServicio = :idServicio";

		$params = [
			'mes' => date('m', strtotime($fecha) ),
			'anio' => date('Y', strtotime($fecha) ),
			'idServicio' => $idServicio
		];

		$data = DB::select($query, $params);
		return $data;
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

		foreach($data as $row){
			$params = [
				'idServicio' => $idServicio,
				'fecha' => date('d-m-Y', strtotime($row->fecha) ),
				'idMedico' => $idMedico,
			];

			$row->atenciones = DB::select($query, $params);
		}

		return $data;
	}

	private function getProgramacioAAAA( $request )
	{
		$fecha = '21-05-2018';

		// $calendario = $this->getCalendario( $fecha );

		$servicios = $this->getServicios( $fecha );

		$medicos = $this->getMedicosPorServicio( $fecha, 57);

		$programacion = $this->getProgramacionPorMedico( $fecha, 57, 7 );

		$data = [
			'servicio_mes' => $servicios,
			'medicos_por_servicio' => $medicos,
			'programacion_medico' => $programacion,
		];
		
		dd( $data );

		
	}



	private function getCalendario( $fecha )
	{

		$cantidadFormato = 42;

		$totalDias = date('t', strtotime($fecha) );

		$mesActual = date('m', strtotime($fecha) );

		$anioActual = date('Y', strtotime($fecha) );

		$diaActual = date('d', strtotime($fecha) );

		$numeroPrimerDia = date('N', strtotime($fecha) );
		
		//crear dias del mes especifico
		$diasArray = [1=>'Lunes', 2=>'Martes', 3=>'Miercoloes', 4=>'Jueves', 5=>'Viernes', 6=>'Sabado', 7=>'Domingo'];

		$mesArray = [];
		$numDiaTmp = (int) $numeroPrimerDia;
		$indexDiaTmp = $numeroPrimerDia;
		for ($i=1; $i <=$totalDias ; $i++) {
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
			'dias' => $diasMes,
		];

		return $data;
	}
}