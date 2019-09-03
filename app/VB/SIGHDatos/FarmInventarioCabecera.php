<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FarmInventarioCabecera extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC farmInventarioCabeceraAgregar :idInventario, :idProducto, :cantidad, :precio, :total, :cantidadSaldo, :cantidadFaltante, :cantidadSobrante, :idUsuarioAuditoria";

		$params = [
			'idInventario' => ($oTabla->idInventario == 0)? Null: $oTabla->idInventario, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cantidad' => $oTabla->cantidad, 
			'precio' => $oTabla->precio, 
			'total' => $oTabla->total, 
			'cantidadSaldo' => $oTabla->cantidadSaldo, 
			'cantidadFaltante' => $oTabla->cantidadFaltante, 
			'cantidadSobrante' => $oTabla->cantidadSobrante, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC farmInventarioCabeceraModificar :idInventario, :idProducto, :cantidad, :precio, :total, :cantidadSaldo, :cantidadFaltante, :cantidadSobrante, :idUsuarioAuditoria";

		$params = [
			'idInventario' => ($oTabla->idInventario == 0)? Null: $oTabla->idInventario, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cantidad' => $oTabla->cantidad, 
			'precio' => $oTabla->precio, 
			'total' => $oTabla->total, 
			'cantidadSaldo' => $oTabla->cantidadSaldo, 
			'cantidadFaltante' => $oTabla->cantidadFaltante, 
			'cantidadSobrante' => $oTabla->cantidadSobrante, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC farmInventarioCabeceraEliminar :idInventario, :idUsuarioAuditoria";

		$params = [
			'idInventario' => $oTabla->idInventario, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC farmInventarioCabeceraSeleccionarPorId :idInventario";

		$params = [
			'idInventario' => $oTabla->idInventario, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function DevuelveProductosPorId($lnIdInventario)
	{
		$query = "
			EXEC farmInventarioCabeceraDevuelveProductosPorId :lnIdInventario";

		$params = [
			'lnIdInventario' => $lnIdInventario, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}