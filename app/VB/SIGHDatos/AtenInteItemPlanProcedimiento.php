<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenInteItemPlanProcedimiento extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idItemPlanProcedimiento AS Bigint = :idItemPlanProcedimiento
			SET NOCOUNT ON 
			EXEC AtenInteItemPlanProcedimientoAgregar @idItemPlanProcedimiento OUTPUT, :idPlanAtencion, :idProducto, :numeroDosis, :idAtenInteItemPlan, :idUsuarioAuditoria
			SELECT @idItemPlanProcedimiento AS idItemPlanProcedimiento";

		$params = [
			'idItemPlanProcedimiento' => 0, 
			'idPlanAtencion' => ($oTabla->idPlanAtencion == 0)? Null: $oTabla->idPlanAtencion, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'numeroDosis' => $oTabla->numeroDosis, 
			'idAtenInteItemPlan' => ($oTabla->idAtenInteItemPlan == 0)? Null: $oTabla->idAtenInteItemPlan, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtenInteItemPlanProcedimientoModificar :idItemPlanProcedimiento, :idPlanAtencion, :idProducto, :numeroDosis, :idAtenInteItemPlan, :idUsuarioAuditoria";

		$params = [
			'idItemPlanProcedimiento' => $oTabla->idItemPlanProcedimiento, 
			'idPlanAtencion' => ($oTabla->idPlanAtencion == 0)? Null: $oTabla->idPlanAtencion, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'numeroDosis' => $oTabla->numeroDosis, 
			'idAtenInteItemPlan' => ($oTabla->idAtenInteItemPlan == 0)? Null: $oTabla->idAtenInteItemPlan, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtenInteItemPlanProcedimientoEliminar :idItemPlanProcedimiento, :idUsuarioAuditoria";

		$params = [
			'idItemPlanProcedimiento' => $oTabla->idItemPlanProcedimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtenInteItemPlanProcedimientoSeleccionarPorId :idItemPlanProcedimiento";

		$params = [
			'idItemPlanProcedimiento' => $oTabla->idItemPlanProcedimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}