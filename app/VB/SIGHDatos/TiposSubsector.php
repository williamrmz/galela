<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposSubsector extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idTipoSubsector AS Int = :idTipoSubsector
			SET NOCOUNT ON 
			EXEC TiposSubsectorAgregar :descripcion, @idTipoSubsector OUTPUT, :idUsuarioAuditoria
			SELECT @idTipoSubsector AS idTipoSubsector";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoSubsector' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposSubsectorModificar :descripcion, :idTipoSubsector, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoSubsector' => ($oTabla->idTipoSubsector == 0)? Null: $oTabla->idTipoSubsector, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposSubsectorEliminar :idTipoSubsector, :idUsuarioAuditoria";

		$params = [
			'idTipoSubsector' => ($oTabla->idTipoSubsector == 0)? Null: $oTabla->idTipoSubsector, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposSubsectorSeleccionarPorId :idTipoSubsector";

		$params = [
			'idTipoSubsector' => $oTabla->idTipoSubsector, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposSubsectorSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}