<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenInteItemPlanSupl extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @itemPlanSuplemento AS Bigint = :itemPlanSuplemento
			SET NOCOUNT ON 
			EXEC AtenInteItemPlanSuplementoAgregar @itemPlanSuplemento OUTPUT, :idPlanAtencion, :idProducto, :numeroDosis, :idUsuarioAuditoria
			SELECT @itemPlanSuplemento AS itemPlanSuplemento";

		$params = [
			'itemPlanSuplemento' => 0, 
			'idPlanAtencion' => ($oTabla->idPlanAtencion == 0)? Null: $oTabla->idPlanAtencion, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'numeroDosis' => ($oTabla->numeroDosis == 0)? Null: $oTabla->numeroDosis, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtenInteItemPlanSuplementoModificar :itemPlanSuplemento, :idPlanAtencion, :idProducto, :numeroDosis, :idUsuarioAuditoria";

		$params = [
			'itemPlanSuplemento' => $oTabla->itemPlanSuplemento, 
			'idPlanAtencion' => ($oTabla->idPlanAtencion == 0)? Null: $oTabla->idPlanAtencion, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'numeroDosis' => ($oTabla->numeroDosis == 0)? Null: $oTabla->numeroDosis, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtenInteItemPlanSuplementoEliminar :itemPlanSuplemento, :idUsuarioAuditoria";

		$params = [
			'itemPlanSuplemento' => $oTabla->itemPlanSuplemento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtenInteItemPlanSuplementoSeleccionarPorId :itemPlanSuplemento";

		$params = [
			'itemPlanSuplemento' => $oTabla->itemPlanSuplemento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}