<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FacturacionPreventa extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC FacturacionPreventaAgregar :idFactPreventa, :idProducto, :cantidad, :precio, :importe, :idUsuarioAuditoria";

		$params = [
			'idFactPreventa' => ($oTabla->idFactPreventa == 0)? Null: $oTabla->idFactPreventa, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
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
			EXEC FacturacionPreventaModificar :idFactPreventa, :idProducto, :cantidad, :precio, :importe, :idUsuarioAuditoria";

		$params = [
			'idFactPreventa' => ($oTabla->idFactPreventa == 0)? Null: $oTabla->idFactPreventa, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
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
			EXEC FacturacionPreventaEliminar :idFactPreventa, :idUsuarioAuditoria";

		$params = [
			'idFactPreventa' => $oTabla->idFactPreventa, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FacturacionPreventaSeleccionarPorId :idFactPreventa";

		$params = [
			'idFactPreventa' => $oTabla->idFactPreventa, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}