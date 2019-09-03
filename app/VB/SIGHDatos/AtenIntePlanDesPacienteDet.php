<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenIntePlanDesPacienteDet extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPlanDesarrolloPaciente AS Int = :idPlanDesarrolloPaciente
			SET NOCOUNT ON 
			EXEC AtenIntePlanDesPacienteDetAgregar @idPlanDesarrolloPaciente OUTPUT, :idPlanIntegralPaciente, :idItemDesarrollo, :ordenItem, :ejecutaAccion, :idUsuarioAuditoria
			SELECT @idPlanDesarrolloPaciente AS idPlanDesarrolloPaciente";

		$params = [
			'idPlanDesarrolloPaciente' => 0, 
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'idItemDesarrollo' => ($oTabla->idItemDesarrollo == 0)? Null: $oTabla->idItemDesarrollo, 
			'ordenItem' => ($oTabla->ordenItem == 0)? Null: $oTabla->ordenItem, 
			'ejecutaAccion' => ($oTabla->ejecutaAccion == 0)? Null: $oTabla->ejecutaAccion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtenIntePlanDesPacienteDetModificar :idPlanDesarrolloPaciente, :idPlanIntegralPaciente, :idItemDesarrollo, :ordenItem, :ejecutaAccion, :idUsuarioAuditoria";

		$params = [
			'idPlanDesarrolloPaciente' => ($oTabla->idPlanDesarrolloPaciente == 0)? Null: $oTabla->idPlanDesarrolloPaciente, 
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'idItemDesarrollo' => ($oTabla->idItemDesarrollo == 0)? Null: $oTabla->idItemDesarrollo, 
			'ordenItem' => ($oTabla->ordenItem == 0)? Null: $oTabla->ordenItem, 
			'ejecutaAccion' => ($oTabla->respondioEjecutaAccion == False)? Null: $oTabla->ejecutaAccion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtenIntePlanDesPacienteDetEliminar :idPlanDesarrolloPaciente, :idUsuarioAuditoria";

		$params = [
			'idPlanDesarrolloPaciente' => $oTabla->idPlanDesarrolloPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtenIntePlanDesPacienteDetSeleccionarPorId :idPlanDesarrolloPaciente";

		$params = [
			'idPlanDesarrolloPaciente' => $oTabla->idPlanDesarrolloPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarPlanDesarrolloPacienteDetallePorId($oTabla)
	{
		$query = "
			EXEC AtenInteListarDesarrolloPacienteDetPorId :idPlanIntegralPaciente, :idPlanDesarrolloPaciente";

		$params = [
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'idPlanDesarrolloPaciente' => $oTabla->idPlanDesarrolloPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}