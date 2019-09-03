<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class DetallesProducto extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idDetalleProducto AS Int = :idDetalleProducto
			SET NOCOUNT ON 
			EXEC DetalleProductosAgregar :idMotivoNoAtencion, :idEstadoProducto, :idDocumentoDetalle, :precioUnitario, :cantidad, :precioTotal, :idProducto, @idDetalleProducto OUTPUT, :idCuentaAtencion, :cubiertoPorSeguro, :idUsuarioAuditoria
			SELECT @idDetalleProducto AS idDetalleProducto";

		$params = [
			'idMotivoNoAtencion' => ($oTabla->idMotivoNoAtencion == 0)? Null: $oTabla->idMotivoNoAtencion, 
			'idEstadoProducto' => ($oTabla->idEstadoProducto == 0)? Null: $oTabla->idEstadoProducto, 
			'idDocumentoDetalle' => ($oTabla->idDocumentoDetalle == 0)? Null: $oTabla->idDocumentoDetalle, 
			'precioUnitario' => ($oTabla->precioUnitario == 0)? Null: $oTabla->precioUnitario, 
			'cantidad' => ($oTabla->cantidad == 0)? Null: $oTabla->cantidad, 
			'precioTotal' => ($oTabla->precioTotal == 0)? Null: $oTabla->precioTotal, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idDetalleProducto' => 0, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'cubiertoPorSeguro' => ($oTabla->cubiertoPorSeguro == "")? Null: $oTabla->cubiertoPorSeguro, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC DetalleProductosModificar :idMotivoNoAtencion, :idEstadoProducto, :idDocumentoDetalle, :precioUnitario, :cantidad, :precioTotal, :idProducto, :idDetalleProducto, :idCuentaAtencion, :cubiertoPorSeguro, :idUsuarioAuditoria";

		$params = [
			'idMotivoNoAtencion' => ($oTabla->idMotivoNoAtencion == 0)? Null: $oTabla->idMotivoNoAtencion, 
			'idEstadoProducto' => ($oTabla->idEstadoProducto == 0)? Null: $oTabla->idEstadoProducto, 
			'idDocumentoDetalle' => ($oTabla->idDocumentoDetalle == 0)? Null: $oTabla->idDocumentoDetalle, 
			'precioUnitario' => ($oTabla->precioUnitario == 0)? Null: $oTabla->precioUnitario, 
			'cantidad' => ($oTabla->cantidad == 0)? Null: $oTabla->cantidad, 
			'precioTotal' => ($oTabla->precioTotal == 0)? Null: $oTabla->precioTotal, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idDetalleProducto' => ($oTabla->idDetalleProducto == 0)? Null: $oTabla->idDetalleProducto, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'cubiertoPorSeguro' => ($oTabla->cubiertoPorSeguro == "")? Null: $oTabla->cubiertoPorSeguro, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC DetalleProductosEliminar :idDetalleProducto, :idUsuarioAuditoria";

		$params = [
			'idDetalleProducto' => ($oTabla->idDetalleProducto == 0)? Null: $oTabla->idDetalleProducto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC DetalleProductosSeleccionarPorId :idDetalleProducto";

		$params = [
			'idDetalleProducto' => $oTabla->idDetalleProducto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}