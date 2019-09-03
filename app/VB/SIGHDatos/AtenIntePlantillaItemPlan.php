<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenIntePlantillaItemPlan extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPlantillaItemPlan AS Int = :idPlantillaItemPlan
			SET NOCOUNT ON 
			EXEC AtenIntePlantillaItemPlanAgregar @idPlantillaItemPlan OUTPUT, :idAtenInteGrupo, :idAtenInteItemPlan, :idUsuarioAuditoria
			SELECT @idPlantillaItemPlan AS idPlantillaItemPlan";

		$params = [
			'idPlantillaItemPlan' => 0, 
			'idAtenInteGrupo' => $oTabla->idAtenInteGrupo, 
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
			EXEC AtenIntePlantillaItemPlanModificar :idPlantillaItemPlan, :idAtenInteGrupo, :idAtenInteItemPlan, :idUsuarioAuditoria";

		$params = [
			'idPlantillaItemPlan' => ($oTabla->idPlantillaItemPlan == 0)? Null: $oTabla->idPlantillaItemPlan, 
			'idAtenInteGrupo' => $oTabla->idAtenInteGrupo, 
			'idAtenInteItemPlan' => ($oTabla->idAtenInteItemPlan == 0)? Null: $oTabla->idAtenInteItemPlan, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtenIntePlantillaItemPlanEliminar :idPlantillaItemPlan, :idUsuarioAuditoria";

		$params = [
			'idPlantillaItemPlan' => $oTabla->idPlantillaItemPlan, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtenIntePlantillaItemPlanSeleccionarPorId :idPlantillaItemPlan";

		$params = [
			'idPlantillaItemPlan' => $oTabla->idPlantillaItemPlan, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}