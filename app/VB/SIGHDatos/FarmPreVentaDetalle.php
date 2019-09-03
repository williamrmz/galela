<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FarmPreVentaDetalle extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC farmPreVentaDetalleAgregar :idPreventa, :idProducto, :item, :cantidad, :precio, :importe, :idUsuarioAuditoria";

		$params = [
			'idPreventa' => ($oTabla->idPreventa == 0)? Null: $oTabla->idPreventa, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'item' => ($oTabla->item == 0)? Null: $oTabla->item, 
			'cantidad' => ($oTabla->cantidad == 0)? Null: $oTabla->cantidad, 
			'precio' => $oTabla->precio, 
			'importe' => $oTabla->importe, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC farmPreVentaDetalleModificar :idPreventa, :idProducto, :item, :cantidad, :precio, :importe, :idUsuarioAuditoria";

		$params = [
			'idPreventa' => ($oTabla->idPreventa == 0)? Null: $oTabla->idPreventa, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'item' => ($oTabla->item == 0)? Null: $oTabla->item, 
			'cantidad' => ($oTabla->cantidad == 0)? Null: $oTabla->cantidad, 
			'precio' => $oTabla->precio, 
			'importe' => $oTabla->importe, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC farmPreVentaDetalleEliminar :idPreventa, :idUsuarioAuditoria";

		$params = [
			'idPreventa' => $oTabla->idPreventa, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC farmPreVentaDetalleSeleccionarPorId :idPreventa";

		$params = [
			'idPreventa' => $oTabla->idPreventa, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function DevuelveTodosItems($lnIdPreventa)
	{
		$query = "
			EXEC FarmPreVentaDetalleDevuelveTodosItems :idPreventa";

		$params = [
			'idPreventa' => $lnIdPreventa, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}