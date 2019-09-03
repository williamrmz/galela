<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenInteItemPlanDesarrollo extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idItemPlanDesarrollo AS Bigint = :idItemPlanDesarrollo
			SET NOCOUNT ON 
			EXEC AtenInteItemPlanDesarrolloAgregar @idItemPlanDesarrollo OUTPUT, :idPlanAtencion, :numeroSesion, :idUsuarioAuditoria
			SELECT @idItemPlanDesarrollo AS idItemPlanDesarrollo";

		$params = [
			'idItemPlanDesarrollo' => 0, 
			'idPlanAtencion' => ($oTabla->idPlanAtencion == 0)? Null: $oTabla->idPlanAtencion, 
			'numeroSesion' => ($oTabla->numeroSesion == 0)? Null: $oTabla->numeroSesion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtenInteItemPlanDesarrolloModificar :idItemPlanDesarrollo, :idPlanAtencion, :numeroSesion, :idUsuarioAuditoria";

		$params = [
			'idItemPlanDesarrollo' => $oTabla->idItemPlanDesarrollo, 
			'idPlanAtencion' => ($oTabla->idPlanAtencion == 0)? Null: $oTabla->idPlanAtencion, 
			'numeroSesion' => ($oTabla->numeroSesion == 0)? Null: $oTabla->numeroSesion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtenInteItemPlanDesarrolloEliminar :idItemPlanDesarrollo, :idUsuarioAuditoria";

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
			EXEC AtenInteItemPlanDesarrolloSeleccionarPorId :idItemPlanDesarrollo";

		$params = [
			'idItemPlanDesarrollo' => $oTabla->idItemPlanDesarrollo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}