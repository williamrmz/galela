<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CajaComprobantesDetalle extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC CajaComprobantesDetalleBienesInsumosAgregar :subTotalPagado, :cantidad, :precioUnitario, :idComprobanteDetalleBienes, :idComprobantePago, :idProducto, :idUsuarioAuditoria";

		$params = [
			'subTotalPagado' => ($oTabla->subTotalPagado == "")? Null: $oTabla->subTotalPagado, 
			'cantidad' => ($oTabla->cantidad == "")? Null: $oTabla->cantidad, 
			'precioUnitario' => ($oTabla->precioUnitario == "")? Null: $oTabla->precioUnitario, 
			'idComprobanteDetalleBienes' => ($oTabla->idComprobanteDetalle == "")? Null: $oTabla->idComprobanteDetalle, 
			'idComprobantePago' => ($oTabla->idComprobantePago == "")? Null: $oTabla->idComprobantePago, 
			'idProducto' => ($oTabla->idProducto == "")? Null: $oTabla->idProducto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CajaComprobantesDetalleBienesInsumosModificar :subTotalPagado, :cantidad, :precioUnitario, :idComprobanteDetalleBienes, :idComprobantePago, :idProducto, :idUsuarioAuditoria";

		$params = [
			'subTotalPagado' => ($oTabla->subTotalPagado == "")? Null: $oTabla->subTotalPagado, 
			'cantidad' => ($oTabla->cantidad == "")? Null: $oTabla->cantidad, 
			'precioUnitario' => ($oTabla->precioUnitario == "")? Null: $oTabla->precioUnitario, 
			'idComprobanteDetalleBienes' => ($oTabla->idComprobanteDetalle == "")? Null: $oTabla->idComprobanteDetalle, 
			'idComprobantePago' => ($oTabla->idComprobantePago == "")? Null: $oTabla->idComprobantePago, 
			'idProducto' => ($oTabla->idProducto == "")? Null: $oTabla->idProducto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CajaComprobantesDetalleBienesInsumosEliminar :idUsuarioAuditoria";

		$params = [
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function ComprobantesDetalle($oTabla)
	{
		$query = "
			EXEC CommandText = SQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}