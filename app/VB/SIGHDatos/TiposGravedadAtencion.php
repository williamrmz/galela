<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposGravedadAtencion extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idTipoGravedad AS Int = :idTipoGravedad
			SET NOCOUNT ON 
			EXEC TiposGravedadAtencionAgregar :descripcion, @idTipoGravedad OUTPUT, :idUsuarioAuditoria
			SELECT @idTipoGravedad AS idTipoGravedad";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoGravedad' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposGravedadAtencionModificar :descripcion, :idTipoGravedad, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoGravedad' => ($oTabla->idTipoGravedad == 0)? Null: $oTabla->idTipoGravedad, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposGravedadAtencionEliminar :idTipoGravedad, :idUsuarioAuditoria";

		$params = [
			'idTipoGravedad' => ($oTabla->idTipoGravedad == 0)? Null: $oTabla->idTipoGravedad, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposGravedadAtencionSeleccionarPorId :idTipoGravedad";

		$params = [
			'idTipoGravedad' => $oTabla->idTipoGravedad, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposGravedadAtencionSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}