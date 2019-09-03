<?php
namespace App\Http\Controllers\Seguridad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\VB\SIGHNegocios\ReglasSeguridad;
use App\VB\SIGHNegocios\ReglasComunes;
use App\VB\SIGHNegocios\ReglasFarmacia;
use App\VB\SIGHNegocios\ReglasFacturacion;
use App\VB\SIGHNegocios\ReglasAdmision;

use App\VB\SIGHComun\DOEmpleado;
use App\VB\SIGHComun\DOUsuarioRol;

class EmpleadosController extends Controller
{
	const PATH_VIEW = 'seguridad.empleados.';

	private $mo_AdminSeguridad;

	private $mo_AdminServiciosComunes;

	private $mo_ReglasFacturacion;

	private $user;

	private $ml_IdEmpleado;

	private $sghAreasLaboraEmpleado = [
		[ 'id'=> 0, 'key'=>'sghOtroLugar', 'nombre'=> 'Otro lugar'],
		[ 'id'=> 1, 'key'=>'sghAlmacenFarmacia', 'nombre'=> 'Almacen ó Farmacia'],
		[ 'id'=> 2, 'key'=>'sghImageneologia', 'nombre'=> 'Imagenología'],
		[ 'id'=> 3, 'key'=>'sghLaboratorio', 'nombre'=> 'Laboratorio'],
		[ 'id'=> 4, 'key'=>'sghSeguros', 'nombre'=> 'Seguros'],
		[ 'id'=> 5, 'key'=>'sghEspecialidadesCE', 'nombre'=> 'Especialidades de consulta externa'],
		[ 'id'=> 6, 'key'=>'sghEspecialidadesHosp', 'nombre'=> 'Epecialidades de hospitalizacion'],
		[ 'id'=> 7, 'key'=>'sghEspecialidadesEmergObs', 'nombre'=> 'Empecialidades de emergencia - observacion'],
		[ 'id'=> 8, 'key'=>'sghEspecialidadesEmergCons', 'nombre'=> 'Empecialidades de emergencia - consultorios'],
		[ 'id'=> 9, 'key'=>'sghAreaTramitaSeguros', 'nombre'=> 'Area tramita seguros'],
	];

	public function __construct()
	{
		$this->mo_AdminSeguridad = new ReglasSeguridad;
		$this->mo_AdminServiciosComunes = new ReglasComunes;
		$this->mo_ReglasFarmacia = new ReglasFarmacia;
		$this->mo_ReglasFacturacion = new ReglasFacturacion;

		$this->ml_IdEmpleado = 0;
		$this->user = \Auth::user();
		$this->mo_Empleado = new DOEmpleado;
		$this->mo_UsuarioRoles = collect([]);
		$this->mrs_UsuariosCargos = collect([]);
		$this->mrs_LaboraEn = collect([]);
		$this->mo_lnIdTablaLISTBARITEMS = 1301;
	}

	public function index(Request $request)
	{
		if($request->ajax()) {

			// dd($request->apellidoPaterno);
			$oDOEmpleado = new DOEmpleado;
			$oDOEmpleado->apellidopaterno = trim($request->fApellidoPaterno);
			$oDOEmpleado->apellidomaterno = trim($request->fApellidoMaterno);
			$oDOEmpleado->nombres = trim($request->fNombres);
			$oDOEmpleado->codigoPlanilla = trim($request->fCodigoPlanilla);

			// dd($oDOEmpleado);
			$items = $this->mo_AdminServiciosComunes->EmpleadosFiltrar( $oDOEmpleado );
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
		if(request()->ajax()) {

			$this->user = \Auth::user();
			$this->ml_IdEmpleado = 0;
			$this->ValidarDatosObligatorios($request);
			$this->CargaDatosAlObjetosDeDatos($request);
			$data = $this->ValidarReglas($request, 'sghAgregar');
			if ($data) return ['success' => false, 'message'=> $data];

			// dd($this->mo_Empleado);
			// dd($this->mo_UsuarioRoles);
			// dd($this->mrs_UsuariosCargos);
			// dd($this->mrs_LaboraEn);

			$nombreEmpleado = trim($request->apellidoPaterno).' '.trim($request->apellidoMaterno).' '.trim($request->nombres);
			$reniecAutorizado = isset($request->reniecAutorizado)? 1: 0;

			$success = false;
			$message = 'uknown';
			DB::beginTransaction();
			try {
				$success = $this->mo_AdminServiciosComunes->EmpleadosAgregar(
					$this->mo_Empleado, 
					$this->mo_UsuarioRoles, 
					$this->mrs_UsuariosCargos, 
					$this->mrs_LaboraEn, 
					$this->mo_lnIdTablaLISTBARITEMS,
					nombrePc(), 
					$nombreEmpleado, 
					$this->EncriptaDNIsiTieneAccesoRENIEC( $reniecAutorizado )
				);
				// dd($AgregarDatos);
				$message = $success? 'Datos guardados!': 'Error: EmpleadosAgregar';
				DB::commit();
				// all good
			} catch (\Exception $e) {
				DB::rollback();
				$success = false;
				$message = $e->getMessage();
				// dd(['exception' => $e->getMessage()]);
			}
			return ['success' => $success, 'message'=> $message ];
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
			$item = $this->mo_AdminServiciosComunes->EmpleadosSeleccionarPorId($id);
			return view(self::PATH_VIEW.'partials.item-edit', compact('item'));
		}
	}

	public function update(Request $request, $id)
	{
		if(request()->ajax()) {
			$this->user = \Auth::user();
			$this->ml_IdEmpleado = $id;
			$this->ValidarDatosObligatorios($request);
			$this->CargaDatosAlObjetosDeDatos($request);
			$data = $this->ValidarReglas($request, 'sghModificar');
			if ($data) return ['success' => false, 'message'=> $data];
			// dd($this->mo_Empleado);
			// dd($this->mo_UsuarioRoles);
			// dd($this->mrs_UsuariosCargos);
			// dd($this->mrs_LaboraEn);

			$nombreEmpleado = trim($request->apellidoPaterno).' '.trim($request->apellidoMaterno).' '.trim($request->nombres);
			$reniecAutorizado = isset($request->reniecAutorizado)? 1: 0;

			$success = false;
			$message = 'uknown';
			DB::beginTransaction();
			try {
				$success = $this->mo_AdminServiciosComunes->EmpleadosModificar(
					$this->mo_Empleado, 
					$this->mo_UsuarioRoles, 
					$this->mrs_UsuariosCargos, 
					$this->mrs_LaboraEn, 
					$this->mo_lnIdTablaLISTBARITEMS,
					nombrePc(), 
					$nombreEmpleado, 
					$this->EncriptaDNIsiTieneAccesoRENIEC( $reniecAutorizado )
				);
				// dd($success);
				$message = $success? 'Datos modificados!': 'Error: EmpleadosModificar';
				DB::commit();
				// all good
			} catch (\Exception $e) {
				DB::rollback();
				$success = false;
				$message = $e->getMessage();
				// dd(['exception' => $e->getMessage()]);
			}
			return ['success' => $success, 'message'=> $message ];
		}
	}

	public function delete($id)
	{
		if(request()->ajax()) {
			$item = $this->mo_AdminServiciosComunes->EmpleadosSeleccionarPorId($id);
			return view(self::PATH_VIEW.'partials.item-delete', compact('item'));
		}
	}

	public function destroy(Request $request, $id)
	{
		if(request()->ajax()) {
			$this->user = \Auth::user();
			$this->ml_IdEmpleado = $id;
			$this->CargaDatosAlObjetosDeDatos($request);
			// dd($this->mo_Empleado);

			$nombreEmpleado = trim($request->apellidoPaterno).' '.trim($request->apellidoMaterno).' '.trim($request->nombres);

			$success = false;
			$message = 'uknown';
			DB::beginTransaction();
			try {
				$success = $this->mo_AdminServiciosComunes->EmpleadosEliminar(
					$this->mo_Empleado,
					$this->mo_lnIdTablaLISTBARITEMS,
					nombrePc(), 
					$nombreEmpleado
				);
				// dd($AgregarDatos);
				$message = $success? 'Datos eliminados!': 'Error: EmpleadosEliminar';
				DB::commit();
				// all good
			} catch (\Exception $e) {
				DB::rollback();
				$success = false;
				$message = $e->getMessage();
				// dd(['exception' => $e->getMessage()]);
			}
			return ['success' => $success, 'message'=> $message ];
		}
	}


	public function apiService(Request $request)
	{
		switch($request->name)
		{
			case 'getDataCombos':
				return $this->getDataCombos( $request );
			case 'getDataComboSubAreas':
				return $this->getDataComboSubAreas( $request );
			case 'CargarDatosALosControles':
				return $this->CargarDatosALosControles($request);
			default:
				return null;
		}
	}

	private function getDataCombos( $request )
	{
		$empleadoTipos = $this->mo_AdminServiciosComunes->TiposEmpleadosSeleccionarSegunFiltro("");
		
		$trabajoCondiciones = $this->mo_AdminServiciosComunes->TiposCondicionTrabajoSeleccionarTodos();
 
		$roles = $this->mo_AdminSeguridad->RolesSeleccionarTodos();
	  
		$cargos = $this->mo_ReglasFarmacia->TiposCargoSeleccionarTodos();
		
		$destacadoTipos = $this->mo_AdminServiciosComunes->TiposDestacadosSeleccionarTodos();
 
		$documentoTipos = $this->mo_AdminServiciosComunes->TiposDocIdentidadSeleccionarTodos();

		$areas = $this->sghAreasLaboraEmpleado;

		// $sexoTipos = $this->mo_AdminServiciosComunes->TiposSexoSeleccionarTodos();

		$data['roles'] = $roles;
		$data['cargos'] = $cargos;
		$data['areas'] = $areas;
		$data['documentoTipos'] = $documentoTipos;
		$data['empleadoTipos'] = $empleadoTipos;
		$data['trabajoCondiciones'] = $trabajoCondiciones;
		$data['destacadoTipos'] = $destacadoTipos;

		return $data;
	}

	private function getDataComboSubAreas( $request )
	{
		$idArea = $request->idArea;
		$keyArea = null;
		foreach( $this->sghAreasLaboraEmpleado as $row){
			if($row['id'] == $idArea){
				$keyArea =  $row['key'];
				break;
			}
		}

		// dd($keyArea);
		// $keyArea = 'sghServiciosHosp';

		switch( $keyArea ){
			case 'sghAlmacenFarmacia': //OK
				$data = $this->mo_ReglasFarmacia->FarmAlmacenSeleccionarSegunFiltro("idTipoLocales<>'X' and idEstado=1");
				foreach($data as $key => $row){
					$data[$key]->id = $row->idAlmacen;
					$data[$key]->text = $row->descripcion;
				}
				break;
			case 'sghImageneologia': //OK
				$data = $this->mo_AdminServiciosComunes->FactPuntosCargaSeleccionarPorFiltro("TipoPunto='I'");
				foreach($data as $key => $row){
					$data[$key]->id = $row->IdPuntoCarga;
					$data[$key]->text = $row->Descripcion;
				}
				break;
			case 'sghLaboratorio'://SI
				$data = $this->mo_AdminServiciosComunes->FactPuntosCargaSeleccionarPorFiltro("TipoPunto='L'");
				foreach($data as $key => $row){
					$data[$key]->id = $row->IdPuntoCarga;
					$data[$key]->text = $row->Descripcion;
				}
				break;
			case 'sghSeguros'://SI
				$data = $this->mo_AdminServiciosComunes->TiposFinanciamientoSegunFiltro("esOficina=1");
				foreach($data as $key => $row){
					$data[$key]->id = $row->IdTipoFinanciamiento;
					$data[$key]->text = $row->Descripcion;
				}
				break;
			case 'sghServiciosHosp':
				$oBuscaServicios = new ReglasAdmision;
				$data  = $oBuscaServicios->DevuelveServiciosDelHospital("(1,2,3,4)");
				dd($data);
				foreach($data as $key => $row){
					$data[$key]->id = $row->idServicio;
					$data[$key]->text = $row->DservicioHosp;
				}
				break;
			case 'sghEspecialidadesCE'://SI
				$oBuscaEspecialidadesCE = new ReglasAdmision;
				$data  = $oBuscaEspecialidadesCE->DevuelveEspecialidadesDelHospital("(1)");
				foreach($data as $key => $row){
					$data[$key]->id = $row->IdEspecialidad;
					$data[$key]->text = $row->DescripcionLarga;
				}
				break;
			case 'sghEspecialidadesHosp': //SI
				$oBuscaEspecialidadesHOSP = new ReglasAdmision;
				$data  = $oBuscaEspecialidadesHOSP->DevuelveEspecialidadesDelHospital("(3)");
				foreach($data as $key => $row){
					$data[$key]->id = $row->IdEspecialidad;
					$data[$key]->text = $row->DescripcionLarga;
				}
				break;
			case 'sghEspecialidadesEmergCons': //SI
				$oBuscaEspecialidadesEMERG = new ReglasAdmision;
				$data  = $oBuscaEspecialidadesEMERG->DevuelveEspecialidadesDelHospital("(2)");
				foreach($data as $key => $row){
					$data[$key]->id = $row->IdEspecialidad;
					$data[$key]->text = $row->DescripcionLarga;
				}
				break;
			case 'sghEspecialidadesEmergObs': //SI
				$oBuscaEspecialidadesEMERGobs = new ReglasAdmision;
				$data  = $oBuscaEspecialidadesEMERGobs->DevuelveEspecialidadesDelHospital("(4)");
				foreach($data as $key => $row){
					$data[$key]->id = $row->IdEspecialidad;
					$data[$key]->text = $row->DescripcionLarga;
				}
				break;
			case 'sghAreaTramitaSeguros': //SI
				$data  = $this->mo_ReglasFacturacion->AreaTramitaSegurosDevuelveTodosSegunFiltro("");
				foreach($data as $key => $row){
					$data[$key]->id = $row->idAreaTramitaSeguros;
					$data[$key]->text = $row->Descripcion;
				}
				break;
			case 'sghOtroLugar': //SI
				$data  = 0;
				break;
			default:
				$data = [];
				break;
		}
	
		return $data;
	}

	private function EncriptaDNIsiTieneAccesoRENIEC( $reniecAutorizado )
	{
		$dni = $this->mo_Empleado->dNI;
		return  $reniecAutorizado? encryptString($dni): '';
	}
	
	private function ValidarDatosObligatorios($request){
		$request->validate([
			'dni' => 'required',
			'codigoPlanilla' => 'required',
			'idTipoEmpleado' => 'required',
			'idCondicionTrabajo' => 'required',
			'nombres' => 'required',
			'apellidoMaterno' => 'required',
			'apellidoPaterno' => 'required',
			// 'areas' => 'required',
		]);
	}

	private function CargaDatosAlObjetosDeDatos($request)
	{
		// With mo_Empleado
            $this->mo_Empleado->codigoPlanilla = $request->codigoPlanilla;
            $this->mo_Empleado->dNI = $request->dni;
			$this->mo_Empleado->idEmpleado = $this->ml_IdEmpleado;
			$this->mo_Empleado->idTipoEmpleado = $request->idTipoEmpleado;
			$this->mo_Empleado->idCondicionTrabajo = $request->idCondicionTrabajo;
			$this->mo_Empleado->nombres = $request->nombres;
			$this->mo_Empleado->apellidoPaterno = $request->apellidoPaterno;
			$this->mo_Empleado->apellidoMaterno = $request->apellidoMaterno;
			$this->mo_Empleado->idUsuarioAuditoria = $this->user->id;
          
			$usaGalenhos = isset($request->usaGalenhos)? 1: 0;

			$this->mo_Empleado->usuario = $request->usuario;
			$this->mo_Empleado->clave = $request->clave;
			$this->mo_Empleado->loginEstado = $usaGalenhos;

			if($usaGalenhos == 0) $this->mo_Empleado->loginPc = "";

			$this->mo_Empleado->fechaNacimiento = $request->fechaNacimiento;
			$this->mo_Empleado->idTipoDestacado = $request->idTipoDestacado;
			$this->mo_Empleado->hisCodigoDigitador = $request->codigoDigitador;
			$this->mo_Empleado->idEstablecimientoExterno = $request->idEstablecimientoExterno;
			$this->mo_Empleado->reniecAutorizado = isset( $request->reniecAutorizado )? 1: 0;
			$this->mo_Empleado->idTipoDocumento = $request->idTipoDocumento;
			$this->mo_Empleado->idSupervisor = $request->idSupervisor;
			// $this->esActivo = IIf(Me.chkEsActivo.Value = 1, True, False)

			$rolesData = isset($request->roles)? $request->roles: [];
			$cargosData = isset($request->cargos)? $request->cargos: [];
			$lugaresData = isset($request->lugares)? $request->lugares: [];

			// CargarRolItemsAlObjetoDatos
			foreach( $rolesData as $row){
				$oUsuarioRol = New DOUsuarioRol;
				$oUsuarioRol->idUsuarioRol = 0;
				$oUsuarioRol->idEmpleado = $this->ml_IdEmpleado;
				$oUsuarioRol->idRol = $row['idRol'];
				$oUsuarioRol->idUsuarioAuditoria = $this->user->id;
				$this->mo_UsuarioRoles->push($oUsuarioRol);
			}

			foreach( $cargosData as $row){
				$cargo = collect([]);
				$cargo->idEmpleado = $this->ml_IdEmpleado;
				$cargo->idTipoCargo = $row['idTipoCargo'];
				$cargo->idUsuarioAuditoria = $this->user->id;
				$this->mrs_UsuariosCargos->push($cargo);
			}

			foreach( $lugaresData as $row){
				$lugar = collect([]);
				$lugar->idEmpleado = $this->ml_IdEmpleado;
				$lugar->idLaboraArea = $row['idLaboraArea'];
				$lugar->idLaboraSubArea = $row['idLaboraSubArea'];
				$lugar->idUsuarioAuditoria = $this->user->id;
				$this->mrs_LaboraEn->push($lugar);
			}
	}

	private function ValidarReglas( $request, $mi_Opcion)
	{
		// $mi_Opcion = 'sghAgregar';
		if ($mi_Opcion == 'sghAgregar' && $this->mo_AdminServiciosComunes->TiposEmpleadosSeleccionarSiSeProgramaPorId( $request->idTipoEmpleado) == true) {
			return "El TIPO DE EMPLEADO elegido se programa para registrarlo debe utilizar el modulo de PROFESIONALES DE SALUD";
		} //OK

		$rsEmpleado = $this->mo_AdminServiciosComunes->EmpleadosObtenerConElMismoCodigoPlanilla($this->mo_Empleado);
		if ( count($rsEmpleado) > 0 ){
			return "Ya existe un empleado con el mismo CODIGO PLANILLA ".$rsEmpleado[0]->ApellidoPaterno." ".$rsEmpleado[0]->ApellidoPaterno." ".$rsEmpleado[0]->Nombres;
		}//OK


		if ($request->dni <> ""){
        	if ($request->idTipoDocumento == "1" &&  strlen(trim($request->dni)) != 8) {
				return "El DNI debe tener longitud 8";
			}
			$rsEmpleado = $this->mo_AdminServiciosComunes->EmpleadosObtenerConelMismoDNI($request->dni, $request->idTipoDocumento);
			switch ($mi_Opcion){
				case 'sghAgregar':
					if ( count($rsEmpleado) > 0 ) {
						return "Ese N° DOCUMENTO ya esta Registrado para: ".trim($rsEmpleado[0]->ApellidoPaterno)." ".trim($rsEmpleado[0]->ApellidoMaterno)." ".$rsEmpleado[0]->Nombres;
					}
				case 'sghModificar':
					if ( count($rsEmpleado) > 0 ) {
						if ( (trim($rsEmpleado[0]->DNI) == trim($request->dni) )  && ($rsEmpleado[0]->IdEmpleado <> $this->ml_IdEmpleado) ) {
							return "Ese N° DOCUMENTO ya esta Registrado para: ".trim($rsEmpleado[0]->ApellidoPaterno)." ".trim($rsEmpleado[0]->ApellidoMaterno)." ". $rsEmpleado[0]->Nombres;
						}
					}
				default:
					break;
			}
		}

		$rsEmpleado = $this->mo_AdminServiciosComunes->EmpleadosObtenerConElMismoUsuario($this->mo_Empleado);
		if ( count($rsEmpleado) > 0 ) {
			return "Ya existe un empleado con el mismo USUARIO ".$rsEmpleado[0]->ApellidoPaterno." ".$rsEmpleado[0]->ApellidoMaterno." ".$rsEmpleado[0]->Nombres;
		}
	}

	private function CargarDatosALosControles($request)
	{
		$this->ml_IdEmpleado = $request->idEmpleado;
		// dd($this->ml_IdEmpleado);
		$empleado = $this->mo_AdminServiciosComunes->EmpleadosSeleccionarPorId($this->ml_IdEmpleado);

		if($empleado){
			$empleado->FechaNacimiento = date('Y-m-d', strtotime($empleado->FechaNacimiento));
			$data['empleado'] = $empleado;
			// CargarDatosDeRolItems
			$data['roles'] = $this->mo_AdminSeguridad->UsuariosRolesSeleccionarPorEmpleado($this->ml_IdEmpleado);
			// CargarDatosDeCargos
			$data['cargos'] = $this->mo_AdminServiciosComunes->EmpleadosCargosSeleccionarPorFiltro("dbo.EmpleadosCargos.idEmpleado=".$this->ml_IdEmpleado);
			
			// CargarDatosDeDondeLabora
			$lugares = $this->mo_AdminServiciosComunes->EmpleadosLugarDeTrabajoSeleccionarPorFiltro("idEmpleado=".$this->ml_IdEmpleado);
		
			$areasTrabajo = $this->mo_AdminServiciosComunes->AreasTrabajo();
			foreach($lugares as $key => $row){
				if ( isset($areasTrabajo[$row->idLaboraArea]) ){
					$area = $areasTrabajo[$row->idLaboraArea];
					$lugares[$key]->Area = $area->nombre;
					$lugares[$key]->SubArea = 'uknown';
					$subAreas = $this->mo_AdminServiciosComunes->SubAreaTrabajoSeleccionarXKeyArea($area->key);
					foreach( $subAreas as $subArea){
						if( $subArea->id = $row->idLaboraSubArea){
							$lugares[$key]->SubArea = $subArea->text;
							break;
						}
					}
				}
			}

			$data['lugares'] = $lugares;
		}

		$mi_Opcion = 'sghModificar';
		// dd('implementar esta parte');
		// switch( $mi_Opcion){
		// 	case 'sghModificar':
		// 		if ( $this->mo_AdminServiciosComunes->TiposEmpleadosSeleccionarSiSeProgramaPorId( $mo_cmbIdTipoEmpleado ) == true) {
		// 			// Me.cmbIdTipoEmpleado.Enabled = False
		// 			$dialog = "Para modificar DATOS PERSONALES de médicos ingrese a la opción 'Profesionales de Salud' del módulo 'Programación General";
		// 			break;
		// 		}
		// 	case 'sghEliminar':
		// 		if ($this->mo_AdminServiciosComunes->TiposEmpleadosSeleccionarSiSeProgramaPorId( $mo_cmbIdTipoEmpleado ) == true) {
		// 			// Me.Frame1.Enabled = False
		// 			$dialog = "Para eliminar médicos ingrese a la opción médicos del módulo programación médica ";
		// 			// 'Me.btnAceptar.Enabled = False
		// 			break;
		// 		}
		// 	default: break;
		// }
	
		return $data;
	}
}