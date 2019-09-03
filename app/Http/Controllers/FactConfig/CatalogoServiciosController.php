<?php
namespace App\Http\Controllers\FactConfig;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\VB\SIGHNegocios\ReglasComunes;
use App\VB\SIGHNegocios\ReglasFacturacion;
use App\VB\SIGHComun\DOCatalogoServicio;
use App\VB\SIGHComun\DOFactCatalogoServiciosHosp;
use App\VB\SIGHDatos\FactCatalogoServiciosHosp;

class CatalogoServiciosController extends Controller
{
	const PATH_VIEW = 'fact-config.catalogo-servicios.';

	private $mo_AdminComun;
	private $ml_IdProducto;
	private $mrs_PuntosCarga;
	private $mrs_Precios;
	private $mo_CatalogoServicios;
	private $idListBar;

	public function __construct()
	{
		$this->mo_AdminComun = new ReglasComunes;
		$this->mo_CatalogoServicios = new DOCatalogoServicio;
		$this->mo_ReglasFacturacion = new ReglasFacturacion;
		$this->ml_IdProducto = 0;
		$this->mrs_PuntosCarga = collect([]);
		$this->mrs_Precios = collect([]);
		$this->idListBar = 610;
	}

	public function index(Request $request)
	{
		$tiposCatalogoData = $this->mo_ReglasFacturacion->TiposFinanciamientoSeleccionarTodos();
		if($request->ajax()) {
			$oDOCatalogoServicios = new DOCatalogoServicio;
			$oDOCatalogoServicios->codigo = Trim($request->fCodigo);
			$oDOCatalogoServicios->nombre = Trim($request->fNombre);
			$items = $this->mo_AdminComun->CatalogoServiciosFiltrarDEBB($oDOCatalogoServicios, $request->fIdTipoCatalogo);
			// dd($items);
			return view(self::PATH_VIEW.'partials.item-list', compact('items'));
		}
		return view(self::PATH_VIEW.'index', compact('tiposCatalogoData'));
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
			$this->ml_IdProducto = 0;

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
				// all good
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
			$item = $this->mo_AdminComun->CatalogoServiciosSeleccionarPorId($id);
			return view(self::PATH_VIEW.'partials.item-edit', compact('item'));
		}
	}

	public function update(Request $request, $id)
	{
		if(request()->ajax()) {
			$this->user = \Auth::user();
			$this->ml_IdProducto = $id;

			$dataFail = $this->ValidarDatosObligatorios($request);
			if( $dataFail ) return $dataFail;

			$rulesFail = $this->ValidarReglas($request, 'sghModificar');
			if($rulesFail) return $rulesFail;

			$success = false;
			$message = 'uknown';
			DB::beginTransaction();
			try {
				$success = $this->ModificarDatos($request);
				$message = $success? 'Datos actualizados!': 'Error: ModificarDatos';
				DB::commit();
				// all good
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
			$item = $this->mo_AdminComun->CatalogoServiciosSeleccionarPorId($id);
			return view(self::PATH_VIEW.'partials.item-delete', compact('item'));
		}
	}

	public function destroy(Request $request, $id)
	{
		if(request()->ajax()) {
			$this->user = \Auth::user();
			$this->ml_IdProducto = $id;


			$rulesFail = $this->ValidarReglas($request, 'sghEliminar');
			if($rulesFail) return $rulesFail;

			$success = false;
			$message = 'uknown';
			DB::beginTransaction();
			try {
				$success = $this->EliminarDatos($request);
				// dd($success);
				$message = $success? 'Datos eliminados!': 'Error: EliminarDatos';
				DB::commit();
				// all good
			} catch (\Exception $e) {
				DB::rollback();
				$success = false;
				$message = $e->getMessage();
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
			case 'getDataComboSubGrupo':
				return $this->getDataComboSubGrupo( $request );
			case 'getDataComboSeccion':
				return $this->getDataComboSeccion( $request );
			case 'getDataComboSubSeccion':
				return $this->getDataComboSubSeccion( $request );
			case 'getDataPrecios':
				return $this->getDataPrecios( $request );
			case 'getDataPuntos':
				return $this->getDataPuntos( $request );
			default:
				return null;
		}
	}

	private function getDataCombos( $request )
	{
		$dataCentros = $this->mo_AdminComun->CentrosCostoSeleccionarTodos();
		foreach($dataCentros as $key => $row){
			$dataCentros[$key]->id = $row->IdCentroCosto;
			$dataCentros[$key]->text = $row->Descripcion;
		}
		$data['centros'] = $dataCentros;

		$dataPartidas = $this->mo_AdminComun->PartidasPresupuestalesSeleccionarTodos();
		foreach($dataPartidas as $key => $row){
			$dataPartidas[$key]->id = $row->IdPartidaPresupuestal;
			$dataPartidas[$key]->text = $row->Descripcion;
		}
		$data['partidas'] = $dataPartidas;

		$dataGrupos = $this->mo_AdminComun->CatalogoServiciosGrupoSeleccionarTodos();
		foreach($dataGrupos as $key => $row){
			$dataGrupos[$key]->id = $row->IdServicioGrupo;
			$dataGrupos[$key]->text = $row->Descripcion;
		}
		$data['grupos'] = $dataGrupos;

		$dataPuntos = $this->mo_AdminComun->SeleccionarPuntosDeCarga();
		foreach($dataPuntos as $key => $row){
			$dataPuntos[$key]->id = $row->IdPuntoCarga;
			$dataPuntos[$key]->text = $row->Descripcion;
		}
		$data['puntos'] = $dataPuntos;

		return $data;
	}

	private function getDataComboSubGrupo( $request )
	{
		$data = $this->mo_AdminComun->CatalogoServiciosSubGrupoSeleccionarPorGrupo( $request->id );
		foreach($data as $key => $row){
			$data[$key]->id = $row->IdServicioSubGrupo;
			$data[$key]->text = $row->Descripcion;
		}
		return $data;
	}

	private function getDataComboSeccion( $request )
	{
		$data = $this->mo_AdminComun->CatalogoServiciosSeccionSeleccionarPorSubGrupo( $request->id );
		foreach($data as $key => $row){
			$data[$key]->id = $row->IdServicioSeccion;
			$data[$key]->text = $row->Descripcion;
		}
		return $data;
	}

	private function getDataComboSubSeccion( $request )
	{
		$data = $this->mo_AdminComun->CatalogoServiciosSubSeccionSeleccionarPorSeccion( $request->id );
		foreach($data as $key => $row){
			$data[$key]->id = $row->IdServicioSubSeccion;
			$data[$key]->text = $row->Descripcion;
		}
		return $data;
	}

	private function getDataPrecios( $request )
	{
		$data = $this->mo_AdminComun->TiposFinanciamientoSegunFiltro("seIngresPrecios=1 and idTipoFinanciamiento>0");
		if($request->idProducto > 0){
			$oFactCatalogoServiciosPtos = $this->mo_ReglasFacturacion->CatalogoServiciosHospSeleccionarXidProducto($request->idProducto);
			foreach($oFactCatalogoServiciosPtos as $punto){
				foreach($data as $key => $precio){
					if($punto->IdTipoFinanciamiento == $precio->IdTipoFinanciamiento){
						$data[$key]->PrecioUnitario = $punto->PrecioUnitario;
						// $data[$key]->PrecioUnitario = 0;
						$data[$key]->SeUsaSinPrecio = $punto->SeUsaSinPrecio;
					}
				}
			}
		}
		return $data;
	}

	private function getDataPuntos( $request )
	{
		$oFactCatalogoServiciosPtos = $this->mo_AdminComun->FactCatalogoServiciosPtosSeleccionarXidProducto($request->idProducto);
		// dd($oFactCatalogoServiciosPtos);
		$data = [];
		foreach($oFactCatalogoServiciosPtos as $row){
			$lcIdServicio = $this->devuelveIdServicio($row->idPuntoCarga);
			array_push($data, [
				'idPuntoCarga' => $row->idPuntoCarga,
				'descripcion' => trim($row->Descripcion).$lcIdServicio,
				'esPreVenta' => $row->EsPreVenta,
				'tieneIdServicio' => $lcIdServicio? 1: 0, 
			]);
		}
		return $data;
	}

	private function ValidarDatosObligatorios( $request )
	{
		// dd($request->idServicioSubGrupo);
		if( $request->idServicioSubGrupo == ''){
			return 'Ingrese la categoria del producto';
		}
		if( trim($request->codigo) == ''){
			return 'Ingrese el codigo';
		}
		if( trim($request->nombre) == '' ){
			return 'Ingrese nombre (corto)';
		}
		if( trim($request->nombreMinsa) == ''){
			return 'Ingrese nombre (MINSA)';
		}
		if( trim($request->tipoServicio) == ''){
			return 'Elija el tipo';
		}
		if( $request->idPartida == ''){
			return 'Elija la partida';
		}
		return null;
	}

	private function ValidarReglas( $request, $mi_Opcion)
	{
		$sMensaje = '';
		// $mi_Opcion = 'sghAgregar';
		$validarReglas = false;
		$oRsBuscaCodigo = $this->mo_AdminComun->CatalogoServiciosSeleccionarPorCodigo($request->codigo);
		// dd($oRsBuscaCodigo);
		switch( $mi_Opcion )
		{
			case 'sghAgregar':
				if ( $this->validarDuplicadoServicio($oRsBuscaCodigo, 0) == false ){
					$sMensaje .= "Ese código y descripción corta ya esta Registrado para: ". $oRsBuscaCodigo[0]->Nombre;
				}
				// if ( count($oRsBuscaCodigo) > 0){
				// 	$sMensaje .=  "Ese código ya esta Registrado para: ".$oRsBuscaCodigo[0]->Nombre;
				// }
				break;
			case 'sghModificar':
				if( $this->validarDuplicadoServicio($oRsBuscaCodigo, $this->ml_IdProducto) == false){
					$sMensaje .= "Ese código y descripción corta ya esta Registrado para: ". $oRsBuscaCodigo[0]->Nombre;
				}
				// if ( count($oRsBuscaCodigo) > 0){
				// 	foreach($oRsBuscaCodigo as $row){
				// 		if( $row->Codigo == trim($request->codigo) && $row->idProducto <> $this->ml_IdProducto){
				// 			$sMensaje .=  "Ese código ya esta Registrado para: ".$oRsBuscaCodigo[0]->Nombre;
				// 		}
				// 	}
				// }

				if( strlen(trim($request->codigo)) > 7){
					$sMensaje .= 'El CODIGO no debe tener longitud mayor a 7';
				}
				break;
			case 'sghEliminar':
				
				$oRsBuscaCodigo = $this->mo_ReglasFacturacion->FacturacionServicioPagosSeleccionarXidProducto($this->ml_IdProducto );
				if ( count($oRsBuscaCodigo) > 0 ){
					$sMensaje .= 'Ese codigo Tiene Movimientos en tabla: FacturacionServicioPagos<br>';
				}else{
					$oRsBuscaCodigo = $this->mo_ReglasFacturacion->FacturacionServicioDespachoSeleccionarPorIdProducto($this->ml_IdProducto );
					if( count($oRsBuscaCodigo) >0 ){
						$sMensaje .= "Ese código Tiene Movimientos en tabla: FacturacionServicioDespacho <br>";
					}
				}
				break;
		}

		if( strlen(trim($request->codigo)) > 7){
			$sMensaje .= 'El CODIGO no debe tener longitud mayor a 7';
		}


		if( $mi_Opcion == 'sghAgregar' || $mi_Opcion == 'sghModificar'){
			foreach($request->puntosCarga as $row){
				$esPreVenta = isset($row['esPreVenta'])? 1: 0;
				if($esPreVenta == 1 && $row['tieneIdServicio'] == 0){
					$sMensaje .= "Para que sea 'Cabecera de Preventa', el Punto de Carga deberá tener un 'Id Servicio' <br>";
				}
			}
		}

		return $sMensaje;
	}

	private function validarDuplicadoServicio($oRsBuscaCodigo, $lIdProducto)
	{
		// dd( $oRsBuscaCodigo[0]->Codigo);
		// dd( request('codigo') );
		// dd( strnatcasecmp ($oRsBuscaCodigo[0]->Codigo, trim(request('codigo')) )==0 );
		// dd( $oRsBuscaCodigo[0]->IdProducto);
		// dd( $this->ml_IdProducto);
		foreach($oRsBuscaCodigo as $row){
			if( (strnatcasecmp ($row->Codigo, trim(request('codigo')) ) == 0) && $row->IdProducto <> $lIdProducto ){
				return false;
			}
		}
		return true;
	}

	private function CargaDatosAlObjetosDeDatos($request)
	{
		// dd($this->mo_CatalogoServicios);
		$this->mo_CatalogoServicios->idProducto = $this->ml_IdProducto;
        $this->mo_CatalogoServicios->codigo = $request->codigo;
        $this->mo_CatalogoServicios->nombre = $request->nombre;
        $this->mo_CatalogoServicios->idServicioGrupo = $request->idServicioGrupo;
        $this->mo_CatalogoServicios->idServicioSubGrupo = $request->idServicioSubGrupo;
        $this->mo_CatalogoServicios->idServicioSeccion = $request->idServicioSeccion;
        $this->mo_CatalogoServicios->idServicioSubSeccion = $request->idServicioSubSeccion;
        $this->mo_CatalogoServicios->idPartida = $request->idPartida;
        $this->mo_CatalogoServicios->idCentroCosto = $request->idCentroCosto;
        $this->mo_CatalogoServicios->idUsuarioAuditoria = $this->user->id;
        $this->mo_CatalogoServicios->esCpt = $request->tipoServicio=='S'? 1: 0;
        $this->mo_CatalogoServicios->nombreMINSA = $request->nombreMinsa;
        $this->mo_CatalogoServicios->idEstado = $request->estado? 1: 0;
		$this->mo_CatalogoServicios->codigoSIS = $request->codigoSis;
		// dd($this->mo_CatalogoServicios);

		$puntosCarga = $request->puntosCarga;
		if( $puntosCarga ){
			foreach( $puntosCarga as $row){
				$row = json_decode( json_encode($row) );
				$row->esPreVenta = isset($row->esPreVenta)? 1: 0;
				$this->mrs_PuntosCarga->push($row);
			}
		}

		$precios = $request->precios;
		if( $precios ){
			foreach( $precios as $row){
				$row = json_decode( json_encode($row) );
				$row->seUsaSinPrecio = isset($row->seUsaSinPrecio)? 1: 0;
				$this->mrs_Precios->push($row);
			}
		}
	}

	private function AgregarDatos( $request )
	{
		$this->CargaDatosAlObjetosDeDatos($request);
		// dd( $this->mrs_PuntosCarga );

		$agregaServicio = $this->mo_AdminComun->CatalogoServiciosAgregar(
			$this->mo_CatalogoServicios, //ByRef
			$this->mrs_PuntosCarga, 
			$this->idListBar,
			nombrePc(),
			trim($request->codigo).' '.$request->nombre
		);

		if( $this->mo_CatalogoServicios->idProducto >0 ){
			
			//Graba precios
			$oDOFactCatalogoServiciosHosp = new DOFactCatalogoServiciosHosp;
			$oFactCatalogoServiciosHosp = new FactCatalogoServiciosHosp;
			
			$misPrecios = $request->precios;
			foreach( $this->mrs_Precios as $row){
				$lnPrecio = $row->precioUnitario;
				$oRsTmp = $this->mo_ReglasFacturacion->CatalogoServiciosHospSeleccionarXidProductoIdTipoFinanciamiento($this->mo_CatalogoServicios->idProducto, $row->idTipoFinanciamiento);
				// dd( $oRsTmp);
				if(count($oRsTmp) > 0){
					if( $row->precioUnitario > 0 || $row->seUsaSinPrecio == 0){
						$oDOFactCatalogoServiciosHosp->idFinanciamientoCatalogo = $oRsTmp[0]->IdFinanciamientoCatalogo;
						 
						if( $oFactCatalogoServiciosHosp->SeleccionarPorId($oDOFactCatalogoServiciosHosp) == true){
							$oDOFactCatalogoServiciosHosp->PrecioUnitario = $lnPrecio;
							$oDOFactCatalogoServiciosHosp->SeUsaSinPrecio = $mrs_Precios[0]->SeUsaSinPrecio==true? 1: 0;
							if( $oFactCatalogoServiciosHosp->Modificar($oDOFactCatalogoServiciosHosp) == false ){
								$MsgBox = 'oFactCatalogoServiciosHosp.MensajeError: Exit Function';
							}
						}
					}else if( count($oRsTmp) > 0 || $row['seUsaSinPrecio'] == 0 ){
						$oDOFactCatalogoServiciosHosp->IdFinanciamientoCatalogo = $oRsTmp[0]->IdFinanciamientoCatalogo;
						if ( $oFactCatalogoServiciosHosp->Eliminar($oDOFactCatalogoServiciosHosp) == false) {
							$MsgBox ='oFactCatalogoServiciosHosp.MensajeError: Exit Function';
						}					
					}
				}else {
					if( $row->precioUnitario > 0 or $row->seUsaSinPrecio==1) {
						$oDOFactCatalogoServiciosHosp->precioUnitario = $lnPrecio;
						$oDOFactCatalogoServiciosHosp->idProducto = $this->mo_CatalogoServicios->idProducto;
						$oDOFactCatalogoServiciosHosp->idTipoFinanciamiento = $row->idTipoFinanciamiento;
						$oDOFactCatalogoServiciosHosp->activo = 1;
						$oDOFactCatalogoServiciosHosp->seUsaSinPrecio = $row->seUsaSinPrecio;
						$servicioHospInsertar = $oFactCatalogoServiciosHosp->Insertar($oDOFactCatalogoServiciosHosp);
						// dd($servicioHospInsertar);
					}
				}
				
			}
			return true;
		}
		
	}

	private function devuelveIdServicio( $lnIdPuntoCarga )
	{
		$lcIdServicio = '';
		$oRsTmp = $this->mo_AdminComun->FactPuntosCargaSeleccionarPorId($lnIdPuntoCarga);
		if( count($oRsTmp) >0 ){
			$lcIdServicio = "(Serv=".trim($oRsTmp[0]->idServicio).")";
		}
		return $lcIdServicio;
	}

	private function ModificarDatos( $request )
	{
		$this->CargaDatosAlObjetosDeDatos($request);

		$modificarDatos = $this->mo_AdminComun->CatalogoServiciosModificar(
			$this->mo_CatalogoServicios, 
			$this->mrs_PuntosCarga, 
			$this->idListBar, 
			nombrePc(),
			trim($request->codigo).' '.$request->nombre
		);

		$oDOFactCatalogoServiciosHosp = new DOFactCatalogoServiciosHosp;
		$oFactCatalogoServiciosHosp = new FactCatalogoServiciosHosp;

		foreach( $this->mrs_Precios as $row){
			$lnPrecio = $row->precioUnitario;
			$oRsTmp = $this->mo_ReglasFacturacion->CatalogoServiciosHospSeleccionarXidProductoIdTipoFinanciamiento($this->mo_CatalogoServicios->idProducto, $row->idTipoFinanciamiento);
			// dd( $oRsTmp);
			if(count($oRsTmp) > 0){
				if( $row->precioUnitario > 0 or $row->seUsaSinPrecio == 1){
					$oDOFactCatalogoServiciosHosp->idFinanciamientoCatalogo = $oRsTmp[0]->IdFinanciamientoCatalogo;
					// $oDOFactCatalogoServiciosHosp->idFinanciamientoCatalogo = 0;
					$servicioData = $oFactCatalogoServiciosHosp->SeleccionarPorId($oDOFactCatalogoServiciosHosp);
					// dd($servicioFind);
					if( count($servicioData) == 1){
						$oDOFactCatalogoServiciosHosp->precioUnitario = $lnPrecio;
						$oDOFactCatalogoServiciosHosp->seUsaSinPrecio = $row->seUsaSinPrecio;
						$oDOFactCatalogoServiciosHosp->idProducto = $servicioData[0]->IdProducto;
						$oDOFactCatalogoServiciosHosp->idTipoFinanciamiento = $servicioData[0]->IdTipoFinanciamiento;
						$oDOFactCatalogoServiciosHosp->activo = $servicioData[0]->Activo;
						// dd($oDOFactCatalogoServiciosHosp);
						// dd($servicioData);
						// $oDOFactCatalogoServiciosHosp->idFinanciamientoCatalogo = 0;
						$modificarServicioHosp = $oFactCatalogoServiciosHosp->Modificar($oDOFactCatalogoServiciosHosp);
						// dd($modificarServicioHosp);
					}
				}else if( count($oRsTmp) > 0 || $row->seUsaSinPrecio == 0 ){
					$oDOFactCatalogoServiciosHosp->idFinanciamientoCatalogo = $oRsTmp[0]->IdFinanciamientoCatalogo;
					$eliminarServicioHosp = $oFactCatalogoServiciosHosp->Eliminar($oDOFactCatalogoServiciosHosp);
					// dd($eliminarServicioHosp);
				}
			}else {
				if( $row->precioUnitario > 0 or $row->seUsaSinPrecio==1) {
					$oDOFactCatalogoServiciosHosp->precioUnitario = $lnPrecio;
					$oDOFactCatalogoServiciosHosp->idProducto = $this->mo_CatalogoServicios->idProducto;
					$oDOFactCatalogoServiciosHosp->idTipoFinanciamiento = $row->idTipoFinanciamiento;
					$oDOFactCatalogoServiciosHosp->activo = 1;
					$oDOFactCatalogoServiciosHosp->seUsaSinPrecio = $row->seUsaSinPrecio;
					$servicioHospInsertar = $oFactCatalogoServiciosHosp->Insertar($oDOFactCatalogoServiciosHosp);
					// dd($servicioHospInsertar);
				}
			}
			
		}
		return true;
		// dd('termina');
	}

	private function EliminarDatos( $request )
	{
		$this->mo_CatalogoServicios->idProducto = $this->ml_IdProducto;
		$this->mo_CatalogoServicios->idUsuarioAuditoria = $this->user->id;

		$oRsTmp = $this->mo_ReglasFacturacion->CatalogoServiciosHospEliminarXidProducto($this->ml_IdProducto);
		// dd( $oRsTmp );
		$eliminarServicio = $this->mo_AdminComun->CatalogoServiciosEliminar(
			$this->mo_CatalogoServicios, 
			$this->idListBar,
			nombrePc(), 
			trim($request->codigo).' '.$request->nombre
		);
		// dd( $eliminarServicio );
		return true;
	}
}