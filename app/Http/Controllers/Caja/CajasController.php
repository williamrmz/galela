<?php
namespace App\Http\Controllers\Caja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\VB\SIGHDatos\CajaTiposComprobante; 
use App\VB\SIGHDatos\CajaNroDocumento; 

class CajasController extends Controller
{
	const PATH_VIEW = 'caja.cajas.';
	private $user;

	public function __construct()
	{
		$this->om_TipoComprobantes = new CajaTiposComprobante;
		$this->om_CajaDocumentos = new CajaNroDocumento;
		$this->user = \Auth::user();
	}

	public function index(Request $request)
	{
		if($request->ajax()) {
			$items = DB::table('CajaCaja')->select('IdCaja as id', 'Codigo as codigo', 'Descripcion as desc', 'loginPC as pc', 
			'ImpresoraDefault as impresora1', 'Impresora2 as impresora2', 'idTipoComprobante as idComp')->paginate(10); //test data
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
			//$this->ValidarDatosObligatorios($request);
			$aea = 'asas';

			$success = false;

			//write your code...

			return ['success' => $aea];
		}
	}

	public function show($id)
	{
		if(request()->ajax()) {
			//DataFake
			$item = DB::table('CajaCaja')->where('IdCaja', $id)
				->select('IdCaja as id', 'Codigo as codigo', 'Descripcion as desc', 'loginPC as pc', 
				'ImpresoraDefault as impresora1', 'Impresora2 as impresora2', 'idTipoComprobante as idComp')->first();

			return view(self::PATH_VIEW.'partials.item-show', compact('item'));
		}
	}

	public function edit($id)
	{
		if(request()->ajax()) {
			//DataFake
			$item = DB::table('CajaCaja')->where('IdCaja', $id)
				->select('IdCaja as id', 'Codigo as codigo', 'Descripcion as desc', 'loginPC as pc', 
				'ImpresoraDefault as impresora1', 'Impresora2 as impresora2', 'idTipoComprobante as idComp')->first();

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


	public function apiService(Request $request)
	{
		switch($request->name)
		{
			case 'tiposComprobante':
				return $this->tiposComprobante( $request );
			case 'tablaComprobante':
				return $this->tablaComprobante( $request );
			default:
				return null;
		}
	}

	private function getDataExample( $request )
	{
		return 'data example...';
	}



	private function tiposComprobante( $request )
	{
		$cmbIdTipoComprobante = $this->om_TipoComprobantes->SeleccionarTodos();
		$data['cmbIdTipoComprobante'] = $cmbIdTipoComprobante;
		return $data;
	}

	private function tablaComprobante( $request )
	{
		$data = $this->om_CajaDocumentos->SeleccionarPorIdCaja($request->idCaja);
		return $data;
	}


	private function ValidarDatosObligatorios($request){
		$request->validate([
			'codigo' => 'required|max:4|min:4',
			'desc' => 'required',
			'pc' => 'required',
			'impresora1' => 'required',
			'impresora2' => 'required'
		]);
	}

}