<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FinanciamientoCatalogoServ extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idFinanciamientoCatalogo AS Int = :idFinanciamientoCatalogo
			SET NOCOUNT ON 
			EXEC FinanciamientoCatalogoServiciosAgregar :activo, :idTipoFinanciamiento, :idProducto, :precioUnitario, @idFinanciamientoCatalogo OUTPUT, :idUsuarioAuditoria
			SELECT @idFinanciamientoCatalogo AS idFinanciamientoCatalogo";

		$params = [
			'activo' => ($oTabla->activo == 0)? Null: $oTabla->activo, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'precioUnitario' => ($oTabla->precioUnitario == 0)? Null: $oTabla->precioUnitario, 
			'idFinanciamientoCatalogo' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FinanciamientoCatalogoServiciosModificar :activo, :idTipoFinanciamiento, :idProducto, :precioUnitario, :idFinanciamientoCatalogo, :idUsuarioAuditoria";

		$params = [
			'activo' => ($oTabla->activo == 0)? Null: $oTabla->activo, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'precioUnitario' => ($oTabla->precioUnitario == "")? Null: $oTabla->precioUnitario, 
			'idFinanciamientoCatalogo' => ($oTabla->idFinanciamientoCatalogo == 0)? Null: $oTabla->idFinanciamientoCatalogo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FinanciamientoCatalogoServiciosEliminar :idFinanciamientoCatalogo, :idUsuarioAuditoria";

		$params = [
			'idFinanciamientoCatalogo' => ($oTabla->idFinanciamientoCatalogo == 0)? Null: $oTabla->idFinanciamientoCatalogo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FinanciamientoCatalogoServiciosSeleccionarPorId :idFinanciamientoCatalogo";

		$params = [
			'idFinanciamientoCatalogo' => $oTabla->idFinanciamientoCatalogo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorProductoYTipoFinanciamiento($oTabla)
	{
		$query = "
			EXEC FactCatalogoServiciosXidTipoFinanciamiento :idProducto, :idTipoFinanciamiento";

		$params = [
			'idProducto' => $oTabla->idProducto, 
			'idTipoFinanciamiento' => $oTabla->idTipoFinanciamiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}