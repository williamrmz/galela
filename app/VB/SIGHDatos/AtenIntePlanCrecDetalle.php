<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenIntePlanCrecDetalle extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idItemPlanCrecimiento AS Bigint = :idItemPlanCrecimiento
			SET NOCOUNT ON 
			EXEC AtenIntePlanCrecDetalleAgregar @idItemPlanCrecimiento OUTPUT, :idTriajeVariable, :ordenItem, :idUsuarioAuditoria
			SELECT @idItemPlanCrecimiento AS idItemPlanCrecimiento";

		$params = [
			'idItemPlanCrecimiento' => 0, 
			'idTriajeVariable' => ($oTabla->idTriajeVariable == 0)? Null: $oTabla->idTriajeVariable, 
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
			EXEC AtenIntePlanCrecDetalleModificar :idItemPlanCrecimiento, :idTriajeVariable, :ordenItem, :idUsuarioAuditoria";

		$params = [
			'idItemPlanCrecimiento' => $oTabla->idItemPlanCrecimiento, 
			'idTriajeVariable' => ($oTabla->idTriajeVariable == 0)? Null: $oTabla->idTriajeVariable, 
			'ordenItem' => ($oTabla->ordenItem == 0)? Null: $oTabla->ordenItem, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtenIntePlanCrecDetalleEliminar :idItemPlanCrecimiento, :idUsuarioAuditoria";

		$params = [
			'idItemPlanCrecimiento' => $oTabla->idItemPlanCrecimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtenIntePlanCrecDetalleSeleccionarPorId :idItemPlanCrecimiento";

		$params = [
			'idItemPlanCrecimiento' => $oTabla->idItemPlanCrecimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}