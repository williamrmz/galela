<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenIntePlanItemElaborado extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idAtenInteItemPlan AS Int = :idAtenInteItemPlan
			SET NOCOUNT ON 
			EXEC AtenIntePlanItemElaboradoAgregar @idAtenInteItemPlan OUTPUT, :idPlanIntegralPaciente, :esElaborado, :idUsuarioAuditoria
			SELECT @idAtenInteItemPlan AS idAtenInteItemPlan";

		$params = [
			'idAtenInteItemPlan' => 0, 
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'esElaborado' => ($oTabla->esElaborado == 0)? Null: $oTabla->esElaborado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtenIntePlanItemElaboradoModificar :idAtenInteItemPlan, :idPlanIntegralPaciente, :esElaborado, :idUsuarioAuditoria";

		$params = [
			'idAtenInteItemPlan' => ($oTabla->idAtenInteItemPlan == 0)? Null: $oTabla->idAtenInteItemPlan, 
			'idPlanIntegralPaciente' => $oTabla->idPlanIntegralPaciente, 
			'esElaborado' => ($oTabla->esElaborado == 0)? Null: $oTabla->esElaborado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtenIntePlanItemElaboradoEliminar :idAtenInteItemPlan, :idUsuarioAuditoria";

		$params = [
			'idAtenInteItemPlan' => $oTabla->idAtenInteItemPlan, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtenIntePlanItemElaboradoSeleccionarPorId :idAtenInteItemPlan";

		$params = [
			'idAtenInteItemPlan' => $oTabla->idAtenInteItemPlan, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}