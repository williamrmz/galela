<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Roles extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idRol AS Int = :idRol
			SET NOCOUNT ON 
			EXEC RolesAgregar :nombre, @idRol OUTPUT, :idUsuarioAuditoria
			SELECT @idRol AS idRol";

		$params = [
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'idRol' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC RolesModificar :nombre, :idRol, :idUsuarioAuditoria";

		$params = [
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'idRol' => ($oTabla->idRol == 0)? Null: $oTabla->idRol, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC RolesEliminar :idRol, :idUsuarioAuditoria";

		$params = [
			'idRol' => ($oTabla->idRol == 0)? Null: $oTabla->idRol, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC RolesSeleccionarPorId :idRol";

		$params = [
			'idRol' => $oTabla->idRol, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC RolesSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}