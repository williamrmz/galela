<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposCondicionOcupacion extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idCondicionOcupacion AS Int = :idCondicionOcupacion
			SET NOCOUNT ON 
			EXEC TiposCondicionOcupacionAgregar :descripcion, @idCondicionOcupacion OUTPUT, :idUsuarioAuditoria
			SELECT @idCondicionOcupacion AS idCondicionOcupacion";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idCondicionOcupacion' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposCondicionOcupacionModificar :descripcion, :idCondicionOcupacion, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idCondicionOcupacion' => ($oTabla->idCondicionOcupacion == 0)? Null: $oTabla->idCondicionOcupacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposCondicionOcupacionEliminar :idCondicionOcupacion, :idUsuarioAuditoria";

		$params = [
			'idCondicionOcupacion' => ($oTabla->idCondicionOcupacion == 0)? Null: $oTabla->idCondicionOcupacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposCondicionOcupacionSeleccionarPorId :idCondicionOcupacion";

		$params = [
			'idCondicionOcupacion' => $oTabla->idCondicionOcupacion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposCondicionOcupacionSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}