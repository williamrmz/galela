<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FacturacionBienesInsumos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idFacturacionBienes AS Int = :idFacturacionBienes
			SET NOCOUNT ON 
			EXEC FacturacionBienesInsumosAgregar :idUsuarioAutorizaPendiente, :idProducto, :precioUnitario, :cantidad, :idEstadoFacturacion, :idPartidaPresupuestal, :idCentroCosto, :idTipoFinanciamiento, :idFuenteFinanciamiento, :totalPorPagar, :idReceta, :idComprobantePago, @idFacturacionBienes OUTPUT, :idUsuarioAutorizaSeguro, :idOrden, :idUsuarioAutorizaDevolucion, :idCajero, :fechaAutorizaSeguro, :fechaAutorizaPendiente, :fechaAutorizaDevolucion, :fechaCajero, :idComprobantePagoDevolucion, :idPuntoCarga, :fechaCreacion, :fechaModificacion, :idUsuarioCrea, :idusuarioModifica, :idAtencion, :idUsuarioAuditoria, :importeSIS, :importeEXO, :idUsuarioAutorizaEXO, :fechaAutorizaEXO, :importeSOAT, :totalPagar, :cantidadSIS, :precioSIS, :cantidadSOAT, :precioSOAT, :cantidadPagar, :cantidadDev, :fechaAutorizaConv, :cantidadConv, :precConv, :importeConv
			SELECT @idFacturacionBienes AS idFacturacionBienes";

		$params = [
			'idUsuarioAutorizaPendiente' => ($oTabla->idUsuarioAutorizaPendiente == 0)? Null: $oTabla->idUsuarioAutorizaPendiente, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'precioUnitario' => ($oTabla->precioUnitario == 0)? Null: $oTabla->precioUnitario, 
			'cantidad' => ($oTabla->cantidad == 0)? Null: $oTabla->cantidad, 
			'idEstadoFacturacion' => ($oTabla->idEstadoFacturacion == 0)? Null: $oTabla->idEstadoFacturacion, 
			'idPartidaPresupuestal' => ($oTabla->idPartidaPresupuestal == 0)? Null: $oTabla->idPartidaPresupuestal, 
			'idCentroCosto' => ($oTabla->idCentroCosto == 0)? Null: $oTabla->idCentroCosto, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'totalPorPagar' => ($oTabla->totalPorPagar == 0)? Null: $oTabla->totalPorPagar, 
			'idReceta' => ($oTabla->idReceta == 0)? Null: $oTabla->idReceta, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idFacturacionBienes' => 0, 
			'idUsuarioAutorizaSeguro' => ($oTabla->idUsuarioAutorizaSeguro == 0)? Null: $oTabla->idUsuarioAutorizaSeguro, 
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idUsuarioAutorizaDevolucion' => ($oTabla->idUsuarioAutorizaDevolucion == 0)? Null: $oTabla->idUsuarioAutorizaDevolucion, 
			'idCajero' => ($oTabla->idCajero == 0)? Null: $oTabla->idCajero, 
			'fechaAutorizaSeguro' => ($oTabla->fechaAutorizaSeguro == 0)? Null: $oTabla->fechaAutorizaSeguro, 
			'fechaAutorizaPendiente' => ($oTabla->fechaAutorizaPendiente == 0)? Null: $oTabla->fechaAutorizaPendiente, 
			'fechaAutorizaDevolucion' => ($oTabla->fechaAutorizaDevolucion == 0)? Null: $oTabla->fechaAutorizaDevolucion, 
			'fechaCajero' => ($oTabla->fechaCajero == 0)? Null: $oTabla->fechaCajero, 
			'idComprobantePagoDevolucion' => ($oTabla->idComprobantePagoDevolucion == 0)? Null: $oTabla->idComprobantePagoDevolucion, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'fechaModificacion' => ($oTabla->fechaModificacion == 0)? Null: $oTabla->fechaModificacion, 
			'idUsuarioCrea' => ($oTabla->idUsuarioCrea == 0)? Null: $oTabla->idUsuarioCrea, 
			'idusuarioModifica' => ($oTabla->idUsuarioModifica == 0)? Null: $oTabla->idUsuarioModifica, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'importeSIS' => ($oTabla->importeSIS == 0)? Null: $oTabla->importeSIS, 
			'importeEXO' => ($oTabla->importeEXO == 0)? Null: $oTabla->importeEXO, 
			'idUsuarioAutorizaEXO' => ($oTabla->idUsuarioAutorizaEXO == 0)? Null: $oTabla->idUsuarioAutorizaEXO, 
			'fechaAutorizaEXO' => ($oTabla->fechaAutorizaEXO == 0)? Null: $oTabla->fechaAutorizaEXO, 
			'importeSOAT' => ($oTabla->importeSOAT == 0)? Null: $oTabla->importeSOAT, 
			'totalPagar' => ($oTabla->totalPagar == 0)? Null: $oTabla->totalPagar, 
			'cantidadSIS' => ($oTabla->cantidadSIS == 0)? Null: $oTabla->cantidadSIS, 
			'precioSIS' => ($oTabla->precioSIS == 0)? Null: $oTabla->precioSIS, 
			'cantidadSOAT' => ($oTabla->cantidadSOAT == 0)? Null: $oTabla->cantidadSOAT, 
			'precioSOAT' => ($oTabla->precioSOAT == 0)? Null: $oTabla->precioSOAT, 
			'cantidadPagar' => ($oTabla->cantidadPagar == 0)? Null: $oTabla->cantidadPagar, 
			'cantidadDev' => ($oTabla->cantidadDev == 0)? Null: $oTabla->cantidadDev, 
			'fechaAutorizaConv' => ($oTabla->fechaAutorizaConv == 0)? Null: $oTabla->fechaAutorizaConv, 
			'cantidadConv' => ($oTabla->cantidadConv == 0)? Null: $oTabla->cantidadConv, 
			'precConv' => ($oTabla->precConv == 0)? Null: $oTabla->precConv, 
			'importeConv' => ($oTabla->importeConv == 0)? Null: $oTabla->importeConv, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FacturacionBienesInsumosModificar :idUsuarioAutorizaPendiente, :idProducto, :precioUnitario, :cantidad, :idEstadoFacturacion, :idPartidaPresupuestal, :idCentroCosto, :idTipoFinanciamiento, :idFuenteFinanciamiento, :totalPorPagar, :idReceta, :idComprobantePago, :idFacturacionBienes, :idUsuarioAutorizaSeguro, :idOrden, :idUsuarioAutorizaDevolucion, :idCajero, :fechaAutorizaSeguro, :fechaAutorizaPendiente, :fechaAutorizaDevolucion, :fechaCajero, :idComprobantePagoDevolucion, :idPuntoCarga, :fechaCreacion, :fechaModificacion, :idUsuarioCrea, :idusuarioModifica, :idAtencion, :idUsuarioAuditoria, :importeSIS, :importeEXO, :idUsuarioAutorizaEXO, :fechaAutorizaEXO, :importeSOAT, :totalPagar, :cantidadSIS, :precioSIS, :cantidadSOAT, :precioSOAT, :cantidadPagar, :cantidadDev, :fechaAutorizaConv, :cantidadConv, :precConv, :importeConv";

		$params = [
			'idUsuarioAutorizaPendiente' => ($oTabla->idUsuarioAutorizaPendiente == 0)? Null: $oTabla->idUsuarioAutorizaPendiente, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'precioUnitario' => ($oTabla->precioUnitario == 0)? Null: $oTabla->precioUnitario, 
			'cantidad' => ($oTabla->cantidad == 0)? Null: $oTabla->cantidad, 
			'idEstadoFacturacion' => ($oTabla->idEstadoFacturacion == 0)? Null: $oTabla->idEstadoFacturacion, 
			'idPartidaPresupuestal' => ($oTabla->idPartidaPresupuestal == 0)? Null: $oTabla->idPartidaPresupuestal, 
			'idCentroCosto' => ($oTabla->idCentroCosto == 0)? Null: $oTabla->idCentroCosto, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'totalPorPagar' => ($oTabla->totalPorPagar == 0)? Null: $oTabla->totalPorPagar, 
			'idReceta' => ($oTabla->idReceta == 0)? Null: $oTabla->idReceta, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idFacturacionBienes' => ($oTabla->idFacturacionBienes == 0)? Null: $oTabla->idFacturacionBienes, 
			'idUsuarioAutorizaSeguro' => ($oTabla->idUsuarioAutorizaSeguro == 0)? Null: $oTabla->idUsuarioAutorizaSeguro, 
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idUsuarioAutorizaDevolucion' => ($oTabla->idUsuarioAutorizaDevolucion == 0)? Null: $oTabla->idUsuarioAutorizaDevolucion, 
			'idCajero' => ($oTabla->idCajero == 0)? Null: $oTabla->idCajero, 
			'fechaAutorizaSeguro' => ($oTabla->fechaAutorizaSeguro == 0)? Null: $oTabla->fechaAutorizaSeguro, 
			'fechaAutorizaPendiente' => ($oTabla->fechaAutorizaPendiente == 0)? Null: $oTabla->fechaAutorizaPendiente, 
			'fechaAutorizaDevolucion' => ($oTabla->fechaAutorizaDevolucion == 0)? Null: $oTabla->fechaAutorizaDevolucion, 
			'fechaCajero' => ($oTabla->fechaCajero == 0)? Null: $oTabla->fechaCajero, 
			'idComprobantePagoDevolucion' => ($oTabla->idComprobantePagoDevolucion == 0)? Null: $oTabla->idComprobantePagoDevolucion, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'fechaModificacion' => ($oTabla->fechaModificacion == 0)? Null: $oTabla->fechaModificacion, 
			'idUsuarioCrea' => ($oTabla->idUsuarioCrea == 0)? Null: $oTabla->idUsuarioCrea, 
			'idusuarioModifica' => ($oTabla->idUsuarioModifica == 0)? Null: $oTabla->idUsuarioModifica, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'importeSIS' => ($oTabla->importeSIS == 0)? Null: $oTabla->importeSIS, 
			'importeEXO' => ($oTabla->importeEXO == 0)? Null: $oTabla->importeEXO, 
			'idUsuarioAutorizaEXO' => ($oTabla->idUsuarioAutorizaEXO == 0)? Null: $oTabla->idUsuarioAutorizaEXO, 
			'fechaAutorizaEXO' => ($oTabla->fechaAutorizaEXO == 0)? Null: $oTabla->fechaAutorizaEXO, 
			'importeSOAT' => ($oTabla->importeSOAT == 0)? Null: $oTabla->importeSOAT, 
			'totalPagar' => ($oTabla->totalPagar == 0)? Null: $oTabla->totalPagar, 
			'cantidadSIS' => ($oTabla->cantidadSIS == 0)? Null: $oTabla->cantidadSIS, 
			'precioSIS' => ($oTabla->precioSIS == 0)? Null: $oTabla->precioSIS, 
			'cantidadSOAT' => ($oTabla->cantidadSOAT == 0)? Null: $oTabla->cantidadSOAT, 
			'precioSOAT' => ($oTabla->precioSOAT == 0)? Null: $oTabla->precioSOAT, 
			'cantidadPagar' => ($oTabla->cantidadPagar == 0)? Null: $oTabla->cantidadPagar, 
			'cantidadDev' => ($oTabla->cantidadDev == 0)? Null: $oTabla->cantidadDev, 
			'fechaAutorizaConv' => ($oTabla->fechaAutorizaConv == 0)? Null: $oTabla->fechaAutorizaConv, 
			'cantidadConv' => ($oTabla->cantidadConv == 0)? Null: $oTabla->cantidadConv, 
			'precConv' => ($oTabla->precConv == 0)? Null: $oTabla->precConv, 
			'importeConv' => ($oTabla->importeConv == 0)? Null: $oTabla->importeConv, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FacturacionBienesInsumosEliminar :idFacturacionBienes, :idUsuarioAuditoria";

		$params = [
			'idFacturacionBienes' => ($oTabla->idFacturacionBienes == 0)? Null: $oTabla->idFacturacionBienes, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FacturacionBienesInsumosSeleccionarPorId :idFacturacionBienes";

		$params = [
			'idFacturacionBienes' => $oTabla->idFacturacionBienes, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarParaPendientePago($lIdCuentaAtencion)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarParaEstadoCuenta($lIdCuentaAtencion)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarParaCaja($lIdCuentaAtencion)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarPorIdAtencion($lIdAtencion)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCuentaAtencionParaEstadoCuenta($idCuentaAtencion, $idPuntosDeCarga, $lEstadosFacturacion)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCodigoDEBB($codigo, $lIdTipoFinanciamiento, $lIdPuntoCarga)
	{
		$query = "
			EXEC FactCatalogoBienesInsumosSeleccionarPorCodigo :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCodigo($codigo, $idTipoFinanciamiento)
	{
		$query = "
			EXEC FactCatalogoBienesInsumosXcodigoYtipofinanciamiento :idTipoFinanciamiento, :codigo";

		$params = [
			'idTipoFinanciamiento' => $idTipoFinanciamiento, 
			'codigo' => $codigo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function InsertarBienInsumoSP($oTabla, &$sResultado)
	{
		$query = "
			DECLARE @idFacturacionBienes AS Int = :idFacturacionBienes
			DECLARE @result AS VarChar = :result
			SET NOCOUNT ON 
			EXEC FacturacionBienesAgregarV2 @idFacturacionBienes OUTPUT, @result OUTPUT, :idProducto, :cantidad, :idEstadoFacturacion, :idFuenteFinanciamiento, :idTipoFinanciamiento, :idComprobantePago, :idPuntoCarga, :idOrden, :idUsuarioAutorizaSeguro, :idUsuarioAutorizaPendiente, :idUsuarioAutorizaDevolucion, :idCajero, :fechaAutorizaSeguro, :fechaAutorizaPendiente, :fechaAutorizaDevolucion, :fechaCajero, :idAtencion, :idUsuarioAuditoria, :importeSIS, :importeEXO, :idUsuarioAutorizaEXO, :fechaAutorizaEXO, :importeSOAT, :totalPagar, :cantidadSIS, :precioSIS, :cantidadSOAT, :precioSOAT, :cantidadPagar, :cantidadDev, :fechaAutorizaConv, :cantidadConv, :precConv, :importeConv
			SELECT @idFacturacionBienes AS idFacturacionBienes, @result AS result";

		$params = [
			'idFacturacionBienes' => 0, 
			'result' => 0, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cantidad' => ($oTabla->cantidad == 0)? 0: $oTabla->cantidad, 
			'idEstadoFacturacion' => ($oTabla->idEstadoFacturacion == 0)? Null: $oTabla->idEstadoFacturacion, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idUsuarioAutorizaSeguro' => ($oTabla->idUsuarioAutorizaSeguro == 0)? Null: $oTabla->idUsuarioAutorizaSeguro, 
			'idUsuarioAutorizaPendiente' => ($oTabla->idUsuarioAutorizaPendiente == 0)? Null: $oTabla->idUsuarioAutorizaPendiente, 
			'idUsuarioAutorizaDevolucion' => ($oTabla->idUsuarioAutorizaDevolucion == 0)? Null: $oTabla->idUsuarioAutorizaDevolucion, 
			'idCajero' => ($oTabla->idCajero == 0)? Null: $oTabla->idCajero, 
			'fechaAutorizaSeguro' => ($oTabla->fechaAutorizaSeguro == 0)? Null: $oTabla->fechaAutorizaSeguro, 
			'fechaAutorizaPendiente' => ($oTabla->fechaAutorizaPendiente == 0)? Null: $oTabla->fechaAutorizaPendiente, 
			'fechaAutorizaDevolucion' => ($oTabla->fechaAutorizaDevolucion == 0)? Null: $oTabla->fechaAutorizaDevolucion, 
			'fechaCajero' => ($oTabla->fechaCajero == 0)? Null: $oTabla->fechaCajero, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idUsuarioAuditoria' => ($oTabla->idUsuarioAuditoria == 0)? Null: $oTabla->idUsuarioAuditoria, 
			'importeSIS' => ($oTabla->importeSIS == 0)? Null: $oTabla->importeSIS, 
			'importeEXO' => ($oTabla->importeEXO == 0)? Null: $oTabla->importeEXO, 
			'idUsuarioAutorizaEXO' => ($oTabla->idUsuarioAutorizaEXO == 0)? Null: $oTabla->idUsuarioAutorizaEXO, 
			'fechaAutorizaEXO' => ($oTabla->fechaAutorizaEXO == 0)? Null: $oTabla->fechaAutorizaEXO, 
			'importeSOAT' => ($oTabla->importeSOAT == 0)? Null: $oTabla->importeSOAT, 
			'totalPagar' => ($oTabla->totalPagar == 0)? Null: $oTabla->totalPagar, 
			'cantidadSIS' => ($oTabla->cantidadSIS == 0)? 0: $oTabla->cantidadSIS, 
			'precioSIS' => ($oTabla->precioSIS == 0)? Null: $oTabla->precioSIS, 
			'cantidadSOAT' => ($oTabla->cantidadSOAT == 0)? 0: $oTabla->cantidadSOAT, 
			'precioSOAT' => ($oTabla->precioSOAT == 0)? Null: $oTabla->precioSOAT, 
			'cantidadPagar' => ($oTabla->cantidadPagar == 0)? Null: $oTabla->cantidadPagar, 
			'cantidadDev' => ($oTabla->cantidadDev == 0)? 0: $oTabla->cantidadDev, 
			'fechaAutorizaConv' => ($oTabla->fechaAutorizaConv == 0)? Null: $oTabla->fechaAutorizaConv, 
			'cantidadConv' => ($oTabla->cantidadConv == 0)? 0: $oTabla->cantidadConv, 
			'precConv' => ($oTabla->precConv == 0)? Null: $oTabla->precConv, 
			'importeConv' => ($oTabla->importeConv == 0)? Null: $oTabla->importeConv, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function ModificarBienInsumoSP($oTabla, &$sResultado)
	{
		$query = "
			DECLARE @result AS VarChar = :result
			SET NOCOUNT ON 
			EXEC FacturacionBienesModificarV2 :idFacturacionBienes, @result OUTPUT, :idProducto, :cantidad, :idEstadoFacturacion, :idFuenteFinanciamiento, :idTipoFinanciamiento, :idComprobantePago, :idPuntoCarga, :idOrden, :idUsuarioAutorizaSeguro, :idUsuarioAutorizaPendiente, :idUsuarioAutorizaDevolucion, :idCajero, :fechaAutorizaSeguro, :fechaAutorizaPendiente, :fechaAutorizaDevolucion, :fechaCajero, :idAtencion, :idComprobantePagoDevolucion, :idUsuarioAuditoria, :importeSIS, :importeEXO, :idUsuarioAutorizaEXO, :fechaAutorizaEXO, :importeSOAT, :cantidadSIS, :precioSIS, :cantidadSOAT, :precioSOAT, :cantidadDev, :fechaAutorizaConv, :cantidadConv, :precConv, :importeConv
			SELECT @result AS result";

		$params = [
			'idFacturacionBienes' => ($oTabla->idFacturacionBienes == 0)? Null: $oTabla->idFacturacionBienes, 
			'result' => 0, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cantidad' => ($oTabla->cantidad == 0)? 0: $oTabla->cantidad, 
			'idEstadoFacturacion' => ($oTabla->idEstadoFacturacion == 0)? Null: $oTabla->idEstadoFacturacion, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idUsuarioAutorizaSeguro' => ($oTabla->idUsuarioAutorizaSeguro == 0)? Null: $oTabla->idUsuarioAutorizaSeguro, 
			'idUsuarioAutorizaPendiente' => ($oTabla->idUsuarioAutorizaPendiente == 0)? Null: $oTabla->idUsuarioAutorizaPendiente, 
			'idUsuarioAutorizaDevolucion' => ($oTabla->idUsuarioAutorizaDevolucion == 0)? Null: $oTabla->idUsuarioAutorizaDevolucion, 
			'idCajero' => ($oTabla->idCajero == 0)? Null: $oTabla->idCajero, 
			'fechaAutorizaSeguro' => ($oTabla->fechaAutorizaSeguro == 0)? Null: $oTabla->fechaAutorizaSeguro, 
			'fechaAutorizaPendiente' => ($oTabla->fechaAutorizaPendiente == 0)? Null: $oTabla->fechaAutorizaPendiente, 
			'fechaAutorizaDevolucion' => ($oTabla->fechaAutorizaDevolucion == 0)? Null: $oTabla->fechaAutorizaDevolucion, 
			'fechaCajero' => ($oTabla->fechaCajero == 0)? Null: $oTabla->fechaCajero, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idComprobantePagoDevolucion' => ($oTabla->idComprobantePagoDevolucion == 0)? Null: $oTabla->idComprobantePagoDevolucion, 
			'idUsuarioAuditoria' => ($oTabla->idUsuarioAuditoria == 0)? Null: $oTabla->idUsuarioAuditoria, 
			'importeSIS' => ($oTabla->importeSIS == 0)? Null: $oTabla->importeSIS, 
			'importeEXO' => ($oTabla->importeEXO == 0)? Null: $oTabla->importeEXO, 
			'idUsuarioAutorizaEXO' => ($oTabla->idUsuarioAutorizaEXO == 0)? Null: $oTabla->idUsuarioAutorizaEXO, 
			'fechaAutorizaEXO' => ($oTabla->fechaAutorizaEXO == 0)? Null: $oTabla->fechaAutorizaEXO, 
			'importeSOAT' => ($oTabla->importeSOAT == 0)? Null: $oTabla->importeSOAT, 
			'cantidadSIS' => ($oTabla->cantidadSIS == 0)? 0: $oTabla->cantidadSIS, 
			'precioSIS' => ($oTabla->precioSIS == 0)? Null: $oTabla->precioSIS, 
			'cantidadSOAT' => ($oTabla->cantidadSOAT == 0)? 0: $oTabla->cantidadSOAT, 
			'precioSOAT' => ($oTabla->precioSOAT == 0)? Null: $oTabla->precioSOAT, 
			'cantidadDev' => ($oTabla->cantidadDev == 0)? 0: $oTabla->cantidadDev, 
			'fechaAutorizaConv' => ($oTabla->fechaAutorizaConv == 0)? Null: $oTabla->fechaAutorizaConv, 
			'cantidadConv' => ($oTabla->cantidadConv == 0)? 0: $oTabla->cantidadConv, 
			'precConv' => ($oTabla->precConv == 0)? Null: $oTabla->precConv, 
			'importeConv' => ($oTabla->importeConv == 0)? Null: $oTabla->importeConv, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function EliminarBienSP($oTabla, &$sResultado)
	{
		$query = "
			EXEC FacturacionBienesEliminarBien :idAtencion, :idProducto, :idUsuarioAuditoria";

		$params = [
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorOrdenAtencion($idOrden, $sEstadosFacturacion, $sTiposFinanciamiento)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCuentaAtencion($idCuentaAtencion, $sEstadosFacturacion, $sTiposFinanciamiento, $lIdAgrupador)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCuentaAtencionDEBB($idCuentaAtencion, $sEstadosFacturacion, $sTiposFinanciamiento, $lIdAgrupador)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDevolucionPorIdComprobante($lIdComprobanteDevolucion)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}