<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenInteItemPlan extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idAtenInteItemPlan AS Int = :idAtenInteItemPlan
			SET NOCOUNT ON 
			EXEC AtenInteItemPlanAgregar @idAtenInteItemPlan OUTPUT, :itemPlan, :idUsuarioAuditoria
			SELECT @idAtenInteItemPlan AS idAtenInteItemPlan";

		$params = [
			'idAtenInteItemPlan' => 0, 
			'itemPlan' => ($oTabla->itemPlan == "")? Null: $oTabla->itemPlan, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtenInteItemPlanModificar :idAtenInteItemPlan, :itemPlan, :idUsuarioAuditoria";

		$params = [
			'idAtenInteItemPlan' => ($oTabla->idAtenInteItemPlan == 0)? Null: $oTabla->idAtenInteItemPlan, 
			'itemPlan' => ($oTabla->itemPlan == "")? Null: $oTabla->itemPlan, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtenInteItemPlanEliminar :idAtenInteItemPlan, :idUsuarioAuditoria";

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
			EXEC AtenInteItemPlanSeleccionarPorId :idAtenInteItemPlan";

		$params = [
			'idAtenInteItemPlan' => $oTabla->idAtenInteItemPlan, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}