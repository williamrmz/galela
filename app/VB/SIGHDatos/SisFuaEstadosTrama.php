<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class SisFuaEstadosTrama extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @id AS Int = :id
			SET NOCOUNT ON 
			EXEC SisFuaEstadosTramaAgregar @id OUTPUT, :tabla, :campo, :estado, :idUsuarioAuditoria
			SELECT @id AS id";

		$params = [
			'id' => 0, 
			'tabla' => ($oTabla->tabla == "")? Null: $oTabla->tabla, 
			'campo' => ($oTabla->campo == "")? Null: $oTabla->campo, 
			'estado' => ($oTabla->estado == 0)? Null: $oTabla->estado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC SisFuaEstadosTramaModificar :id, :tabla, :campo, :estado, :idUsuarioAuditoria";

		$params = [
			'id' => ($oTabla->id == 0)? Null: $oTabla->id, 
			'tabla' => ($oTabla->tabla == "")? Null: $oTabla->tabla, 
			'campo' => ($oTabla->campo == "")? Null: $oTabla->campo, 
			'estado' => ($oTabla->estado == 0)? Null: $oTabla->estado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC SisFuaEstadosTramaEliminar :id, :idUsuarioAuditoria";

		$params = [
			'id' => $oTabla->id, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC SisFuaEstadosTramaSeleccionarPorId :id";

		$params = [
			'id' => $oTabla->id, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorTabla($tTabla, $wcon)
	{
		$query = "
			EXEC SisFuaEstadosTramaSeleccionarPorTabla :tTabla";

		$params = [
			'tTabla' => $tTabla, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}