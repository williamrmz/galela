<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class LabGrupos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idGrupo AS Int = :idGrupo
			SET NOCOUNT ON 
			EXEC labGruposAgregar @idGrupo OUTPUT, :nombreGrupo, :siglasGrupo, :idCargo, :idUsuarioAuditoria
			SELECT @idGrupo AS idGrupo";

		$params = [
			'idGrupo' => 0, 
			'nombreGrupo' => ($oTabla->nombreGrupo == "")? Null: $oTabla->nombreGrupo, 
			'siglasGrupo' => ($oTabla->siglasGrupo == "")? Null: $oTabla->siglasGrupo, 
			'idCargo' => ($oTabla->idCargo == 0)? Null: $oTabla->idCargo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC labGruposModificar :idGrupo, :nombreGrupo, :siglasGrupo, :idCargo, :idUsuarioAuditoria";

		$params = [
			'idGrupo' => ($oTabla->idGrupo == 0)? Null: $oTabla->idGrupo, 
			'nombreGrupo' => ($oTabla->nombreGrupo == "")? Null: $oTabla->nombreGrupo, 
			'siglasGrupo' => ($oTabla->siglasGrupo == "")? Null: $oTabla->siglasGrupo, 
			'idCargo' => ($oTabla->idCargo == 0)? Null: $oTabla->idCargo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC labGruposEliminar :idGrupo, :idUsuarioAuditoria";

		$params = [
			'idGrupo' => $oTabla->idGrupo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC labGruposSeleccionarPorId :idGrupo";

		$params = [
			'idGrupo' => $oTabla->idGrupo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC LabGruposSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}