<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenIntePlanDesDetalle extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idItemPlanDesarrollo AS Bigint = :idItemPlanDesarrollo
			SET NOCOUNT ON 
			EXEC AtenIntePlanDesDetalleAgregar @idItemPlanDesarrollo OUTPUT, :idItemDesarrollo, :ordenItem, :idUsuarioAuditoria
			SELECT @idItemPlanDesarrollo AS idItemPlanDesarrollo";

		$params = [
			'idItemPlanDesarrollo' => 0, 
			'idItemDesarrollo' => ($oTabla->idItemDesarrollo == 0)? Null: $oTabla->idItemDesarrollo, 
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
			EXEC AtenIntePlanDesDetalleModificar :idItemPlanDesarrollo, :idItemDesarrollo, :ordenItem, :idUsuarioAuditoria";

		$params = [
			'idItemPlanDesarrollo' => $oTabla->idItemPlanDesarrollo, 
			'idItemDesarrollo' => ($oTabla->idItemDesarrollo == 0)? Null: $oTabla->idItemDesarrollo, 
			'ordenItem' => ($oTabla->ordenItem == 0)? Null: $oTabla->ordenItem, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtenIntePlanDesDetalleEliminar :idItemPlanDesarrollo, :idUsuarioAuditoria";

		$params = [
			'idItemPlanDesarrollo' => $oTabla->idItemPlanDesarrollo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtenIntePlanDesDetalleSeleccionarPorId :idItemPlanDesarrollo";

		$params = [
			'idItemPlanDesarrollo' => $oTabla->idItemPlanDesarrollo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}