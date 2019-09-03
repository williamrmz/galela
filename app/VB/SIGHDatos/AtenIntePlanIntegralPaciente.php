<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenIntePlanIntegralPaciente extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPlanIntegralPaciente AS Bigint = :idPlanIntegralPaciente
			SET NOCOUNT ON 
			EXEC AtenIntePlanIntegralPacienteAgregar @idPlanIntegralPaciente OUTPUT, :idAtenInteGrupo, :idPaciente, :fechaElaboracion, :idUsuarioAuditoria
			SELECT @idPlanIntegralPaciente AS idPlanIntegralPaciente";

		$params = [
			'idPlanIntegralPaciente' => 0, 
			'idAtenInteGrupo' => $oTabla->idAtenInteGrupo, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'fechaElaboracion' => ($oTabla->fechaElaboracion == 0)? Null: $oTabla->fechaElaboracion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtenIntePlanIntegralPacienteModificar :idPlanIntegralPaciente, :idAtenInteGrupo, :idPaciente, :fechaElaboracion, :idUsuarioAuditoria";

		$params = [
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'idAtenInteGrupo' => $oTabla->idAtenInteGrupo, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'fechaElaboracion' => ($oTabla->fechaElaboracion == 0)? Null: $oTabla->fechaElaboracion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtenIntePlanIntegralPacienteEliminar :idPlanIntegralPaciente, :idUsuarioAuditoria";

		$params = [
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtenIntePlanIntegralPacienteSeleccionarPorId :idPlanIntegralPaciente";

		$params = [
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function verificarInsertar($oTabla)
	{
		$query = "
			DECLARE @idPlanIntegralPaciente AS Bigint = :idPlanIntegralPaciente
			SET NOCOUNT ON 
			EXEC AtenInteVerificaIngresaPlanIntegralPaciente @idPlanIntegralPaciente OUTPUT, :idAtenInteGrupo, :idPaciente, :idUsuarioAuditoria
			SELECT @idPlanIntegralPaciente AS idPlanIntegralPaciente";

		$params = [
			'idPlanIntegralPaciente' => 0, 
			'idAtenInteGrupo' => $oTabla->idAtenInteGrupo, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function SeleccionarPorPacienteYGrupo($oTabla)
	{
		$query = "
			EXEC AtenInteBuscarPlanIntegralPorPacienteYGrupo :idAtenInteGrupo, :idPaciente";

		$params = [
			'idAtenInteGrupo' => $oTabla->idAtenInteGrupo, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function GenerarPlanIntegralProcedimiento($oTabla)
	{
		$query = "
			EXEC AtenInteGenerarPlanProcedimiento :idPlanIntegralPaciente, :idAtenInteGrupo, :idAtenInteItemPlan, :idPaciente, :idUsuarioAuditoria";

		$params = [
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'idAtenInteGrupo' => $oTabla->idAtenInteGrupo, 
			'idAtenInteItemPlan' => $oTabla->idAtenInteItemPlan, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function GenerarPlanIntegralCrecimiento($oTabla)
	{
		$query = "
			EXEC AtenInteGenerarPlanCrecimiento :idPlanIntegralPaciente, :idAtenInteGrupo, :idAtenInteItemPlan, :idPaciente, :idUsuarioAuditoria";

		$params = [
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'idAtenInteGrupo' => $oTabla->idAtenInteGrupo, 
			'idAtenInteItemPlan' => $oTabla->idAtenInteItemPlan, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function GenerarPlanIntegralDesarrollo($oTabla)
	{
		$query = "
			EXEC AtenInteGenerarPlanDesarrollo :idPlanIntegralPaciente, :idAtenInteGrupo, :idAtenInteItemPlan, :idPaciente, :idUsuarioAuditoria";

		$params = [
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'idAtenInteGrupo' => $oTabla->idAtenInteGrupo, 
			'idAtenInteItemPlan' => $oTabla->idAtenInteItemPlan, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function GenerarPlanIntegralSuplemento($oTabla)
	{
		$query = "
			EXEC AtenInteGenerarPlanSuplemento :idPlanIntegralPaciente, :idAtenInteGrupo, :idAtenInteItemPlan, :idPaciente, :idUsuarioAuditoria";

		$params = [
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'idAtenInteGrupo' => $oTabla->idAtenInteGrupo, 
			'idAtenInteItemPlan' => $oTabla->idAtenInteItemPlan, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}