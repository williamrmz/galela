<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposTarifaCpt extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC TiposTarifaCptAgregar :idTipoTarifa, :idProductoCpt, :idUsuarioAuditoria";

		$params = [
			'idTipoTarifa' => ($oTabla->idTipoTarifa == 0)? Null: $oTabla->idTipoTarifa, 
			'idProductoCpt' => ($oTabla->idProductoCpt == 0)? Null: $oTabla->idProductoCpt, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposTarifaCptModificar :idTipoTarifa, :idProductoCpt, :idUsuarioAuditoria";

		$params = [
			'idTipoTarifa' => ($oTabla->idTipoTarifa == 0)? Null: $oTabla->idTipoTarifa, 
			'idProductoCpt' => ($oTabla->idProductoCpt == 0)? Null: $oTabla->idProductoCpt, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposTarifaCptEliminar :idTipoTarifa, :idUsuarioAuditoria";

		$params = [
			'idTipoTarifa' => $oTabla->idTipoTarifa, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposTarifaCptSeleccionarPorId :idTipoTarifa";

		$params = [
			'idTipoTarifa' => $oTabla->idTipoTarifa, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}