<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class LabItems extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC LabItemsAgregar :idItem, :item, :idProductoCpt, :idUsuarioAuditoria";

		$params = [
			'idItem' => ($oTabla->idItem == 0)? Null: $oTabla->idItem, 
			'item' => ($oTabla->item == "")? Null: $oTabla->item, 
			'idProductoCpt' => ($oTabla->idProductoCpt == 0)? Null: $oTabla->idProductoCpt, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC LabItemsModificar :idItem, :item, :idProductoCpt, :idUsuarioAuditoria";

		$params = [
			'idItem' => ($oTabla->idItem == 0)? Null: $oTabla->idItem, 
			'item' => ($oTabla->item == "")? Null: $oTabla->item, 
			'idProductoCpt' => ($oTabla->idProductoCpt == 0)? Null: $oTabla->idProductoCpt, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC LabItemsEliminar :idItem, :idUsuarioAuditoria";

		$params = [
			'idItem' => $oTabla->idItem, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC LabItemsSeleccionarPorId :idItem";

		$params = [
			'idItem' => $oTabla->idItem, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos($wcriterio)
	{
		$query = "
			EXEC LabItemsSeleccionarTodos :filtro";

		$params = [
			'filtro' => $wcriterio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}