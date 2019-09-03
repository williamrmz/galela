<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxProgramacionRoles extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idProgramacionRoles AS Int = :idProgramacionRoles
			SET NOCOUNT ON 
			EXEC CQxProgramacionRolesAgregar @idProgramacionRoles OUTPUT, :idMedico, :idRolesCQx, :idProgramacionSala, :fecha, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idProgramacionRoles AS idProgramacionRoles";

		$params = [
			'idProgramacionRoles' => 0, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'idRolesCQx' => ($oTabla->idRolesCQx == 0)? Null: $oTabla->idRolesCQx, 
			'idProgramacionSala' => ($oTabla->idProgramacionSala == 0)? Null: $oTabla->idProgramacionSala, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'estadoReg' => ($oTabla->estadoReg == 0)? Null: $oTabla->estadoReg, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CQxProgramacionRolesModificar :idProgramacionRoles, :idMedico, :idRolesCQx, :idProgramacionSala, :fecha, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idProgramacionRoles' => ($oTabla->idProgramacionRoles == 0)? Null: $oTabla->idProgramacionRoles, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'idRolesCQx' => ($oTabla->idRolesCQx == 0)? Null: $oTabla->idRolesCQx, 
			'idProgramacionSala' => ($oTabla->idProgramacionSala == 0)? Null: $oTabla->idProgramacionSala, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'estadoReg' => ($oTabla->estadoReg == 0)? Null: $oTabla->estadoReg, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CQxProgramacionRolesEliminar :idProgramacionRoles, :idUsuarioAuditoria";

		$params = [
			'idProgramacionRoles' => $oTabla->idProgramacionRoles, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxProgramacionRolesSeleccionarPorId :idProgramacionRoles";

		$params = [
			'idProgramacionRoles' => $oTabla->idProgramacionRoles, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorProgramacion($oTabla)
	{
		$query = "
			EXEC CQxProgramacionRolesSeleccionarPorProgramacion :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $oTabla->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}