<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposReferencia extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idTipoReferencia AS Int = :idTipoReferencia
			SET NOCOUNT ON 
			EXEC TiposReferenciaAgregar :descripcion, @idTipoReferencia OUTPUT, :idUsuarioAuditoria
			SELECT @idTipoReferencia AS idTipoReferencia";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoReferencia' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposReferenciaModificar :descripcion, :idTipoReferencia, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoReferencia' => ($oTabla->idTipoReferencia == 0)? Null: $oTabla->idTipoReferencia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposReferenciaEliminar :idTipoReferencia, :idUsuarioAuditoria";

		$params = [
			'idTipoReferencia' => ($oTabla->idTipoReferencia == 0)? Null: $oTabla->idTipoReferencia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposReferenciaSeleccionarPorId :idTipoReferencia";

		$params = [
			'idTipoReferencia' => $oTabla->idTipoReferencia, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposReferenciaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}