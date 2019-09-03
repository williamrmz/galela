<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class RolesPermisos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idRolPermiso AS Int = :idRolPermiso
			SET NOCOUNT ON 
			EXEC RolesPermisosAgregar :idRol, :idPermiso, @idRolPermiso OUTPUT, :idUsuarioAuditoria
			SELECT @idRolPermiso AS idRolPermiso";

		$params = [
			'idRol' => ($oTabla->idRol == 0)? Null: $oTabla->idRol, 
			'idPermiso' => ($oTabla->idPermiso == 0)? Null: $oTabla->idPermiso, 
			'idRolPermiso' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC RolesPermisosModificar :idRol, :idPermiso, :idRolPermiso, :idUsuarioAuditoria";

		$params = [
			'idRol' => ($oTabla->idRol == 0)? Null: $oTabla->idRol, 
			'idPermiso' => ($oTabla->idPermiso == 0)? Null: $oTabla->idPermiso, 
			'idRolPermiso' => ($oTabla->idRolPermiso == 0)? Null: $oTabla->idRolPermiso, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC RolesPermisosEliminar :idRolPermiso, :idUsuarioAuditoria";

		$params = [
			'idRolPermiso' => ($oTabla->idRolPermiso == 0)? Null: $oTabla->idRolPermiso, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC RolesPermisosSeleccionarPorId :idRolPermiso";

		$params = [
			'idRolPermiso' => $oTabla->idRolPermiso, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorRol($lIdRol)
	{
		$query = "
			EXEC RolesPermisosSeleccionarPorRol :idRol";

		$params = [
			'idRol' => $lIdRol, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizarRolesPermisos($oRolesPermisos, $lIdRol)
	{
		$query = "
			EXEC RolesPermisosEliminarPorIdRol :lIdRol";

		$params = [
			'lIdRol' => $lIdRol, 
		];

		$data = \DB::update($query, $params);

		foreach( $oRolesPermisos as $oRolPermiso ){
			$oRolPermiso->idRol = $lIdRol;
			$data = $this->Insertar($oRolPermiso);
		}

		return true;
	}

	public function SeleccionarPermisosFacturacionPorUsuario($lIdEmpleado)
	{
		$query = "
			EXEC RolesPermisosXidEmpleado :lIdEmpleado";

		$params = [
			'lIdEmpleado' => $lIdEmpleado, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}