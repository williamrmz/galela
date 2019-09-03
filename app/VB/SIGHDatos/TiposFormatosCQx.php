<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposFormatosCQx extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idFormatosCQx AS Int = :idFormatosCQx
			SET NOCOUNT ON 
			EXEC TiposFormatosCQxAgregar @idFormatosCQx OUTPUT, :descripcion, :idRolesCQx, :objeto, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idFormatosCQx AS idFormatosCQx";

		$params = [
			'idFormatosCQx' => 0, 
			'descripcion' => $oTabla->descripcion, 
			'idRolesCQx' => ($oTabla->idRolesCQx == 0)? Null: $oTabla->idRolesCQx, 
			'objeto' => $oTabla->objeto, 
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
			EXEC TiposFormatosCQxModificar :idFormatosCQx, :descripcion, :idRolesCQx, :objeto, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idFormatosCQx' => ($oTabla->idFormatosCQx == 0)? Null: $oTabla->idFormatosCQx, 
			'descripcion' => $oTabla->descripcion, 
			'idRolesCQx' => ($oTabla->idRolesCQx == 0)? Null: $oTabla->idRolesCQx, 
			'objeto' => $oTabla->objeto, 
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
			EXEC TiposFormatosCQxEliminar :idFormatosCQx, :idUsuarioAuditoria";

		$params = [
			'idFormatosCQx' => $oTabla->idFormatosCQx, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposFormatosCQxSeleccionarPorId :idFormatosCQx";

		$params = [
			'idFormatosCQx' => $oTabla->idFormatosCQx, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposFormatosCQxSeleccionar ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarConRoles($vIdUsuario)
	{
		$query = "
			EXEC TiposFormatosCQxSelConRoles :idEmpleado";

		$params = [
			'idEmpleado' => $vIdUsuario, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarConRolesProgramacion($vIdUsuario, $vIdProgramacionSala)
	{
		$query = "
			EXEC TiposFormatosCQxSelConRolesProgramacion :idEmpleado, :idProgramacionSala";

		$params = [
			'idEmpleado' => $vIdUsuario, 
			'idProgramacionSala' => $vIdProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}