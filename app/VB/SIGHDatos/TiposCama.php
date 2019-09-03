<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposCama extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idTipoCama AS Int = :idTipoCama
			SET NOCOUNT ON 
			EXEC TiposCamaAgregar :descripcion, @idTipoCama OUTPUT, :idUsuarioAuditoria
			SELECT @idTipoCama AS idTipoCama";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoCama' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposCamaModificar :descripcion, :idTipoCama, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoCama' => ($oTabla->idTipoCama == 0)? Null: $oTabla->idTipoCama, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposCamaEliminar :idTipoCama, :idUsuarioAuditoria";

		$params = [
			'idTipoCama' => ($oTabla->idTipoCama == 0)? Null: $oTabla->idTipoCama, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposCamaSeleccionarPorId :idTipoCama";

		$params = [
			'idTipoCama' => $oTabla->idTipoCama, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposCamaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}