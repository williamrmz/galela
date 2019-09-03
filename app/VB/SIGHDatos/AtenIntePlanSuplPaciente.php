<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenIntePlanSuplPaciente extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPlanSuplementoPaciente AS Int = :idPlanSuplementoPaciente
			SET NOCOUNT ON 
			EXEC AtenIntePlanSuplementoPacienteAgregar @idPlanSuplementoPaciente OUTPUT, :idPlanIntegralPaciente, :idPlanAtencion, :idProducto, :idAtenInteItemPlan, :fechaProgramada, :fechaEjecucion, :numeroDosis, :idAtencion, :idEstablecimiento, :idUsuarioAuditoria
			SELECT @idPlanSuplementoPaciente AS idPlanSuplementoPaciente";

		$params = [
			'idPlanSuplementoPaciente' => 0, 
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'idPlanAtencion' => ($oTabla->idPlanAtencion == 0)? Null: $oTabla->idPlanAtencion, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idAtenInteItemPlan' => ($oTabla->idAtenInteItemPlan == 0)? Null: $oTabla->idAtenInteItemPlan, 
			'fechaProgramada' => ($oTabla->fechaProgramada == 0)? Null: $oTabla->fechaProgramada, 
			'fechaEjecucion' => ($oTabla->fechaEjecucion == 0)? Null: $oTabla->fechaEjecucion, 
			'numeroDosis' => $oTabla->numeroDosis, 
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
			EXEC AtenIntePlanSuplementoPacienteModificar :idPlanSuplementoPaciente, :idPlanIntegralPaciente, :idPlanAtencion, :idProducto, :idAtenInteItemPlan, :fechaProgramada, :fechaEjecucion, :numeroDosis, :idAtencion, :idEstablecimiento, :idUsuarioAuditoria";

		$params = [
			'idPlanSuplementoPaciente' => ($oTabla->idPlanSuplementoPaciente == 0)? Null: $oTabla->idPlanSuplementoPaciente, 
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'idPlanAtencion' => ($oTabla->idPlanAtencion == 0)? Null: $oTabla->idPlanAtencion, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idAtenInteItemPlan' => ($oTabla->idAtenInteItemPlan == 0)? Null: $oTabla->idAtenInteItemPlan, 
			'fechaProgramada' => ($oTabla->fechaProgramada == 0)? Null: $oTabla->fechaProgramada, 
			'fechaEjecucion' => ($oTabla->fechaEjecucion == 0)? Null: $oTabla->fechaEjecucion, 
			'numeroDosis' => $oTabla->numeroDosis, 
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
			EXEC AtenIntePlanSuplementoPacienteEliminar :idPlanSuplementoPaciente, :idUsuarioAuditoria";

		$params = [
			'idPlanSuplementoPaciente' => $oTabla->idPlanSuplementoPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtenIntePlanSuplementoPacienteSeleccionarPorId :idPlanSuplementoPaciente";

		$params = [
			'idPlanSuplementoPaciente' => $oTabla->idPlanSuplementoPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarPlanSuplementoPaciente($oTabla)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarPlanSuplementoPacientePendientes($oTabla)
	{
		$query = "
			EXEC AtenInteListarSuplementoPacientePendientes :idAtenInteGrupo, :idPaciente, :idAtenInteItemPlan, :idAtencion";

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
			EXEC AtenIntePlanSuplementoPacienteModFechaProgramada :idPlanSuplementoPaciente, :idPlanIntegralPaciente, :fechaProgramada, :idUsuarioAuditoria";

		$params = [
			'idPlanSuplementoPaciente' => ($oTabla->idPlanSuplementoPaciente == 0)? Null: $oTabla->idPlanSuplementoPaciente, 
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'fechaProgramada' => ($oTabla->fechaProgramada == 0)? Null: $oTabla->fechaProgramada, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}