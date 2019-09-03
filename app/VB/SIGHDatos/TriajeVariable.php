<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TriajeVariable extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idTriajeVariable AS Int = :idTriajeVariable
			SET NOCOUNT ON 
			EXEC TriajeVariableAgregar @idTriajeVariable OUTPUT, :triajeVariable, :esAntropometrica, :tieneLimiteMedicion, :edadDiaLimiteMinima, :edadDiaLimiteMaxima, :esDatoObligatorio, :esActivo, :idUsuarioAuditoria
			SELECT @idTriajeVariable AS idTriajeVariable";

		$params = [
			'idTriajeVariable' => 0, 
			'triajeVariable' => ($oTabla->triajeVariable == "")? Null: $oTabla->triajeVariable, 
			'esAntropometrica' => ($oTabla->esAntropometrica == 0)? Null: $oTabla->esAntropometrica, 
			'tieneLimiteMedicion' => ($oTabla->tieneLimiteMedicion == 0)? Null: $oTabla->tieneLimiteMedicion, 
			'edadDiaLimiteMinima' => ($oTabla->edadDiaLimiteMinima == 0)? Null: $oTabla->edadDiaLimiteMinima, 
			'edadDiaLimiteMaxima' => ($oTabla->edadDiaLimiteMaxima == 0)? Null: $oTabla->edadDiaLimiteMaxima, 
			'esDatoObligatorio' => ($oTabla->esDatoObligatorio == 0)? Null: $oTabla->esDatoObligatorio, 
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
			EXEC TriajeVariableModificar :idTriajeVariable, :triajeVariable, :esAntropometrica, :tieneLimiteMedicion, :edadDiaLimiteMinima, :edadDiaLimiteMaxima, :esDatoObligatorio, :esActivo, :idUsuarioAuditoria";

		$params = [
			'idTriajeVariable' => ($oTabla->idTriajeVariable == 0)? Null: $oTabla->idTriajeVariable, 
			'triajeVariable' => ($oTabla->triajeVariable == "")? Null: $oTabla->triajeVariable, 
			'esAntropometrica' => ($oTabla->esAntropometrica == 0)? Null: $oTabla->esAntropometrica, 
			'tieneLimiteMedicion' => ($oTabla->tieneLimiteMedicion == 0)? Null: $oTabla->tieneLimiteMedicion, 
			'edadDiaLimiteMinima' => ($oTabla->edadDiaLimiteMinima == 0)? Null: $oTabla->edadDiaLimiteMinima, 
			'edadDiaLimiteMaxima' => ($oTabla->edadDiaLimiteMaxima == 0)? Null: $oTabla->edadDiaLimiteMaxima, 
			'esDatoObligatorio' => ($oTabla->esDatoObligatorio == 0)? Null: $oTabla->esDatoObligatorio, 
			'esActivo' => ($oTabla->esActivo == 0)? Null: $oTabla->esActivo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TriajeVariableEliminar :idTriajeVariable, :idUsuarioAuditoria";

		$params = [
			'idTriajeVariable' => $oTabla->idTriajeVariable, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TriajeVariableSeleccionarPorId :idTriajeVariable";

		$params = [
			'idTriajeVariable' => $oTabla->idTriajeVariable, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarVariableTodos()
	{
		$query = "
			EXEC TriajeListarVariableTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarVariablesAntropometricas()
	{
		$query = "
			EXEC TriajeListarVariableAntropometricas ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}