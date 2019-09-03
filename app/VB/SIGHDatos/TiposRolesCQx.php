<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposRolesCQx extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idRolesCQx AS Int = :idRolesCQx
			SET NOCOUNT ON 
			EXEC TiposRolesCQxAgregar @idRolesCQx OUTPUT, :descripcion, :bit, :orden, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idRolesCQx AS idRolesCQx";

		$params = [
			'idRolesCQx' => 0, 
			'descripcion' => $oTabla->descripcion, 
			'bit' => ($oTabla->bit == 0)? Null: $oTabla->bit, 
			'orden' => ($oTabla->orden == 0)? Null: $oTabla->orden, 
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
			EXEC TiposRolesCQxModificar :idRolesCQx, :descripcion, :bit, :orden, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idRolesCQx' => ($oTabla->idRolesCQx == 0)? Null: $oTabla->idRolesCQx, 
			'descripcion' => $oTabla->descripcion, 
			'bit' => ($oTabla->bit == 0)? Null: $oTabla->bit, 
			'orden' => ($oTabla->orden == 0)? Null: $oTabla->orden, 
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
			EXEC TiposRolesCQxEliminar :idRolesCQx, :idUsuarioAuditoria";

		$params = [
			'idRolesCQx' => $oTabla->idRolesCQx, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposRolesCQxSeleccionarPorId :idRolesCQx";

		$params = [
			'idRolesCQx' => $oTabla->idRolesCQx, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorBit($vBit)
	{
		$query = "
			EXEC TiposRolesCQxSeleccionarPorBit :p_Bit";

		$params = [
			'p_Bit' => $vBit, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}