<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CajaCompDetalleInsumos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idComprobanteDetalleBienes AS Int = :idComprobanteDetalleBienes
			SET NOCOUNT ON 
			EXEC CajaComprobantesDetalleBienesInsumosAgregar :subTotalPagado, :cantidad, :precioUnitario, @idComprobanteDetalleBienes OUTPUT, :idFacturacionBienes, :esPagoACuenta, :idComprobantePago, :idProducto, :idUsuarioAuditoria
			SELECT @idComprobanteDetalleBienes AS idComprobanteDetalleBienes";

		$params = [
			'subTotalPagado' => $oTabla->subTotalPagado, 
			'cantidad' => $oTabla->cantidad, 
			'precioUnitario' => $oTabla->precioUnitario, 
			'idComprobanteDetalleBienes' => 0, 
			'idFacturacionBienes' => ($oTabla->idFacturacionBienes == 0)? Null: $oTabla->idFacturacionBienes, 
			'esPagoACuenta' => $oTabla->esPagoACuenta, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CajaComprobantesDetalleBienesInsumosModificar :subTotalPagado, :cantidad, :precioUnitario, :idComprobanteDetalleBienes, :idFacturacionBienes, :esPagoACuenta, :idComprobantePago, :idProducto, :idUsuarioAuditoria";

		$params = [
			'subTotalPagado' => $oTabla->subTotalPagado, 
			'cantidad' => $oTabla->cantidad, 
			'precioUnitario' => $oTabla->precioUnitario, 
			'idComprobanteDetalleBienes' => ($oTabla->idComprobanteDetalleBienes == 0)? Null: $oTabla->idComprobanteDetalleBienes, 
			'idFacturacionBienes' => ($oTabla->idFacturacionBienes == 0)? Null: $oTabla->idFacturacionBienes, 
			'esPagoACuenta' => $oTabla->esPagoACuenta, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CajaComprobantesDetalleBienesInsumosEliminar :idComprobanteDetalleBienes, :idUsuarioAuditoria";

		$params = [
			'idComprobanteDetalleBienes' => ($oTabla->idComprobanteDetalleBienes == 0)? Null: $oTabla->idComprobanteDetalleBienes, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CajaComprobantesDetalleBienesInsumosSeleccionarPorId :idComprobanteDetalleBienes";

		$params = [
			'idComprobanteDetalleBienes' => $oTabla->idComprobanteDetalleBienes, 
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