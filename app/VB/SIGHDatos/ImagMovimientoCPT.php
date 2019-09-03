<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ImagMovimientoCPT extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC ImagMovimientoCPTAgregar :idMovimiento, :idProductoCPT, :cantidad, :precio, :importe, :idUsuarioAuditoria";

		$params = [
			'idMovimiento' => ($oTabla->idMovimiento == 0)? Null: $oTabla->idMovimiento, 
			'idProductoCPT' => ($oTabla->idProductoCpt == 0)? Null: $oTabla->idProductoCpt, 
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
			EXEC ImagMovimientoCPTModificar :idMovimiento, :idProductoCPT, :cantidad, :precio, :importe, :idUsuarioAuditoria";

		$params = [
			'idMovimiento' => ($oTabla->idMovimiento == 0)? Null: $oTabla->idMovimiento, 
			'idProductoCPT' => ($oTabla->idProductoCpt == 0)? Null: $oTabla->idProductoCpt, 
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
			EXEC ImagMovimientoCPTEliminar :idMovimiento, :idUsuarioAuditoria";

		$params = [
			'idMovimiento' => $oTabla->idMovimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC ImagMovimientoCPTSeleccionarPorId :idMovimiento";

		$params = [
			'idMovimiento' => $oTabla->idMovimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}