<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenInteItemPlanCrecimiento extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idItemPlanCrecimiento AS Bigint = :idItemPlanCrecimiento
			SET NOCOUNT ON 
			EXEC AtenInteItemPlanCrecimientoAgregar @idItemPlanCrecimiento OUTPUT, :idPlanAtencion, :numeroSesion, :idUsuarioAuditoria
			SELECT @idItemPlanCrecimiento AS idItemPlanCrecimiento";

		$params = [
			'idItemPlanCrecimiento' => 0, 
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
			EXEC AtenInteItemPlanCrecimientoModificar :idItemPlanCrecimiento, :idPlanAtencion, :numeroSesion, :idUsuarioAuditoria";

		$params = [
			'idItemPlanCrecimiento' => $oTabla->idItemPlanCrecimiento, 
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
			EXEC AtenInteItemPlanCrecimientoEliminar :idItemPlanCrecimiento, :idUsuarioAuditoria";

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
			EXEC AtenInteItemPlanCrecimientoSeleccionarPorId :idItemPlanCrecimiento";

		$params = [
			'idItemPlanCrecimiento' => $oTabla->idItemPlanCrecimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}