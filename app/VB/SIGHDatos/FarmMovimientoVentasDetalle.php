<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FarmMovimientoVentasDetalle extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC farmMovimientoVentasDetalleAgregar :movNumero, :movTipo, :idProducto, :cantidad, :precio, :total, :idUsuarioAuditoria";

		$params = [
			'movNumero' => ($oTabla->movNumero == "")? Null: $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cantidad' => ($oTabla->cantidad == 0)? Null: $oTabla->cantidad, 
			'precio' => $oTabla->precio, 
			'total' => $oTabla->total, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC farmMovimientoVentasDetalleModificar :movNumero, :movTipo, :idProducto, :cantidad, :precio, :total, :idUsuarioAuditoria";

		$params = [
			'movNumero' => ($oTabla->movNumero == "")? Null: $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cantidad' => ($oTabla->cantidad == 0)? Null: $oTabla->cantidad, 
			'precio' => $oTabla->precio, 
			'total' => $oTabla->total, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC farmMovimientoVentasDetalleEliminar :movNumero, :movTipo, :idUsuarioAuditoria";

		$params = [
			'movNumero' => $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC farmMovimientoVentasDetalleSeleccionarPorId :movNumero, :movTipo";

		$params = [
			'movNumero' => $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}