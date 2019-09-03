<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FacturacionServicios extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idFacturacionServicio AS Int = :idFacturacionServicio
			SET NOCOUNT ON 
			EXEC FacturacionServiciosAgregar :fechaCreacion, :idProducto, :precioUnitario, :idEstadoFacturacion, :idFuenteFinanciamiento, :idTipoFinanciamiento, :idPartidaPresupuestal, :idCentroCosto, :idServicioInternamiento, :idComprobantePago, :totalPorPagar, :idAtencion, @idFacturacionServicio OUTPUT, :idUsuarioModifica, :idPuntoCarga, :fechaModificacion, :idOrden, :idUsuarioAutorizaSeguro, :idUsuarioAutorizaPendiente, :idUsuarioAutorizaDevolucion, :idCajero, :fechaAutorizaSeguro, :fechaAutorizaPendiente, :fechaAutorizaDevolucion, :fechaCajero, :idComprobantePagoDevolucion, :cantidad, :idUsuarioCrea, :idUsuarioAuditoria, :importeSIS, :importeEXO, :idUsuarioAutorizaEXO, :fechaAutorizaEXO, :importeSOAT, :totalPagar, :cantidadSIS, :precioSIS, :cantidadSOAT, :precioSOAT, :cantidadPagar, :cantidadDev, :fechaAutorizaConv, :cantidadConv, :precConv, :importeConv
			SELECT @idFacturacionServicio AS idFacturacionServicio";

		$params = [
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'precioUnitario' => ($oTabla->precioUnitario == 0)? Null: $oTabla->precioUnitario, 
			'idEstadoFacturacion' => ($oTabla->idEstadoFacturacion == 0)? Null: $oTabla->idEstadoFacturacion, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idPartidaPresupuestal' => ($oTabla->idPartidaPresupuestal == 0)? Null: $oTabla->idPartidaPresupuestal, 
			'idCentroCosto' => ($oTabla->idCentroCosto == 0)? Null: $oTabla->idCentroCosto, 
			'idServicioInternamiento' => ($oTabla->idServicioInternamiento == 0)? Null: $oTabla->idServicioInternamiento, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'totalPorPagar' => ($oTabla->totalPorPagar == 0)? Null: $oTabla->totalPorPagar, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idFacturacionServicio' => 0, 
			'idUsuarioModifica' => ($oTabla->idUsuarioModifica == 0)? Null: $oTabla->idUsuarioModifica, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'fechaModificacion' => ($oTabla->fechaModificacion == 0)? Null: $oTabla->fechaModificacion, 
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idUsuarioAutorizaSeguro' => ($oTabla->idUsuarioAutorizaSeguro == 0)? Null: $oTabla->idUsuarioAutorizaSeguro, 
			'idUsuarioAutorizaPendiente' => ($oTabla->idUsuarioAutorizaPendiente == 0)? Null: $oTabla->idUsuarioAutorizaPendiente, 
			'idUsuarioAutorizaDevolucion' => ($oTabla->idUsuarioAutorizaDevolucion == 0)? Null: $oTabla->idUsuarioAutorizaDevolucion, 
			'idCajero' => ($oTabla->idCajero == 0)? Null: $oTabla->idCajero, 
			'fechaAutorizaSeguro' => ($oTabla->fechaAutorizaSeguro == 0)? Null: $oTabla->fechaAutorizaSeguro, 
			'fechaAutorizaPendiente' => ($oTabla->fechaAutorizaPendiente == 0)? Null: $oTabla->fechaAutorizaPendiente, 
			'fechaAutorizaDevolucion' => ($oTabla->fechaAutorizaDevolucion == 0)? Null: $oTabla->fechaAutorizaDevolucion, 
			'fechaCajero' => ($oTabla->fechaCajero == 0)? Null: $oTabla->fechaCajero, 
			'idComprobantePagoDevolucion' => ($oTabla->idComprobantePagoDevolucion == 0)? Null: $oTabla->idComprobantePagoDevolucion, 
			'cantidad' => ($oTabla->cantidad == 0)? 0: $oTabla->cantidad, 
			'idUsuarioCrea' => ($oTabla->idUsuarioCrea == 0)? Null: $oTabla->idUsuarioCrea, 
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
			EXEC FacturacionServiciosModificar :fechaCreacion, :idProducto, :precioUnitario, :idEstadoFacturacion, :idFuenteFinanciamiento, :idTipoFinanciamiento, :idPartidaPresupuestal, :idCentroCosto, :idServicioInternamiento, :idComprobantePago, :totalPorPagar, :idAtencion, :idFacturacionServicio, :idUsuarioModifica, :idPuntoCarga, :fechaModificacion, :idOrden, :idUsuarioAutorizaSeguro, :idUsuarioAutorizaPendiente, :idUsuarioAutorizaDevolucion, :idCajero, :fechaAutorizaSeguro, :fechaAutorizaPendiente, :fechaAutorizaDevolucion, :fechaCajero, :idComprobantePagoDevolucion, :cantidad, :idUsuarioCrea, :idUsuarioAuditoria, :importeSIS, :importeEXO, :idUsuarioAutorizaEXO, :fechaAutorizaEXO, :importeSOAT, :totalPagar, :cantidadSIS, :precioSIS, :cantidadSOAT, :precioSOAT, :cantidadPagar, :cantidadDev, :fechaAutorizaConv, :cantidadConv, :precConv, :importeConv";

		$params = [
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'precioUnitario' => ($oTabla->precioUnitario == 0)? Null: $oTabla->precioUnitario, 
			'idEstadoFacturacion' => ($oTabla->idEstadoFacturacion == 0)? Null: $oTabla->idEstadoFacturacion, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idPartidaPresupuestal' => ($oTabla->idPartidaPresupuestal == 0)? Null: $oTabla->idPartidaPresupuestal, 
			'idCentroCosto' => ($oTabla->idCentroCosto == 0)? Null: $oTabla->idCentroCosto, 
			'idServicioInternamiento' => ($oTabla->idServicioInternamiento == 0)? Null: $oTabla->idServicioInternamiento, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'totalPorPagar' => ($oTabla->totalPorPagar == 0)? Null: $oTabla->totalPorPagar, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idFacturacionServicio' => ($oTabla->idFacturacionServicio == 0)? Null: $oTabla->idFacturacionServicio, 
			'idUsuarioModifica' => ($oTabla->idUsuarioModifica == 0)? Null: $oTabla->idUsuarioModifica, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'fechaModificacion' => ($oTabla->fechaModificacion == 0)? Null: $oTabla->fechaModificacion, 
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idUsuarioAutorizaSeguro' => ($oTabla->idUsuarioAutorizaSeguro == 0)? Null: $oTabla->idUsuarioAutorizaSeguro, 
			'idUsuarioAutorizaPendiente' => ($oTabla->idUsuarioAutorizaPendiente == 0)? Null: $oTabla->idUsuarioAutorizaPendiente, 
			'idUsuarioAutorizaDevolucion' => ($oTabla->idUsuarioAutorizaDevolucion == 0)? Null: $oTabla->idUsuarioAutorizaDevolucion, 
			'idCajero' => ($oTabla->idCajero == 0)? Null: $oTabla->idCajero, 
			'fechaAutorizaSeguro' => ($oTabla->fechaAutorizaSeguro == 0)? Null: $oTabla->fechaAutorizaSeguro, 
			'fechaAutorizaPendiente' => ($oTabla->fechaAutorizaPendiente == 0)? Null: $oTabla->fechaAutorizaPendiente, 
			'fechaAutorizaDevolucion' => ($oTabla->fechaAutorizaDevolucion == 0)? Null: $oTabla->fechaAutorizaDevolucion, 
			'fechaCajero' => ($oTabla->fechaCajero == 0)? Null: $oTabla->fechaCajero, 
			'idComprobantePagoDevolucion' => ($oTabla->idComprobantePagoDevolucion == 0)? Null: $oTabla->idComprobantePagoDevolucion, 
			'cantidad' => ($oTabla->cantidad == 0)? 0: $oTabla->cantidad, 
			'idUsuarioCrea' => ($oTabla->idUsuarioCrea == 0)? Null: $oTabla->idUsuarioCrea, 
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
			EXEC FacturacionServiciosEliminar :idFacturacionServicio, :idUsuarioAuditoria";

		$params = [
			'idFacturacionServicio' => ($oTabla->idFacturacionServicio == 0)? Null: $oTabla->idFacturacionServicio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FacturacionServiciosSeleccionarPorId :idFacturacionServicio";

		$params = [
			'idFacturacionServicio' => $oTabla->idFacturacionServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function InsertarServicioSP($oTabla, &$sResultado)
	{
		$query = "
			DECLARE @idFacturacionServicio AS Int = :idFacturacionServicio
			DECLARE @result AS VarChar = :result
			SET NOCOUNT ON 
			EXEC FacturacionServiciosAgregarV2 @idFacturacionServicio OUTPUT, @result OUTPUT, :idProducto, :cantidad, :idEstadoFacturacion, :idFuenteFinanciamiento, :idTipoFinanciamiento, :idServicioInternamiento, :idComprobantePago, :idPuntoCarga, :idOrden, :idUsuarioAutorizaSeguro, :idUsuarioAutorizaPendiente, :idUsuarioAutorizaDevolucion, :idCajero, :fechaAutorizaSeguro, :fechaAutorizaPendiente, :fechaAutorizaDevolucion, :fechaCajero, :idAtencion, :idUsuarioAuditoria, :importeSIS, :importeEXO, :idUsuarioAutorizaEXO, :fechaAutorizaEXO, :importeSOAT, :totalPagar, :cantidadSIS, :precioSIS, :cantidadSOAT, :precioSOAT, :cantidadPagar, :cantidadDev, :fechaAutorizaConv, :cantidadConv, :precConv, :importeConv
			SELECT @idFacturacionServicio AS idFacturacionServicio, @result AS result";

		$params = [
			'idFacturacionServicio' => 0, 
			'result' => 0, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cantidad' => ($oTabla->cantidad == 0)? 0: $oTabla->cantidad, 
			'idEstadoFacturacion' => ($oTabla->idEstadoFacturacion == 0)? Null: $oTabla->idEstadoFacturacion, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idServicioInternamiento' => ($oTabla->idServicioInternamiento == 0)? Null: $oTabla->idServicioInternamiento, 
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
			'cantidadPagar' => ($oTabla->cantidadPagar == 0)? 0: $oTabla->cantidadPagar, 
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

	public function ModificarServicioSP($oTabla, &$sResultado)
	{
		$query = "
			DECLARE @result AS VarChar = :result
			SET NOCOUNT ON 
			EXEC FacturacionServiciosModificarV2 :idFacturacionServicio, @result OUTPUT, :idProducto, :cantidad, :idEstadoFacturacion, :idFuenteFinanciamiento, :idTipoFinanciamiento, :idServicioInternamiento, :idComprobantePago, :idPuntoCarga, :idOrden, :idUsuarioAutorizaSeguro, :idUsuarioAutorizaPendiente, :idUsuarioAutorizaDevolucion, :idCajero, :fechaAutorizaSeguro, :fechaAutorizaPendiente, :fechaAutorizaDevolucion, :fechaCajero, :idAtencion, :idComprobantePagoDevolucion, :idUsuarioAuditoria, :importeSIS, :importeEXO, :idUsuarioAutorizaEXO, :fechaAutorizaEXO, :importeSOAT, :totalPagar, :cantidadSIS, :precioSIS, :cantidadSOAT, :precioSOAT, :cantidadPagar, :cantidadDev, :fechaAutorizaConv, :cantidadConv, :precConv, :importeConv
			SELECT @result AS result";

		$params = [
			'idFacturacionServicio' => ($oTabla->idFacturacionServicio == 0)? Null: $oTabla->idFacturacionServicio, 
			'result' => 0, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cantidad' => ($oTabla->cantidad == 0)? 0: $oTabla->cantidad, 
			'idEstadoFacturacion' => ($oTabla->idEstadoFacturacion == 0)? Null: $oTabla->idEstadoFacturacion, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idServicioInternamiento' => ($oTabla->idServicioInternamiento == 0)? Null: $oTabla->idServicioInternamiento, 
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
			'totalPagar' => ($oTabla->totalPagar == 0)? Null: $oTabla->totalPagar, 
			'cantidadSIS' => ($oTabla->cantidadSIS == 0)? 0: $oTabla->cantidadSIS, 
			'precioSIS' => ($oTabla->precioSIS == 0)? Null: $oTabla->precioSIS, 
			'cantidadSOAT' => ($oTabla->cantidadSOAT == 0)? 0: $oTabla->cantidadSOAT, 
			'precioSOAT' => ($oTabla->precioSOAT == 0)? Null: $oTabla->precioSOAT, 
			'cantidadPagar' => ($oTabla->cantidadPagar == 0)? 0: $oTabla->cantidadPagar, 
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

	public function EliminarServicioSP($oTabla, &$sResultado)
	{
		$query = "
			EXEC FacturacionServiciosEliminarServicio :idAtencion, :idProducto, :idUsuarioAuditoria";

		$params = [
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

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

	public function SeleccionarParaEstadoCuenta($lIdCuentaAtencion, $tipoServicioARecuperar)
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

	public function EliminarServiciosDeLaCuenta($lIdAtencion)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDatosDeServicioFacturado($lIdAtencion, $lIdServicio)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtieneTipoConsulta($lIdAtencion)
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

	public function ActualizarExoneracion($oTabla)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AtencionTieneServiciosFacturados($lIdAtencion)
	{
		$query = "
			DECLARE @cantidad AS Int = :cantidad
			SET NOCOUNT ON 
			EXEC AtencionCantidadServiciosFacturados :idAtencion, @cantidad OUTPUT
			SELECT @cantidad AS cantidad";

		$params = [
			'idAtencion' => $lIdAtencion, 
			'cantidad' => 0, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

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
			EXEC FacturacionServiciosFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCodigo($codigo, $idTipoFinanciamiento)
	{
		$query = "
			EXEC FactCatalogoServiciosXCodigoTipoFinanciamiento :idTipoFinanciamiento, :codigo";

		$params = [
			'idTipoFinanciamiento' => $idTipoFinanciamiento, 
			'codigo' => $codigo, 
		];

		$data = \DB::select($query, $params);

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

	public function SeleccionarDevolucionPorIdComprobante($lIdComprobanteDevolucion)
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

	public function SeleccionarPorServicioYAtencion($lnIdProducto, $lnIdAtencion)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}