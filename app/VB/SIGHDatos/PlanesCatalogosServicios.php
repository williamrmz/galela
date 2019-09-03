<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class PlanesCatalogosServicios extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPlanCatalogo AS Int = :idPlanCatalogo
			SET NOCOUNT ON 
			EXEC PlanesCatalogosServiciosAgregar :idProducto, :precioUnitario, :idPlan, @idPlanCatalogo OUTPUT, :idUsuarioAuditoria
			SELECT @idPlanCatalogo AS idPlanCatalogo";

		$params = [
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'precioUnitario' => ($oTabla->precioUnitario == 0)? Null: $oTabla->precioUnitario, 
			'idPlan' => ($oTabla->idPlan == 0)? Null: $oTabla->idPlan, 
			'idPlanCatalogo' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC PlanesCatalogosServiciosModificar :idProducto, :precioUnitario, :idPlan, :idPlanCatalogo, :idUsuarioAuditoria";

		$params = [
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'precioUnitario' => ($oTabla->precioUnitario == 0)? Null: $oTabla->precioUnitario, 
			'idPlan' => ($oTabla->idPlan == 0)? Null: $oTabla->idPlan, 
			'idPlanCatalogo' => ($oTabla->idPlanCatalogo == 0)? Null: $oTabla->idPlanCatalogo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC PlanesCatalogosServiciosEliminar :idPlanCatalogo, :idUsuarioAuditoria";

		$params = [
			'idPlanCatalogo' => ($oTabla->idPlanCatalogo == 0)? Null: $oTabla->idPlanCatalogo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC PlanesCatalogosServiciosSeleccionarPorId :idPlanCatalogo";

		$params = [
			'idPlanCatalogo' => $oTabla->idPlanCatalogo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerPrecioUnitario($lIdProducto, $lIdTipoFinanciamiento)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}