<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

use App\VB\SIGHComun\DOUsuarioRol;

class UsuariosRoles extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idUsuarioRol AS Int = :idUsuarioRol
			SET NOCOUNT ON 
			EXEC UsuariosRolesAgregar :idEmpleado, :idRol, @idUsuarioRol OUTPUT, :idUsuarioAuditoria
			SELECT @idUsuarioRol AS idUsuarioRol";

		$params = [
			'idEmpleado' => ($oTabla->idEmpleado == 0)? Null: $oTabla->idEmpleado, 
			'idRol' => ($oTabla->idRol == 0)? Null: $oTabla->idRol, 
			'idUsuarioRol' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC UsuariosRolesModificar :idEmpleado, :idRol, :idUsuarioRol, :idUsuarioAuditoria";

		$params = [
			'idEmpleado' => ($oTabla->idEmpleado == 0)? Null: $oTabla->idEmpleado, 
			'idRol' => ($oTabla->idRol == 0)? Null: $oTabla->idRol, 
			'idUsuarioRol' => ($oTabla->idUsuarioRol == 0)? Null: $oTabla->idUsuarioRol, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC UsuariosRolesEliminar :idUsuarioRol, :idUsuarioAuditoria";

		$params = [
			'idUsuarioRol' => ($oTabla->idUsuarioRol == 0)? Null: $oTabla->idUsuarioRol, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC UsuariosRolesSeleccionarPorId :idUsuarioRol";

		$params = [
			'idUsuarioRol' => $oTabla->idUsuarioRol, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizarPorEmpleado($oUsuariosRoles, $lIdEmpleado)
	{
		$rolesEliminados = $this->EliminarPorEmpleado($lIdEmpleado);
		// dd($rolesEliminados);
		foreach($oUsuariosRoles as $oDOUsuarioRol) //new DOUsuarioRol
		{
			$oDOUsuarioRol->idEmpleado = $lIdEmpleado;
			$rolInsertado = $this->Insertar( $oDOUsuarioRol );
		}
		return true;
	}

	public function EliminarPorEmpleado($lIdEmpleado)
	{
		$query = "
			EXEC UsuariosRolesElimnaXidEmpleado :lIdEmpleado";

		$params = [
			'lIdEmpleado' => $lIdEmpleado, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorEmpleado($idEmpleado)
	{
		$query = "
			EXEC UsuariosRolesSeleccionarPorEmpleados :idEmpleado";

		$params = [
			'idEmpleado' => $idEmpleado, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}