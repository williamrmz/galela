<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Permisos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPermiso AS Int = :idPermiso
			SET NOCOUNT ON 
			EXEC PermisosAgregar :modulo, :descripcion, @idPermiso OUTPUT, :idUsuarioAuditoria
			SELECT @idPermiso AS idPermiso";

		$params = [
			'modulo' => ($oTabla->modulo == "")? Null: $oTabla->modulo, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idPermiso' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC PermisosModificar :modulo, :descripcion, :idPermiso, :idUsuarioAuditoria";

		$params = [
			'modulo' => ($oTabla->modulo == "")? Null: $oTabla->modulo, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idPermiso' => ($oTabla->idPermiso == 0)? Null: $oTabla->idPermiso, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC PermisosEliminar :idPermiso, :idUsuarioAuditoria";

		$params = [
			'idPermiso' => ($oTabla->idPermiso == 0)? Null: $oTabla->idPermiso, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC PermisosSeleccionarPorId :idPermiso";

		$params = [
			'idPermiso' => $oTabla->idPermiso, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC PermisosSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}