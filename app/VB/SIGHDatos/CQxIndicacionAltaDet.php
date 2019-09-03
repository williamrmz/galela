<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxIndicacionAltaDet extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idndicacionAltaDet AS Int = :idndicacionAltaDet
			SET NOCOUNT ON 
			EXEC CQxIndicacionAltaDetAgregar @idndicacionAltaDet OUTPUT, :idIndicacionAlta, :idIndicacionAltaCab, :descripcion, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idndicacionAltaDet AS idndicacionAltaDet";

		$params = [
			'idndicacionAltaDet' => 0, 
			'idIndicacionAlta' => ($oTabla->idIndicacionAlta == 0)? Null: $oTabla->idIndicacionAlta, 
			'idIndicacionAltaCab' => ($oTabla->idIndicacionAltaCab == 0)? Null: $oTabla->idIndicacionAltaCab, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
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
			EXEC CQxIndicacionAltaDetModificar :idndicacionAltaDet, :idIndicacionAlta, :idIndicacionAltaCab, :descripcion, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idndicacionAltaDet' => ($oTabla->idndicacionAltaDet == 0)? Null: $oTabla->idndicacionAltaDet, 
			'idIndicacionAlta' => ($oTabla->idIndicacionAlta == 0)? Null: $oTabla->idIndicacionAlta, 
			'idIndicacionAltaCab' => ($oTabla->idIndicacionAltaCab == 0)? Null: $oTabla->idIndicacionAltaCab, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
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
			EXEC CQxIndicacionAltaDetEliminar :idndicacionAltaDet, :idUsuarioAuditoria";

		$params = [
			'idndicacionAltaDet' => $oTabla->idndicacionAltaDet, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxIndicacionAltaDetSeleccionarPorId :idndicacionAltaDet";

		$params = [
			'idndicacionAltaDet' => $oTabla->idndicacionAltaDet, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdCab($oTabla)
	{
		$query = "
			EXEC CQxIndicacionAltaDetSeleccionarPorIdCab :idIndicacionAltaCab";

		$params = [
			'idIndicacionAltaCab' => $oTabla->idIndicacionAltaCab, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SelReporte($oTabla)
	{
		$query = "
			EXEC CQxIndicacionAltaRpt :idIndicacionAltaCab";

		$params = [
			'idIndicacionAltaCab' => $oTabla->idIndicacionAltaCab, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}