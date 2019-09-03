<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class LabMovimientoCPT extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC LabMovimientoCPTAgregar :idMovimiento, :idProductoCPT, :cantidad, :precio, :importe, :idUsuarioAuditoria";

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
			EXEC LabMovimientoCPTModificar :idMovimiento, :idProductoCPT, :cantidad, :precio, :importe, :idUsuarioAuditoria";

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
			EXEC LabMovimientoCPTEliminar :idMovimiento, :idUsuarioAuditoria";

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
			EXEC LabMovimientoCPTSeleccionarPorId :idMovimiento";

		$params = [
			'idMovimiento' => $oTabla->idMovimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ModificarLabCpt($oTabla)
	{
		$query = "
			EXEC LabMovimientoCPTMod1 :idMovimiento, :observaciones, :idproducto, :fechaTomaMuestra";

		$params = [
			'idMovimiento' => ($oTabla->idMovimiento == 0)? Null: $oTabla->idMovimiento, 
			'observaciones' => ($oTabla->observaciones == "")? Null: $oTabla->observaciones, 
			'idproducto' => ($oTabla->idProductoCpt == 0)? Null: $oTabla->idProductoCpt, 
			'fechaTomaMuestra' => ($oTabla->fechaTomaMuestra == "")? Null: CDate($oTabla->fechaTomaMuestra), 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}