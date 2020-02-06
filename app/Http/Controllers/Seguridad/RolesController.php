<?php
namespace App\Http\Controllers\Seguridad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\VB\SIGHNegocios\ReglasSeguridad;
use App\VB\SIGHComun\DORol;
use App\VB\SIGHComun\DORolItem;
use App\VB\SIGHComun\DORolPermiso;

class RolesController extends Controller //Form
{
	const PATH_VIEW = 'seguridad.roles.';

	private $mo_AdminSeguridad;
	private $mo_Roles;
	private $mo_RolItems;
	private $mo_RolPermisos;
	private $mo_RolReportes;
	private $user;
	private $idListBar = 1302;

	public function __construct()
	{
		$this->mo_AdminSeguridad = new ReglasSeguridad;
		$this->mo_Roles = new DORol;
		$this->mo_RolItems = collect([]);
		$this->mo_RolPermisos = collect([]);
		$this->mo_RolReportes = collect([]);
	}

	public function index(Request $request)
	{
		if($request->ajax()) {

			$items = $this->mo_AdminSeguridad->RolesSeleccionarTodos();

			if(isset($request->search)){
				$items = arrlike($items, 'Nombre', $request->search);
			}

			$items = buildDataPagination($items, 5, $request);

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
			// $this->validate($request, [
			// 	'nombreRol' => 'required',
			// ]);

			$this->CargaDatosAlObjetosDeDatos($request, 0);
			// dd($this->mo_RolItems);
			// dd($this->mo_RolPermisos);
			// dd($this->mo_RolReportes);
			$success = false;
			$message = 'uknown';
			DB::beginTransaction();
			try {
				$success = $this->mo_AdminSeguridad->RolesAgregar(
					$this->mo_Roles, 
					$this->mo_RolItems, 
					$this->mo_RolPermisos, 
					$this->mo_RolReportes, 
					$this->idListBar, 
					nombrePC()
				);

				$message = $success? 'Datos guardados!': 'Error: RolesAgregar';
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
			$item = $this->mo_AdminSeguridad->RolesSeleccionarPorId($id);
			return view(self::PATH_VIEW.'partials.item-show', compact('item'));
		}
	}

	public function edit($id)
	{
		if(request()->ajax()) {
			$item = $this->mo_AdminSeguridad->RolesSeleccionarPorId($id);
			return view(self::PATH_VIEW.'partials.item-edit', compact('item'));
		}
	}

	public function update(Request $request, $id)
	{
		if(request()->ajax()) {
			$this->validate($request, [
				'nombreRol' => 'required',
			]);

			$this->CargaDatosAlObjetosDeDatos($request, $id);
			// dd($this->mo_RolItems);
			// dd($this->mo_RolPermisos);
			// dd($this->mo_RolReportes);
			$success = false;
			$message = 'uknown';
			DB::beginTransaction();
			try {
				$success = $this->mo_AdminSeguridad->RolesModificar(
					$this->mo_Roles, 
					$this->mo_RolItems, 
					$this->mo_RolPermisos, 
					$this->mo_RolReportes, 
					$this->idListBar, 
					nombrePC()
				);

				$message = $success? 'Datos guardados!': 'Error: RolesAgregar';
				DB::commit();
				// all good
			} catch (\Exception $e) {
				DB::rollback();
				$success = false;
				$message = $e->getMessage();
				// dd(['exception' => $e->getMessage()]);
				// something went wrong
			}

			return ['success' => $success, 'message'=> $message ];
		}
	}

	public function delete($id)
	{
		if(request()->ajax()) {
			$item = $this->mo_AdminSeguridad->RolesSeleccionarPorId($id);
			return view(self::PATH_VIEW.'partials.item-delete', compact('item'));
		}
	}

	public function destroy($id)
	{
		if(request()->ajax()) {

			$this->CargaDatosAlObjetosDeDatos([], $id);
			// dd($this->mo_Roles);
			// dd($this->mo_RolPermisos);
			// dd($this->mo_RolReportes);
			$success = false;
			$message = 'uknown';
			DB::beginTransaction();
			try {
				$success = $this->mo_AdminSeguridad->RolesEliminar(
					$this->mo_Roles, 
					$this->idListBar, 
					nombrePC()
				);

				$message = $success? 'Datos eliminados!': 'Error: RolesEliminar';
				DB::commit();
				// all good
			} catch (\Exception $e) {
				DB::rollback();
				$success = false;
				$message = $e->getMessage();
				// something went wrong
			}

			return ['success' => $success, 'message'=> $message ];
		}
	}

	public function apiService(Request $request)
	{
		switch($request->name)
{			case 'getDataCombos':
				return $this->getDataCombos( $request );
			case 'getDataRol':
				return $this->getDataRol( $request );
			default:
				return null;
		}
	}

	private function getDataCombos( $request )
	{
		$itemsCbx = $this->mo_AdminSeguridad->ListItemsSeleccionarTodos();
		$permisosCbx= $this->mo_AdminSeguridad->PermisosSeleccionarTodos();
		$reportesCbx = $this->mo_AdminSeguridad->ListBarReportesSeleccionarTodos();

		$data['items'] = $itemsCbx;
		$data['permisos'] = $permisosCbx;
		$data['reportes'] = $reportesCbx;
		return $data;
		// dd($data);
	}

	private function getDataRol( $request )
	{
		$id = $request->idRol;
		$data['misModulos'] = $this->mo_AdminSeguridad->RolesItemsSeleccionarPorRol($id);
		$data['misReportes'] = $this->mo_AdminSeguridad->RolesReportesSeleccionarXrol($id);
		$data['misPermisos'] = $this->mo_AdminSeguridad->RolesPermisosSeleccionarPorRol($id);
		return $data;
	}

	private function CargaDatosAlObjetosDeDatos($request, $idRol)
	{
		$this->user = \Auth::user();
		$modulosData = collect( isset($request->modulos)? $request->modulos: [] );
		$permisosData = collect( isset($request->permisos)? $request->permisos: [] );
		$reportesData = collect( isset($request->reportes)? $request->reportes: [] );
		
		// CargaDatosAlObjetosDeDatos
		
		$this->mo_Roles->idRol = $idRol;
		$this->mo_Roles->nombre = isset($request->nombreRol)? $request->nombreRol: null;
		$this->mo_Roles->idUsuarioAuditoria = $this->user->id;

		// CargarRolItemsAlObjetoDatos mo_RolItems
		foreach($modulosData as $row){
			$oRolItem = new DORolItem;
			$oRolItem->idRolItem = 0;
			$oRolItem->idRol = $idRol;
			$oRolItem->idListItem = $row['idListItem'];
			$oRolItem->agregar = isset($row['agregar'])? 1: 0;
			$oRolItem->modificar = isset($row['modificar'])? 1: 0;
			$oRolItem->consultar = isset($row['consultar'])? 1: 0;
			$oRolItem->eliminar = isset($row['eliminar'])? 1: 0;
			$oRolItem->idUsuarioAuditoria = $this->user->id;
			$this->mo_RolItems->push($oRolItem);
		}

		// CargarPermisosAlObjetoDatos mo_RolPermisos
		foreach ($permisosData as $row){
			$oRolPermiso = New DORolPermiso;
			$oRolPermiso->idRolPermiso = 0;
			$oRolPermiso->idRol = $idRol;
			$oRolPermiso->idPermiso = isset($row['idPermiso'])? $row['idPermiso']: null;
			$oRolPermiso->idUsuarioAuditoria = $this->user->id;
			$this->mo_RolPermisos->push($oRolPermiso);
		}

		foreach ($reportesData as $row){
			
			$oRolReporte = collect([]);
			$oRolReporte->idReporte = $row['idReporte'];
			$oRolReporte->tieneAcceso = isset($row['tieneAcceso'])? 1: 0;
			$oRolReporte->idRol = $idRol;
			$oRolReporte->idUsuarioAuditoria = $this->user->id;
			$this->mo_RolReportes->push($oRolReporte);
		}
	}

}