<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TriajeEmergencia extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idTriajeEmergencia AS Int = :idTriajeEmergencia
			SET NOCOUNT ON 
			EXEC TriajeEmergenciaAgregar @idTriajeEmergencia OUTPUT, :idPaciente, :idMotivoAtencionEmergencia, :idMedicoTriaje, :idMedicoTopico, :idServicio, :fecha, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idTriajeEmergencia AS idTriajeEmergencia";

		$params = [
			'idTriajeEmergencia' => 0, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idMotivoAtencionEmergencia' => ($oTabla->idMotivoAtencionEmergencia == 0)? Null: $oTabla->idMotivoAtencionEmergencia, 
			'idMedicoTriaje' => ($oTabla->idMedicoTriaje == 0)? Null: $oTabla->idMedicoTriaje, 
			'idMedicoTopico' => ($oTabla->idMedicoTopico == 0)? Null: $oTabla->idMedicoTopico, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
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
			EXEC TriajeEmergenciaModificar :idTriajeEmergencia, :idMotivoAtencionEmergencia, :idMedicoTopico, :idServicio, :idUsuarioAuditoria";

		$params = [
			'idTriajeEmergencia' => ($oTabla->idTriajeEmergencia == 0)? Null: $oTabla->idTriajeEmergencia, 
			'idMotivoAtencionEmergencia' => ($oTabla->idMotivoAtencionEmergencia == 0)? Null: $oTabla->idMotivoAtencionEmergencia, 
			'idMedicoTopico' => ($oTabla->idMedicoTopico == 0)? Null: $oTabla->idMedicoTopico, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TriajeEmergenciaVariableEliminar :idTriajeEmergencia, :idUsuarioAuditoria";

		$params = [
			'idTriajeEmergencia' => $oTabla->idTriajeEmergencia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TriajeEmergenciaSeleccionarPorId :idTriajeEmergencia";

		$params = [
			'idTriajeEmergencia' => $oTabla->idTriajeEmergencia, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oDOCQxOrdenOperatoriaMQ)
	{
		$query = "
			EXEC TriajeEmergenciaFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdTriaje($oTabla)
	{
		$query = "
			EXEC TriajeEmergenciaListarPorId :idTriajeEmergencia";

		$params = [
			'idTriajeEmergencia' => $oTabla->idTriajeEmergencia, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarTriaje($oTabla)
	{
		$query = "
			EXEC TriajeEmergenciaEliminar :idTriajeEmergencia, :idUsuarioAuditoria";

		$params = [
			'idTriajeEmergencia' => $oTabla->idTriajeEmergencia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Validar($id)
	{
		$query = "
			EXEC TraijeEmergenciaValidarUsuario :idTriajeEmergencia";

		$params = [
			'idTriajeEmergencia' => Id, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}