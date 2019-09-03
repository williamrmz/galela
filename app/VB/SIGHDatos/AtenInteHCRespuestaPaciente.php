<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenInteHCRespuestaPaciente extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idGrupoHCPaciente AS Int = :idGrupoHCPaciente
			SET NOCOUNT ON 
			EXEC AtenInteGrupoHCRespuestaPacienteAgregar @idGrupoHCPaciente OUTPUT, :idPaciente, :itemRespuesta, :valorTexto, :valorNumero, :valorFecha, :valorNumeroFin, :valorFechaFin, :valorEspecificacion, :esActivo, :idUsuarioAuditoria
			SELECT @idGrupoHCPaciente AS idGrupoHCPaciente";

		$params = [
			'idGrupoHCPaciente' => 0, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'itemRespuesta' => ($oTabla->itemRespuesta == 0)? Null: $oTabla->itemRespuesta, 
			'valorTexto' => ($oTabla->valorTexto == "")? Null: $oTabla->valorTexto, 
			'valorNumero' => $oTabla->valorNumero, 
			'valorFecha' => ($oTabla->valorFecha == 0)? Null: $oTabla->valorFecha, 
			'valorNumeroFin' => $oTabla->valorNumeroFin, 
			'valorFechaFin' => ($oTabla->valorFechaFin == 0)? Null: $oTabla->valorFechaFin, 
			'valorEspecificacion' => ($oTabla->valorEspecificacion == "")? Null: $oTabla->valorEspecificacion, 
			'esActivo' => ($oTabla->esActivo == 0)? Null: $oTabla->esActivo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtenInteGrupoHCRespuestaPacienteModificar :idGrupoHCPaciente, :idPaciente, :itemRespuesta, :valorTexto, :valorNumero, :valorFecha, :valorNumeroFin, :valorFechaFin, :valorEspecificacion, :esActivo, :idUsuarioAuditoria";

		$params = [
			'idGrupoHCPaciente' => ($oTabla->idGrupoHCPaciente == 0)? Null: $oTabla->idGrupoHCPaciente, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'itemRespuesta' => ($oTabla->itemRespuesta == 0)? Null: $oTabla->itemRespuesta, 
			'valorTexto' => ($oTabla->valorTexto == "")? Null: $oTabla->valorTexto, 
			'valorNumero' => $oTabla->valorNumero, 
			'valorFecha' => ($oTabla->valorFecha == 0)? Null: $oTabla->valorFecha, 
			'valorNumeroFin' => $oTabla->valorNumeroFin, 
			'valorFechaFin' => ($oTabla->valorFechaFin == 0)? Null: $oTabla->valorFechaFin, 
			'valorEspecificacion' => ($oTabla->valorEspecificacion == "")? Null: $oTabla->valorEspecificacion, 
			'esActivo' => ($oTabla->esActivo == 0)? Null: $oTabla->esActivo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtenInteGrupoHCRespuestaPacienteEliminar :idGrupoHCPaciente, :idUsuarioAuditoria";

		$params = [
			'idGrupoHCPaciente' => $oTabla->idGrupoHCPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtenInteGrupoHCRespuestaPacienteSeleccionarPorId :idGrupoHCPaciente";

		$params = [
			'idGrupoHCPaciente' => $oTabla->idGrupoHCPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarRespuestasPorPacienteYGrupo($oGrupoHcPaciente)
	{
		$query = "
			EXEC AtenInteListarRespuestasPorPacienteYGrupo :idPaciente, :idAtenInteGrupo";

		$params = [
			'idPaciente' => $oGrupoHcPaciente->idPaciente, 
			'idAtenInteGrupo' => ($oGrupoHcPaciente->idAtenInteGrupo == 0)? Null: $oGrupoHcPaciente->idAtenInteGrupo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function verificaInsertar($oTabla)
	{
		$query = "
			EXEC AtenInteGrupoHCRespuestaPacienteVerificarAgregar :idGrupoHCPaciente, :idPaciente, :itemRespuesta, :valorTexto, :valorNumero, :valorFecha, :valorNumeroFin, :valorFechaFin, :valorEspecificacion, :esActivo, :idUsuarioAuditoria";

		$params = [
			'idGrupoHCPaciente' => ($oTabla->idGrupoHCPaciente == 0)? Null: $oTabla->idGrupoHCPaciente, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'itemRespuesta' => ($oTabla->itemRespuesta == 0)? Null: $oTabla->itemRespuesta, 
			'valorTexto' => ($oTabla->valorTexto == "")? Null: $oTabla->valorTexto, 
			'valorNumero' => $oTabla->valorNumero, 
			'valorFecha' => ($oTabla->valorFecha == 0)? Null: $oTabla->valorFecha, 
			'valorNumeroFin' => $oTabla->valorNumeroFin, 
			'valorFechaFin' => ($oTabla->valorFechaFin == 0)? Null: $oTabla->valorFechaFin, 
			'valorEspecificacion' => ($oTabla->valorEspecificacion == "")? Null: $oTabla->valorEspecificacion, 
			'esActivo' => ($oTabla->esActivo == 0)? Null: $oTabla->esActivo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function EliminarRespuestaPorPregunta($oTabla)
	{
		$query = "
			EXEC AtenInteGrupoHCRptaPacienteEliminarPorPregunta :idGrupoHCPaciente, :idPaciente, :idUsuarioAuditoria";

		$params = [
			'idGrupoHCPaciente' => $oTabla->idGrupoHCPaciente, 
			'idPaciente' => $oTabla->idPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}