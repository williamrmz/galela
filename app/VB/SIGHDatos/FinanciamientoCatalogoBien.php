<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FinanciamientoCatalogoBien extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPlanCatalogo AS Int = :idPlanCatalogo
			SET NOCOUNT ON 
			EXEC FactCatalogoBienesInsumosHospAgregar @idPlanCatalogo OUTPUT, :precioUnitario, :idProducto, :idTipoFinanciamiento, :activo, :idUsuarioAuditoria
			SELECT @idPlanCatalogo AS idPlanCatalogo";

		$params = [
			'idPlanCatalogo' => 0, 
			'precioUnitario' => ($oTabla->precioUnitario == 0)? Null: $oTabla->precioUnitario, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'activo' => ($oTabla->activo == 0)? Null: $oTabla->activo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactCatalogoBienesInsumosHospModificar :idPlanCatalogo, :precioUnitario, :idProducto, :idTipoFinanciamiento, :activo, :idUsuarioAuditoria";

		$params = [
			'idPlanCatalogo' => ($oTabla->idPlanCatalogo == 0)? Null: $oTabla->idPlanCatalogo, 
			'precioUnitario' => ($oTabla->precioUnitario == 0)? Null: $oTabla->precioUnitario, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'activo' => ($oTabla->activo == 0)? Null: $oTabla->activo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactCatalogoBienesInsumosHospEliminar :idPlanCatalogo, :idUsuarioAuditoria";

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
			EXEC FactCatalogoBienesInsumosHospSeleccionarPorId :idPlanCatalogo";

		$params = [
			'idPlanCatalogo' => $oTabla->idPlanCatalogo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorProductoYTipoFinanciamiento($oTabla)
	{
		$query = "
			EXEC FactCatalogoBienesInsumosHospXidTipoFinanciamiento :idProducto, :idTipoFinanciamiento";

		$params = [
			'idProducto' => $oTabla->idProducto, 
			'idTipoFinanciamiento' => $oTabla->idTipoFinanciamiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}