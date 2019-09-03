<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class MotivosMovimientoHistoria extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idMotivo AS Int = :idMotivo
			SET NOCOUNT ON 
			EXEC MotivosMovimientoHistoriaAgregar :descripcion, @idMotivo OUTPUT, :idUsuarioAuditoria
			SELECT @idMotivo AS idMotivo";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idMotivo' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC MotivosMovimientoHistoriaModificar :descripcion, :idMotivo, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idMotivo' => ($oTabla->idMotivo == 0)? Null: $oTabla->idMotivo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC MotivosMovimientoHistoriaEliminar :idMotivo, :idUsuarioAuditoria";

		$params = [
			'idMotivo' => ($oTabla->idMotivo == 0)? Null: $oTabla->idMotivo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC MotivosMovimientoHistoriaSeleccionarPorId :idMotivo";

		$params = [
			'idMotivo' => $oTabla->idMotivo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC MotivosMovimientoHistoriaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}