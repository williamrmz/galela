<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposCondicionAlta extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idCondicionAlta AS Int = :idCondicionAlta
			SET NOCOUNT ON 
			EXEC TiposCondicionAltaAgregar :descripcion, @idCondicionAlta OUTPUT, :idUsuarioAuditoria
			SELECT @idCondicionAlta AS idCondicionAlta";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idCondicionAlta' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposCondicionAltaModificar :descripcion, :idCondicionAlta, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idCondicionAlta' => ($oTabla->idCondicionAlta == 0)? Null: $oTabla->idCondicionAlta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposCondicionAltaEliminar :idCondicionAlta, :idUsuarioAuditoria";

		$params = [
			'idCondicionAlta' => ($oTabla->idCondicionAlta == 0)? Null: $oTabla->idCondicionAlta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposCondicionAltaSeleccionarPorId :idCondicionAlta";

		$params = [
			'idCondicionAlta' => $oTabla->idCondicionAlta, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposCondicionAltaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}