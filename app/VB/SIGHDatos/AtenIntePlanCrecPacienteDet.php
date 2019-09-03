<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenIntePlanCrecPacienteDet extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPlanCrecimientoPaciente AS Int = :idPlanCrecimientoPaciente
			SET NOCOUNT ON 
			EXEC AtenIntePlanCrecPacienteDetAgregar @idPlanCrecimientoPaciente OUTPUT, :idPlanIntegralPaciente, :idTriajeVariable, :variableValor, :ordenItem, :idUsuarioAuditoria
			SELECT @idPlanCrecimientoPaciente AS idPlanCrecimientoPaciente";

		$params = [
			'idPlanCrecimientoPaciente' => 0, 
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'idTriajeVariable' => ($oTabla->idTriajeVariable == 0)? Null: $oTabla->idTriajeVariable, 
			'variableValor' => $oTabla->variableValor, 
			'ordenItem' => ($oTabla->ordenItem == 0)? Null: $oTabla->ordenItem, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtenIntePlanCrecPacienteDetModificar :idPlanCrecimientoPaciente, :idPlanIntegralPaciente, :idTriajeVariable, :variableValor, :ordenItem, :idUsuarioAuditoria";

		$params = [
			'idPlanCrecimientoPaciente' => ($oTabla->idPlanCrecimientoPaciente == 0)? Null: $oTabla->idPlanCrecimientoPaciente, 
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'idTriajeVariable' => ($oTabla->idTriajeVariable == 0)? Null: $oTabla->idTriajeVariable, 
			'variableValor' => $oTabla->variableValor, 
			'ordenItem' => ($oTabla->ordenItem == 0)? Null: $oTabla->ordenItem, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtenIntePlanCrecPacienteDetEliminar :idPlanCrecimientoPaciente, :idUsuarioAuditoria";

		$params = [
			'idPlanCrecimientoPaciente' => $oTabla->idPlanCrecimientoPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtenIntePlanCrecPacienteDetSeleccionarPorId :idPlanCrecimientoPaciente";

		$params = [
			'idPlanCrecimientoPaciente' => $oTabla->idPlanCrecimientoPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}