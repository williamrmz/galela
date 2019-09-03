<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxIndicacionAltaCab extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idIndicacionAltaCab AS Int = :idIndicacionAltaCab
			SET NOCOUNT ON 
			EXEC CQxIndicacionAltaCabAgregar @idIndicacionAltaCab OUTPUT, :idProgramacionSala, :idOrdenOperatoriaMQ, :idMedico, :fecha, :hora, :nroIndicacionAlta, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idIndicacionAltaCab AS idIndicacionAltaCab";

		$params = [
			'idIndicacionAltaCab' => 0, 
			'idProgramacionSala' => ($oTabla->idProgramacionSala == 0)? Null: $oTabla->idProgramacionSala, 
			'idOrdenOperatoriaMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'hora' => ($oTabla->hora == "")? Null: $oTabla->hora, 
			'nroIndicacionAlta' => $oTabla->nroIndicacionAlta, 
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
			EXEC CQxIndicacionAltaCabModificar :idIndicacionAltaCab, :idProgramacionSala, :idOrdenOperatoriaMQ, :idMedico, :fecha, :hora, :nroIndicacionAlta, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idIndicacionAltaCab' => ($oTabla->idIndicacionAltaCab == 0)? Null: $oTabla->idIndicacionAltaCab, 
			'idProgramacionSala' => ($oTabla->idProgramacionSala == 0)? Null: $oTabla->idProgramacionSala, 
			'idOrdenOperatoriaMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'hora' => ($oTabla->hora == "")? Null: $oTabla->hora, 
			'nroIndicacionAlta' => $oTabla->nroIndicacionAlta, 
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
			EXEC CQxIndicacionAltaCabEliminar :idIndicacionAltaCab, :idUsuarioAuditoria";

		$params = [
			'idIndicacionAltaCab' => $oTabla->idIndicacionAltaCab, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxIndicacionAltaCabSeleccionarPorId :idIndicacionAltaCab";

		$params = [
			'idIndicacionAltaCab' => $oTabla->idIndicacionAltaCab, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorProgramacion($oTabla)
	{
		$query = "
			EXEC CQxIndicacionAltaCabSelPorProgramacion :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $oTabla->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}