<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TriajeEmergenciaVariable extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idTriajeEmergenciaVariable AS Int = :idTriajeEmergenciaVariable
			SET NOCOUNT ON 
			EXEC TriajeEmergenciaVariableAgregar @idTriajeEmergenciaVariable OUTPUT, :idTriajeEmergencia, :idSignosVitales, :valor, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idTriajeEmergenciaVariable AS idTriajeEmergenciaVariable";

		$params = [
			'idTriajeEmergenciaVariable' => 0, 
			'idTriajeEmergencia' => ($oTabla->idTriajeEmergencia == 0)? Null: $oTabla->idTriajeEmergencia, 
			'idSignosVitales' => ($oTabla->idSignosVitales == 0)? Null: $oTabla->idSignosVitales, 
			'valor' => $oTabla->valor, 
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
			EXEC TriajeEmergenciaVariableModificar :idTriajeEmergenciaVariable, :idTriajeEmergencia, :idSignosVitales, :valor, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idTriajeEmergenciaVariable' => ($oTabla->idTriajeEmergenciaVariable == 0)? Null: $oTabla->idTriajeEmergenciaVariable, 
			'idTriajeEmergencia' => ($oTabla->idTriajeEmergencia == 0)? Null: $oTabla->idTriajeEmergencia, 
			'idSignosVitales' => ($oTabla->idSignosVitales == 0)? Null: $oTabla->idSignosVitales, 
			'valor' => $oTabla->valor, 
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
			EXEC TriajeEmergenciaVariableEliminar :idTriajeEmergenciaVariable, :idUsuarioAuditoria";

		$params = [
			'idTriajeEmergenciaVariable' => $oTabla->idTriajeEmergenciaVariable, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TriajeEmergenciaVariableSeleccionarPorId :idTriajeEmergenciaVariable";

		$params = [
			'idTriajeEmergenciaVariable' => $oTabla->idTriajeEmergenciaVariable, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarTriajeEmergenciaVariable($lnIdPaciente)
	{
		$query = "
			EXEC TiposSignosVitalesListar :idTriajeEmergencia";

		$params = [
			'idTriajeEmergencia' => $lnIdPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarTriajeEmergenciaVariablePA($oTabla)
	{
		$query = "
			EXEC TiposSignosVitalesListarPA :idTriajeEmergencia";

		$params = [
			'idTriajeEmergencia' => $oTabla->idTriajeEmergencia, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ModificarPA($oTabla)
	{
		$query = "
			EXEC TriajeEmergenciaPAModificar :idTriajeEmergencia, :valor";

		$params = [
			'idTriajeEmergencia' => ($oTabla->idTriajeEmergencia == 0)? Null: $oTabla->idTriajeEmergencia, 
			'valor' => ($oTabla->valor == "___/__")? Null: $oTabla->valor, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}