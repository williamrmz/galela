<?php
namespace App\Http\Controllers\FactConfig;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\VB\SIGHNegocios\ReglasComunes;
use App\VB\SIGHNegocios\ReglasFacturacion;
use App\VB\SIGHComun\DOCatalogoServicio;

class CatalogoBienesInsumosController extends Controller
{
	const PATH_VIEW = 'fact-config.catalogo-bienes-insumos.';
	private $mo_AdminComun;

	public function __construct()
	{	$this->mo_AdminComun = new ReglasComunes;
		$this->mo_ReglasFacturacion = new ReglasFacturacion;
		
	}

	public function index(Request $request)
	{

		$tiposCatalogoData = $this->mo_ReglasFacturacion->TiposFinanciamientoSeleccionarTodos();
	
		/*if($request->ajax()) {
			$oDOCatalogoServicios = new DOCatalogoServicio;
			$oDOCatalogoServicios->codigo = Trim($request->fCodigo);
			$oDOCatalogoServicios->nombre = Trim($request->fNombre);
			//$items = $this->mo_AdminComun->CatalogoServiciosFiltrarDEBB($oDOCatalogoServicios, $request->fIdTipoCatalogo);
			// dd($items);
			return view(self::PATH_VIEW.'partials.item-list', compact('items'));
		}*/

		return view(self::PATH_VIEW.'index', compact('tiposCatalogoData'));


		/*if($request->ajax()) {
			$items = DB::table('empleados')->select('idEmpleado as id', 'Nombres as name')->paginate(10); 
			return view(self::PATH_VIEW.'partials.item-list', compact('items'));
		}
		return view(self::PATH_VIEW.'index');*/
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


	public function apiService(Request $request)
	{
		switch($request->name)
		{
			case 'data-example':
				return $this->getDataExample( $request );
			default:
				return null;
		}
	}

	private function getDataExample( $request )
	{
		return 'data example...';
	}

}