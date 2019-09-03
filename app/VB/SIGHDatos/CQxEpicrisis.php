<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxEpicrisis extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idEpicrisis AS Int = :idEpicrisis
			SET NOCOUNT ON 
			EXEC CQxEpicrisisAgregar @idEpicrisis OUTPUT, :idProgramacionSala, :idOrdenOperatoriaMQ, :idMedico, :observaciones, :fecha, :nroEpicrisis, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idEpicrisis AS idEpicrisis";

		$params = [
			'idEpicrisis' => 0, 
			'idProgramacionSala' => ($oTabla->idProgramacionSala == 0)? Null: $oTabla->idProgramacionSala, 
			'idOrdenOperatoriaMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'observaciones' => ($oTabla->observaciones == "")? Null: $oTabla->observaciones, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'nroEpicrisis' => $oTabla->nroEpicrisis, 
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
			EXEC CQxEpicrisisModificar :idEpicrisis, :idProgramacionSala, :idOrdenOperatoriaMQ, :idMedico, :observaciones, :fecha, :nroEpicrisis, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idEpicrisis' => ($oTabla->idEpicrisis == 0)? Null: $oTabla->idEpicrisis, 
			'idProgramacionSala' => ($oTabla->idProgramacionSala == 0)? Null: $oTabla->idProgramacionSala, 
			'idOrdenOperatoriaMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'observaciones' => ($oTabla->observaciones == "")? Null: $oTabla->observaciones, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'nroEpicrisis' => $oTabla->nroEpicrisis, 
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
			EXEC CQxEpicrisisEliminar :idEpicrisis, :idUsuarioAuditoria";

		$params = [
			'idEpicrisis' => $oTabla->idEpicrisis, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxEpicrisisSeleccionarPorId :idEpicrisis";

		$params = [
			'idEpicrisis' => $oTabla->idEpicrisis, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorProgramacion($oTabla)
	{
		$query = "
			EXEC CQxEpicrisisSeleccionarPorProgramacion :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $oTabla->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}