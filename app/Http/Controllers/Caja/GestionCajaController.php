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
			
			$lcFechaIni = $request->fechaInicio;
			$lcFechaFin = $request->fechaFin;

			$lnTotalRecaudado = 0.00;
			$lnTotBoletas = 0.00;
			$lnTotFacturas = 0.00;
			$lnTotDctosAnulados = 0.00;
			$lnTotDevNotaCred = 0.00;

			$lnNroBoletas = 0;
			$lnNroFacturas = 0;
			$lnNroDocumentos = 0;
			$lnNroDctosAnulados = 0;
			$lnNroDevNotaCred = 0;

			//$oRsBusquedaRecibos
			$oRsBusquedaRecibos = $this->mo_AdminCaja->CajaComprobantePagoSeleccionarPorFechaOdocumento("", "", $lcFechaIni, $lcFechaFin);
			//$oRsBusquedaDevNotaCredito = $this->mo_AdminCaja->NotaCreditoDevueltosPorNumYFecha("", "", $lcFechaIni, $lcFechaFin);

			$val = [];
			if($request->serie != null && $request->numDocumento != null){
				for ($i=0; $i < count($oRsBusquedaRecibos); $i++) { 
					if(trim($oRsBusquedaRecibos[$i]->NroSerie) == trim($request->serie) && trim($oRsBusquedaRecibos[$i]->NroDocumento) == trim($request->numDocumento)){
						$val [] = $oRsBusquedaRecibos[$i];
					}
				}
			}else if($request->serie != null){
				for ($i=0; $i < count($oRsBusquedaRecibos); $i++) { 
					if(trim($oRsBusquedaRecibos[$i]->NroSerie) == trim($request->serie)){
						$val [] = $oRsBusquedaRecibos[$i];
					}
				}
			}else if($request->numDocumento != null){
				for ($i=0; $i < count($oRsBusquedaRecibos); $i++) { 
					if(trim($oRsBusquedaRecibos[$i]->NroDocumento) ==  trim($request->numDocumento)){
						$val [] = $oRsBusquedaRecibos[$i];
					}
				}
			}else if($request->numHistoria != null){
				for ($i=0; $i < count($oRsBusquedaRecibos); $i++) { 
					if(trim($oRsBusquedaRecibos[$i]->NroHistoriaClinica) ==  trim($request->numHistoria)){
						$val [] = $oRsBusquedaRecibos[$i];
					}
				}
			}else if($request->cmbCaja != null){
				for ($i=0; $i < count($oRsBusquedaRecibos); $i++) { 
					if(trim($oRsBusquedaRecibos[$i]->idCaja) ==  trim($request->cmbCaja)){
						$val [] = $oRsBusquedaRecibos[$i];
					}
				}
			}else if($request->cmbTurno != null){
				for ($i=0; $i < count($oRsBusquedaRecibos); $i++) { 
					if(trim($oRsBusquedaRecibos[$i]->idTurno) ==  trim($request->cmbTurno)){
						$val [] = $oRsBusquedaRecibos[$i];
					}
				}
			}else if($request->rsocial != null){
				for ($i=0; $i < count($oRsBusquedaRecibos); $i++) { 
					if(stristr(trim($oRsBusquedaRecibos[$i]->RazonSocial),trim($request->rsocial))){
						$val [] = $oRsBusquedaRecibos[$i];
					}
				}
			}else if($request->cmbCajero != null){
				for ($i=0; $i < count($oRsBusquedaRecibos); $i++) { 
					if(trim($oRsBusquedaRecibos[$i]->IdCajero) ==  trim($request->cmbCajero)){
						$val [] = $oRsBusquedaRecibos[$i];
					}
				}
			}else{
				$val = $oRsBusquedaRecibos;
			}
			
			$collection = collect($val);
			$page = $request->page;
			$perPage = 10;
			$items = new LengthAwarePaginator($collection->forPage($page, $perPage), $collection->count(), $perPage, $page, ['path'=>url(self::PATH_VIEW)]);
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
			return view(self::PATH_VIEW.'partials.item-edit');
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
			case 'getData':
				return $this->getData( $request );
			case 'getDataCmbs':
				return $this->getDataCmbs( $request );
			default:
				return null;
		}
	}

	private function getData( $request )
	{
		$cmbCaja = $this->mo_AdminCaja->ListarCajas();
		$cmbTurno = $this->mo_AdminCaja->ListarTurnos();
		$cmbCajero = $this->mo_AdminCaja->ListarCajeros();
		$data['cmbCaja'] = $cmbCaja;
		$data['cmbTurno'] = $cmbTurno;
		$data['cmbCajero'] = $cmbCajero;
		return $data;
	}

	private function getDataCmbs( $request )
	{
		$cmbTiposHistoria = $this->mo_AdminCaja->ListarTiposHistoria();
		$cmbTiposComprobantes = $this->mo_AdminCaja->TiposDeComprobantes();
		$data['cmbTipoHistoria'] = $cmbTiposHistoria;
		$data['cmbTipoDocumento'] = $cmbTiposComprobantes;
		return $data;
	}

}