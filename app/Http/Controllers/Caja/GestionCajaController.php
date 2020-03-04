<?php
namespace App\Http\Controllers\Caja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use DB;
use App\VB\SIGHNegocios\ReglasComunes;
use App\VB\SIGHNegocios\ReglasCaja;

use App\VB\SIGHComun\DOCajaGestion;
use App\VB\SIGHComun\DOPaciente;
use App\VB\SIGHComun\DOCajaComprobantesPago;
class GestionCajaController extends Controller
{
	const PATH_VIEW = 'caja.gestion-caja.';

	private $mo_AdminCaja;

	private $mo_AdminServiciosComunes;
	private $oDOCajaComprobantesPago;
	private $oDOPaciente;

	public function __construct()
	{
		$this->mo_AdminCaja = new ReglasCaja;
		$this->mo_AdminServiciosComunes = new ReglasComunes;

		$this->mo_CajaGestion = new DOCajaGestion;
		$this->mo_Paciente = new DOPaciente;
		$this->mo_CajaComprobantesPago = new DOCajaComprobantesPago;
	}

	public function index(Request $request)
	{
		if($request->ajax()) {
			$items = DB::table('CajaCaja')->select('IdCaja as id', 'Descripcion as name')->paginate(10); //test data
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