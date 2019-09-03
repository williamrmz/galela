<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposSignosVitales extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idSignosVitales AS Int = :idSignosVitales
			SET NOCOUNT ON 
			EXEC TiposSignosVitalesAgregar @idSignosVitales OUTPUT, :descripcion, :abreviatura, :tipo, :formatoMask, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idSignosVitales AS idSignosVitales";

		$params = [
			'idSignosVitales' => 0, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'abreviatura' => ($oTabla->abreviatura == "")? Null: $oTabla->abreviatura, 
			'tipo' => ($oTabla->tipo == "")? Null: $oTabla->tipo, 
			'formatoMask' => ($oTabla->formatoMask == "")? Null: $oTabla->formatoMask, 
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
			EXEC TiposSignosVitalesModificar :idSignosVitales, :descripcion, :abreviatura, :tipo, :formatoMask, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idSignosVitales' => ($oTabla->idSignosVitales == 0)? Null: $oTabla->idSignosVitales, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'abreviatura' => ($oTabla->abreviatura == "")? Null: $oTabla->abreviatura, 
			'tipo' => ($oTabla->tipo == "")? Null: $oTabla->tipo, 
			'formatoMask' => ($oTabla->formatoMask == "")? Null: $oTabla->formatoMask, 
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
			EXEC TiposSignosVitalesEliminar :idSignosVitales, :idUsuarioAuditoria";

		$params = [
			'idSignosVitales' => $oTabla->idSignosVitales, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposSignosVitalesSeleccionarPorId :idSignosVitales";

		$params = [
			'idSignosVitales' => $oTabla->idSignosVitales, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}