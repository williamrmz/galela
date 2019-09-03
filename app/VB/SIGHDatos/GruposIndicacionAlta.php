<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class GruposIndicacionAlta extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idIndicacionAlta AS Int = :idIndicacionAlta
			SET NOCOUNT ON 
			EXEC GruposIndicacionAltaAgregar @idIndicacionAlta OUTPUT, :descripcion, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idIndicacionAlta AS idIndicacionAlta";

		$params = [
			'idIndicacionAlta' => 0, 
			'descripcion' => $oTabla->descripcion, 
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
			EXEC GruposIndicacionAltaModificar :idIndicacionAlta, :descripcion, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idIndicacionAlta' => ($oTabla->idIndicacionAlta == 0)? Null: $oTabla->idIndicacionAlta, 
			'descripcion' => $oTabla->descripcion, 
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
			EXEC GruposIndicacionAltaEliminar :idIndicacionAlta, :idUsuarioAuditoria";

		$params = [
			'idIndicacionAlta' => $oTabla->idIndicacionAlta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC GruposIndicacionAltaSeleccionarPorId :idIndicacionAlta";

		$params = [
			'idIndicacionAlta' => $oTabla->idIndicacionAlta, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}