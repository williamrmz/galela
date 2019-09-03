<?php
namespace App\Http\Controllers\ArchivoClinico;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\VB\SIGHNegocios\ReglasArchivoClinico;
use App\VB\SIGHNegocios\ReglasComunes;
use App\VB\SIGHComun\DOArchiveroServicio;
use App\VB\SIGHComun\DOEmpleado;

class ArchiverosController extends Controller
{
	const PATH_VIEW = 'archivo-clinico.archiveros.';

	private $user;
	private $mo_AdminArchivoClinico;
	private $mo_Archiveros;
	private $mo_lnIdTablaLISTBARITEMS;
	private $mo_AdminReglasComunes;

	public function __construct()
	{
		$this->mo_AdminArchivoClinico = new ReglasArchivoClinico;
		$this->mo_Archiveros = collect([]);
		$this->mo_lnIdTablaLISTBARITEMS = 0;
		$this->mo_AdminReglasComunes = new ReglasComunes;
	}

	public function index(Request $request)
	{
		if($request->ajax()) {

			$oEmpleado = new DOEmpleado;
			$oEmpleado->apellidoPaterno = $request->fApellidoPaterno;
			$oEmpleado->apellidoMaterno = $request->fApellidoMaterno;
			$oEmpleado->nombres = $request->fNombres;
			$oEmpleado->codigoPlanilla = $request->fCodigoPlanilla;
			
			$items = $this->mo_AdminArchivoClinico->ArchiveroServicioFiltrar($oEmpleado);
		
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
			$dataFail = $this->ValidarDatosObligatorios($request);
			if( $dataFail ) return $dataFail;

			$rulesFail = $this->ValidarReglas($request, 'sghAgregar');
			if($rulesFail) return $rulesFail;

			$success = false;
			$message = 'uknown';
			DB::beginTransaction();
			try {
				$success = $this->AgregarDatos($request);
				$message = $success? 'Datos guardados!': 'Error: AgregarDatos';
				DB::commit();
			} catch (\Exception $e) {
				DB::rollback();
				$success = false;
				$message = $e->getMessage();
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
			$item = null;
			return view(self::PATH_VIEW.'partials.item-edit', compact('item'));
		}
	}

	public function update(Request $request, $id)
	{
		if(request()->ajax()) {
			$this->user = \Auth::user();
			$dataFail = $this->ValidarDatosObligatorios($request);
			if( $dataFail ) return $dataFail;

			$rulesFail = $this->ValidarReglas($request);
			if($rulesFail) return $rulesFail;

			$success = false;
			$message = 'uknown';
			DB::beginTransaction();
			try {
				$success = $this->ModificarDatos($request);
				$message = $success? 'Datos actualizados!': 'Error: ModificarDatos';
				DB::commit();
			} catch (\Exception $e) {
				DB::rollback();
				$success = false;
				$message = $e->getMessage();
			}
			return ['success' => $success, 'message'=> $message ];
		}
	}

	public function delete($id)
	{
		if(request()->ajax()) {
			$item = null;
			return view(self::PATH_VIEW.'partials.item-delete', compact('item'));
		}
	}

	public function destroy(Request $request, $id)
	{
		if(request()->ajax()) {
			$this->user = \Auth::user();
			$dataFail = $this->ValidarDatosObligatorios($request);
			if( $dataFail ) return $dataFail;

			$rulesFail = $this->ValidarReglas($request);
			if($rulesFail) return $rulesFail;

			$success = false;
			$message = 'uknown';
			DB::beginTransaction();
			try {
				$success = $this->EliminarDatos($request);
				$message = $success? 'Datos eliminados!': 'Error: EliminarDatos';
				DB::commit();
			} catch (\Exception $e) {
				DB::rollback();
				$success = false;
				$message = $e->getMessage();
			}
			return ['success' => $success, 'message'=> $message ];
		}
	}

	private function ValidarDatosObligatorios( $request )
	{
		$sMensaje = "";
		if ( is_null($request->idEmpleado) ){
       		$sMensaje = "Ingrese el código del empleado";
		}
		return $sMensaje;
	}

	private function ValidarReglas( $request )
	{
		return '';
	}

	private function AgregarDatos( $request )
	{
		$this->CargaDatosAlObjetosDeDatos( $request );
   		$AgregarDatos = $this->mo_AdminArchivoClinico->ArchiveroServicioAgregar(
			$this->mo_Archiveros, 
			$this->mo_lnIdTablaLISTBARITEMS,
			nombrePc()
		);
		return $AgregarDatos;
	}

	private function ModificarDatos( $request)
	{
		$this->CargaDatosAlObjetosDeDatos( $request );
   		$modificar = $this->mo_AdminArchivoClinico->ArchiveroServicioModificar(
			$this->mo_Archiveros, 
			$this->mo_lnIdTablaLISTBARITEMS,
			nombrePc(),
			$request->idEmpleado
		);
		return $modificar;
	}

	private function EliminarDatos( $request )
	{
		$eliminar = $this->mo_AdminArchivoClinico->ArchiveroServicioEliminar(
			$this->mo_Archiveros, 
			$this->mo_lnIdTablaLISTBARITEMS, 
			nombrePc(), 
			$this->user->id,
			$request->idEmpleado
		);

		return $eliminar;
	}

	private function CargaDatosAlObjetosDeDatos( $request )
	{
		$misServicios = $request->servicios;
		if( isset($misServicios) ){
			foreach($misServicios as $row){
				$oArchiveroServicio = new DOArchiveroServicio;
				$oArchiveroServicio->idArchivero = 0;
				$oArchiveroServicio->idEmpleado = $request->idEmpleado;
				$oArchiveroServicio->idServicio = $row['idServicio'];
				$oArchiveroServicio->idUsuarioAuditoria = $this->user->id;
				$this->mo_Archiveros->push($oArchiveroServicio);
			}
		}
		return true;
	}

	// API
	public function apiService(Request $request)
	{
		switch($request->name)
		{
			case 'getDataItem':
				return $this->getDataItem( $request );
			default:
				return null;
		}
	}

	private function getDataItem( $request )
	{
		$empleado = $this->mo_AdminReglasComunes->EmpleadosSeleccionarPorId( $request->idEmpleado );
		$misServicios = [];
		if( $empleado ){
			$serviciosData = $this->mo_AdminArchivoClinico->ArchiveroServicioFiltrarPorEmpleado( $request->idEmpleado );
			if ( isset($serviciosData[0]) ){
				foreach($serviciosData as $key => $row){
					$tmp = explode('-',$row->NombreServicio);
					$codigoServicio = isset($tmp[0])? $tmp[0]: null;
					$nombreServicio = isset($tmp[1])? $tmp[1]: null;
					$misServicios[] = [
						'id' => $row->IdServicio,
						'idServicio' => $row->IdServicio,
						'codigoServicio' => $codigoServicio,
						'nombreServicio' => $nombreServicio,
					];
				}
			}
		}

		return [
			'empleado' => $empleado,
			'misServicios' => $misServicios,
		];
	}

}