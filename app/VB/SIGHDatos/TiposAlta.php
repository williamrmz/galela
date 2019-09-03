<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposAlta extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idTipoAlta AS Int = :idTipoAlta
			SET NOCOUNT ON 
			EXEC TiposAltaAgregar :descripcion, @idTipoAlta OUTPUT, :idUsuarioAuditoria
			SELECT @idTipoAlta AS idTipoAlta";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoAlta' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposAltaModificar :descripcion, :idTipoAlta, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoAlta' => ($oTabla->idTipoAlta == 0)? Null: $oTabla->idTipoAlta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposAltaEliminar :idTipoAlta, :idUsuarioAuditoria";

		$params = [
			'idTipoAlta' => ($oTabla->idTipoAlta == 0)? Null: $oTabla->idTipoAlta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposAltaSeleccionarPorId :idTipoAlta";

		$params = [
			'idTipoAlta' => $oTabla->idTipoAlta, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposAltaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}