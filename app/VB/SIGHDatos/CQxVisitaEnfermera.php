<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxVisitaEnfermera extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idVisitaEnfermera AS Int = :idVisitaEnfermera
			SET NOCOUNT ON 
			EXEC CQxVisitaEnfermeraAgregar @idVisitaEnfermera OUTPUT, :idProgramacionSala, :idOrdenOperatoriaMQ, :idVisita, :idMedico, :idCQxEtapas, :fechaHoraVisita, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idVisitaEnfermera AS idVisitaEnfermera";

		$params = [
			'idVisitaEnfermera' => 0, 
			'idProgramacionSala' => ($oTabla->idProgramacionSala == 0)? Null: $oTabla->idProgramacionSala, 
			'idOrdenOperatoriaMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
			'idVisita' => ($oTabla->idVisita == 0)? Null: $oTabla->idVisita, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'idCQxEtapas' => ($oTabla->idCQxEtapas == 0)? Null: $oTabla->idCQxEtapas, 
			'fechaHoraVisita' => ($oTabla->fechaHoraVisita == 0)? Null: $oTabla->fechaHoraVisita, 
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
			EXEC CQxVisitaEnfermeraModificar :idVisitaEnfermera, :idProgramacionSala, :idOrdenOperatoriaMQ, :idVisita, :idMedico, :idCQxEtapas, :fechaHoraVisita, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idVisitaEnfermera' => ($oTabla->idVisitaEnfermera == 0)? Null: $oTabla->idVisitaEnfermera, 
			'idProgramacionSala' => ($oTabla->idProgramacionSala == 0)? Null: $oTabla->idProgramacionSala, 
			'idOrdenOperatoriaMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
			'idVisita' => ($oTabla->idVisita == 0)? Null: $oTabla->idVisita, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'idCQxEtapas' => ($oTabla->idCQxEtapas == 0)? Null: $oTabla->idCQxEtapas, 
			'fechaHoraVisita' => ($oTabla->fechaHoraVisita == 0)? Null: $oTabla->fechaHoraVisita, 
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
			EXEC CQxVisitaEnfermeraEliminar :idVisitaEnfermera, :idUsuarioAuditoria";

		$params = [
			'idVisitaEnfermera' => $oTabla->idVisitaEnfermera, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxVisitaEnfermeraSeleccionarPorId :idVisitaEnfermera";

		$params = [
			'idVisitaEnfermera' => $oTabla->idVisitaEnfermera, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorProgramacion($oTabla)
	{
		$query = "
			EXEC CQxVisitaEnfermeraSeleccionarPorProgramacion :idProgramacionSala";

		$params = [
			'idProgramacionSala' => $oTabla->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}