<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenIntePlanProcedPaciente extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPlanProcedimientoPaciente AS Int = :idPlanProcedimientoPaciente
			SET NOCOUNT ON 
			EXEC AtenIntePlanProcedimientoPacienteAgregar @idPlanProcedimientoPaciente OUTPUT, :idPlanIntegralPaciente, :idProducto, :idPlanAtencion, :idAtenInteItemPlan, :fechaProgramada, :fechaEjecucion, :numeroDosis, :codigoHIS, :idAtencion, :idEstablecimiento, :idUsuarioAuditoria
			SELECT @idPlanProcedimientoPaciente AS idPlanProcedimientoPaciente";

		$params = [
			'idPlanProcedimientoPaciente' => 0, 
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idPlanAtencion' => ($oTabla->idPlanAtencion == 0)? Null: $oTabla->idPlanAtencion, 
			'idAtenInteItemPlan' => ($oTabla->idAtenInteItemPlan == 0)? Null: $oTabla->idAtenInteItemPlan, 
			'fechaProgramada' => ($oTabla->fechaProgramada == 0)? Null: $oTabla->fechaProgramada, 
			'fechaEjecucion' => ($oTabla->fechaEjecucion == 0)? Null: $oTabla->fechaEjecucion, 
			'numeroDosis' => $oTabla->numeroDosis, 
			'codigoHIS' => ($oTabla->codigoHIS == "")? Null: $oTabla->codigoHIS, 
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
			EXEC AtenIntePlanProcedimientoPacienteModificar :idPlanProcedimientoPaciente, :idPlanIntegralPaciente, :idProducto, :idPlanAtencion, :idAtenInteItemPlan, :fechaProgramada, :fechaEjecucion, :numeroDosis, :codigoHIS, :idAtencion, :idEstablecimiento, :idUsuarioAuditoria";

		$params = [
			'idPlanProcedimientoPaciente' => ($oTabla->idPlanProcedimientoPaciente == 0)? Null: $oTabla->idPlanProcedimientoPaciente, 
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idPlanAtencion' => ($oTabla->idPlanAtencion == 0)? Null: $oTabla->idPlanAtencion, 
			'idAtenInteItemPlan' => ($oTabla->idAtenInteItemPlan == 0)? Null: $oTabla->idAtenInteItemPlan, 
			'fechaProgramada' => ($oTabla->fechaProgramada == 0)? Null: $oTabla->fechaProgramada, 
			'fechaEjecucion' => ($oTabla->fechaEjecucion == 0)? Null: $oTabla->fechaEjecucion, 
			'numeroDosis' => $oTabla->numeroDosis, 
			'codigoHIS' => ($oTabla->codigoHIS == "")? Null: $oTabla->codigoHIS, 
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
			EXEC AtenIntePlanProcedimientoPacienteEliminar :idPlanProcedimientoPaciente, :idUsuarioAuditoria";

		$params = [
			'idPlanProcedimientoPaciente' => $oTabla->idPlanProcedimientoPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtenIntePlanProcedimientoPacienteSeleccionarPorId :idPlanProcedimientoPaciente";

		$params = [
			'idPlanProcedimientoPaciente' => $oTabla->idPlanProcedimientoPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarPlanProcedimientosPaciente($oTabla)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarPlanProcedimientosPacientePendientes($oTabla)
	{
		$query = "
			EXEC AtenInteListarProcedimientosPacientePendientes :idAtenInteGrupo, :idPaciente, :idAtenInteItemPlan, :idAtencion";

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
			EXEC AtenIntePlanProcedimientoPacienteModFechaProgramada :idPlanProcedimientoPaciente, :idPlanIntegralPaciente, :fechaProgramada, :idUsuarioAuditoria";

		$params = [
			'idPlanProcedimientoPaciente' => ($oTabla->idPlanProcedimientoPaciente == 0)? Null: $oTabla->idPlanProcedimientoPaciente, 
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'fechaProgramada' => ($oTabla->fechaProgramada == 0)? Null: $oTabla->fechaProgramada, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}