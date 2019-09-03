<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CajaCompDetalleServicios extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idComprobanteDetalleServicio AS Int = :idComprobanteDetalleServicio
			SET NOCOUNT ON 
			EXEC CajaComprobantesDetalleServiciosAgregar :idFacturacionServicio, :esPagoACuenta, :idProducto, :subTotalPagado, :cantidad, :precioUnitario, :idComprobantePago, @idComprobanteDetalleServicio OUTPUT, :idUsuarioAuditoria
			SELECT @idComprobanteDetalleServicio AS idComprobanteDetalleServicio";

		$params = [
			'idFacturacionServicio' => ($oTabla->idFacturacionServicio == 0)? Null: $oTabla->idFacturacionServicio, 
			'esPagoACuenta' => $oTabla->esPagoACuenta, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'subTotalPagado' => $oTabla->subTotalPagado, 
			'cantidad' => $oTabla->cantidad, 
			'precioUnitario' => $oTabla->precioUnitario, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idComprobanteDetalleServicio' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CajaComprobantesDetalleServiciosModificar :idFacturacionServicio, :esPagoACuenta, :idProducto, :subTotalPagado, :cantidad, :precioUnitario, :idComprobantePago, :idComprobanteDetalleServicio, :idUsuarioAuditoria";

		$params = [
			'idFacturacionServicio' => ($oTabla->idFacturacionServicio == 0)? Null: $oTabla->idFacturacionServicio, 
			'esPagoACuenta' => $oTabla->esPagoACuenta, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'subTotalPagado' => $oTabla->subTotalPagado, 
			'cantidad' => $oTabla->cantidad, 
			'precioUnitario' => $oTabla->precioUnitario, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idComprobanteDetalleServicio' => ($oTabla->idComprobanteDetalleServicio == 0)? Null: $oTabla->idComprobanteDetalleServicio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CajaComprobantesDetalleServiciosEliminar :idComprobanteDetalleServicio, :idUsuarioAuditoria";

		$params = [
			'idComprobanteDetalleServicio' => ($oTabla->idComprobanteDetalleServicio == 0)? Null: $oTabla->idComprobanteDetalleServicio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CajaComprobantesDetalleServiciosSeleccionarPorId :idComprobanteDetalleServicio";

		$params = [
			'idComprobanteDetalleServicio' => $oTabla->idComprobanteDetalleServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarPorComprobante($oTabla, $idEstadoFacturacionPendiente)
	{
		$query = "
			EXEC Command.CommandText = SQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}