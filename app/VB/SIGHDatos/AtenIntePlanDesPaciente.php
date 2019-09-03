<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenIntePlanDesPaciente extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPlanDesarrolloPaciente AS Int = :idPlanDesarrolloPaciente
			SET NOCOUNT ON 
			EXEC AtenIntePlanDesarrolloPacienteAgregar @idPlanDesarrolloPaciente OUTPUT, :idPlanIntegralPaciente, :evaluacion, :idPlanAtencion, :idAtenInteItemPlan, :fechaProgramada, :fechaEjecucion, :numeroSesion, :idAtencion, :idEstablecimiento, :idUsuarioAuditoria
			SELECT @idPlanDesarrolloPaciente AS idPlanDesarrolloPaciente";

		$params = [
			'idPlanDesarrolloPaciente' => 0, 
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'evaluacion' => ($oTabla->evaluacion == 0)? Null: $oTabla->evaluacion, 
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
			EXEC AtenIntePlanDesarrolloPacienteModificar :idPlanDesarrolloPaciente, :idPlanIntegralPaciente, :evaluacion, :idPlanAtencion, :idAtenInteItemPlan, :fechaProgramada, :fechaEjecucion, :numeroSesion, :idAtencion, :idEstablecimiento, :idUsuarioAuditoria";

		$params = [
			'idPlanDesarrolloPaciente' => ($oTabla->idPlanDesarrolloPaciente == 0)? Null: $oTabla->idPlanDesarrolloPaciente, 
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'evaluacion' => ($oTabla->evaluacion == 0)? Null: $oTabla->evaluacion, 
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
			EXEC AtenIntePlanDesarrolloPacienteEliminar :idPlanDesarrolloPaciente, :idUsuarioAuditoria";

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
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function setRsSeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtenIntePlanDesarrolloPacienteSeleccionarPorId :idPlanDesarrolloPaciente, :idPlanIntegralPaciente";

		$params = [
			'idPlanDesarrolloPaciente' => $oTabla->idPlanDesarrolloPaciente, 
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarPlanDesarrolloPaciente($oTabla)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarPlanDesarrolloPacientePendientes($oTabla)
	{
		$query = "
			EXEC AtenInteListarDesarrolloPacientePendientesDet :idAtenInteGrupo, :idPaciente, :idAtenInteItemPlan, :idAtencion";

		$params = [
			'idAtenInteGrupo' => $oTabla->idAtenInteGrupo, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idAtenInteItemPlan' => $oTabla->idAtenInteItemPlan, 
			'idAtencion' => $oTabla->idAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ItemDesarrolloPacientePendiente($oTabla)
	{
		$query = "
			EXEC AtenInteItemDesarrolloPacientePendiente :idAtenInteGrupo, :idPaciente, :idAtenInteItemPlan, :idAtencion";

		$params = [
			'idAtenInteGrupo' => $oTabla->idAtenInteGrupo, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idAtenInteItemPlan' => $oTabla->idAtenInteItemPlan, 
			'idAtencion' => $oTabla->idAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ModificarFechaProgramada($oTabla)
	{
		$query = "
			EXEC AtenIntePlanDesarrolloPacienteModFechaProgramada :idPlanDesarrolloPaciente, :idPlanIntegralPaciente, :fechaProgramada, :idUsuarioAuditoria";

		$params = [
			'idPlanDesarrolloPaciente' => ($oTabla->idPlanDesarrolloPaciente == 0)? Null: $oTabla->idPlanDesarrolloPaciente, 
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'fechaProgramada' => ($oTabla->fechaProgramada == 0)? Null: $oTabla->fechaProgramada, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarPlanDesarrolloPacientePendientesParaImpresion($oTabla)
	{
		$query = "
			EXEC AtenInteListarPlanDesarrolloPacienteDet :idAtenInteGrupo, :idPaciente, :idAtenInteItemPlan";

		$params = [
			'idAtenInteGrupo' => $oTabla->idAtenInteGrupo, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idAtenInteItemPlan' => $oTabla->idAtenInteItemPlan, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarAtencionIntegral($oTabla)
	{
		$query = "
			EXEC AtenIntePlanAtecionPacienteEliminaEjecucion :idAtencion, :idPaciente";

		$params = [
			'idAtencion' => $oTabla->idAtencion, 
			'idPaciente' => $oTabla->idPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarPlanDesarrolloPacienteVencidos($oTabla)
	{
		$query = "
			EXEC AtenInteListarPlanDesarrolloPacienteVencidos :idAtenInteGrupo, :idPaciente, :idAtenInteItemPlan, :idAtencion";

		$params = [
			'idAtenInteGrupo' => $oTabla->idAtenInteGrupo, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idAtenInteItemPlan' => $oTabla->idAtenInteItemPlan, 
			'idAtencion' => $oTabla->idAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}