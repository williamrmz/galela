<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FactCatalogoServiciosHosp extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idFinanciamientoCatalogo AS Int = :idFinanciamientoCatalogo
			SET NOCOUNT ON 
			EXEC FactCatalogoServiciosHospAgregar @idFinanciamientoCatalogo OUTPUT, :precioUnitario, :idProducto, :idTipoFinanciamiento, :activo, :seUsaSinPrecio, :idUsuarioAuditoria
			SELECT @idFinanciamientoCatalogo AS idFinanciamientoCatalogo";

		$params = [
			'idFinanciamientoCatalogo' => 0, 
			'precioUnitario' => $oTabla->precioUnitario, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'activo' => ($oTabla->activo == 0)? Null: $oTabla->activo, 
			'seUsaSinPrecio' => $oTabla->seUsaSinPrecio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactCatalogoServiciosHospModificar :idFinanciamientoCatalogo, :precioUnitario, :idProducto, :idTipoFinanciamiento, :activo, :seUsaSinPrecio, :idUsuarioAuditoria";

		$params = [
			'idFinanciamientoCatalogo' => ($oTabla->idFinanciamientoCatalogo == 0)? Null: $oTabla->idFinanciamientoCatalogo, 
			'precioUnitario' => $oTabla->precioUnitario, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'activo' => ($oTabla->activo == 0)? Null: $oTabla->activo, 
			'seUsaSinPrecio' => $oTabla->seUsaSinPrecio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];
		// dd($params);

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactCatalogoServiciosHospEliminar :idFinanciamientoCatalogo, :idUsuarioAuditoria";

		$params = [
			'idFinanciamientoCatalogo' => $oTabla->idFinanciamientoCatalogo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FactCatalogoServiciosHospSeleccionarPorId :idFinanciamientoCatalogo";

		$params = [
			'idFinanciamientoCatalogo' => $oTabla->idFinanciamientoCatalogo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}