<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenIntePlanCrecPaciente extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPlanCrecimientoPaciente AS Int = :idPlanCrecimientoPaciente
			SET NOCOUNT ON 
			EXEC AtenIntePlanCrecimientoPacienteAgregar @idPlanCrecimientoPaciente OUTPUT, :idPlanIntegralPaciente, :idPlanAtencion, :idAtenInteItemPlan, :fechaProgramada, :fechaEjecucion, :numeroSesion, :idAtencion, :idEstablecimiento, :idUsuarioAuditoria
			SELECT @idPlanCrecimientoPaciente AS idPlanCrecimientoPaciente";

		$params = [
			'idPlanCrecimientoPaciente' => 0, 
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'idPlanAtencion' => ($oTabla->idPlanAtencion == 0)? Null: $oTabla->idPlanAtencion, 
			'idAtenInteItemPlan' => ($oTabla->idAtenInteItemPlan == 0)? Null: $oTabla->idAtenInteItemPlan, 
			'fechaProgramada' => ($oTabla->fechaProgramada == 0)? Null: $oTabla->fechaProgramada, 
			'fechaEjecucion' => ($oTabla->fechaEjecucion == 0)? Null: $oTabla->fechaEjecucion, 
			'numeroSesion' => ($oTabla->numeroSesion == 0)? Null: $oTabla->numeroSesion, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idEstablecimiento' => ($oTabla->idEstablecimiento == 0)? Null: $oTabla->idEstablecimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtenIntePlanCrecimientoPacienteModificar :idPlanCrecimientoPaciente, :idPlanIntegralPaciente, :idPlanAtencion, :idAtenInteItemPlan, :fechaProgramada, :fechaEjecucion, :numeroSesion, :idAtencion, :idEstablecimiento, :idUsuarioAuditoria";

		$params = [
			'idPlanCrecimientoPaciente' => ($oTabla->idPlanCrecimientoPaciente == 0)? Null: $oTabla->idPlanCrecimientoPaciente, 
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'idPlanAtencion' => ($oTabla->idPlanAtencion == 0)? Null: $oTabla->idPlanAtencion, 
			'idAtenInteItemPlan' => ($oTabla->idAtenInteItemPlan == 0)? Null: $oTabla->idAtenInteItemPlan, 
			'fechaProgramada' => ($oTabla->fechaProgramada == 0)? Null: $oTabla->fechaProgramada, 
			'fechaEjecucion' => ($oTabla->fechaEjecucion == 0)? Null: $oTabla->fechaEjecucion, 
			'numeroSesion' => ($oTabla->numeroSesion == 0)? Null: $oTabla->numeroSesion, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idEstablecimiento' => ($oTabla->idEstablecimiento == 0)? Null: $oTabla->idEstablecimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtenIntePlanCrecimientoPacienteEliminar :idPlanCrecimientoPaciente, :idUsuarioAuditoria";

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
			EXEC AtenIntePlanCrecimientoPacienteSeleccionarPorId :idPlanCrecimientoPaciente";

		$params = [
			'idPlanCrecimientoPaciente' => $oTabla->idPlanCrecimientoPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}