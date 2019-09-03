<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenInteGrupoHCPaciente extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPaciente AS Int = :idPaciente
			SET NOCOUNT ON 
			EXEC AtenInteGrupoHCPacienteAgregar @idPaciente OUTPUT, :idGrupoHCPaciente, :idAtenInteGrupo, :idPregunta, :idUsuarioAuditoria
			SELECT @idPaciente AS idPaciente";

		$params = [
			'idPaciente' => 0, 
			'idGrupoHCPaciente' => ($oTabla->idGrupoHCPaciente == 0)? Null: $oTabla->idGrupoHCPaciente, 
			'idAtenInteGrupo' => ($oTabla->idAtenInteGrupo == 0)? Null: $oTabla->idAtenInteGrupo, 
			'idPregunta' => ($oTabla->idPregunta == 0)? Null: $oTabla->idPregunta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtenInteGrupoHCPacienteModificar :idPaciente, :idGrupoHCPaciente, :idAtenInteGrupo, :idPregunta, :idUsuarioAuditoria";

		$params = [
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idGrupoHCPaciente' => ($oTabla->idGrupoHCPaciente == 0)? Null: $oTabla->idGrupoHCPaciente, 
			'idAtenInteGrupo' => ($oTabla->idAtenInteGrupo == 0)? Null: $oTabla->idAtenInteGrupo, 
			'idPregunta' => ($oTabla->idPregunta == 0)? Null: $oTabla->idPregunta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtenInteGrupoHCPacienteEliminar :idPaciente, :idUsuarioAuditoria";

		$params = [
			'idPaciente' => $oTabla->idPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtenInteGrupoHCPacienteSeleccionarPorId :idPaciente";

		$params = [
			'idPaciente' => $oTabla->idPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarPreguntasPorPacienteYGrupo($oGrupoHcPaciente)
	{
		$query = "
			EXEC AtenInteListarPreguntasPorPacienteYGrupo :idPaciente, :idAtenInteGrupo";

		$params = [
			'idPaciente' => $oGrupoHcPaciente->idPaciente, 
			'idAtenInteGrupo' => ($oGrupoHcPaciente->idAtenInteGrupo == 0)? Null: $oGrupoHcPaciente->idAtenInteGrupo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function verificarInsertar(&$oTabla)
	{
		$query = "
			DECLARE @idGrupoHCPaciente AS Int = :idGrupoHCPaciente
			SET NOCOUNT ON 
			EXEC AtenInteVerificaIngresaPreguntaPaciente @idGrupoHCPaciente OUTPUT, :idPaciente, :idAtenInteGrupo, :idPregunta, :idUsuarioAuditoria
			SELECT @idGrupoHCPaciente AS idGrupoHCPaciente";

		$params = [
			'idGrupoHCPaciente' => 0, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idAtenInteGrupo' => ($oTabla->idAtenInteGrupo == 0)? Null: $oTabla->idAtenInteGrupo, 
			'idPregunta' => ($oTabla->idPregunta == 0)? Null: $oTabla->idPregunta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

}