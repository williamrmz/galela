<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class RecetaDetalleItem extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC RecetaDetalleItemAgregar :idReceta, :idItem, :documentoDespacho, :cantidadDespachada, :idUsuarioAuditoria";

		$params = [
			'idReceta' => ($oTabla->idReceta == 0)? Null: $oTabla->idReceta, 
			'idItem' => ($oTabla->idItem == 0)? Null: $oTabla->idItem, 
			'documentoDespacho' => ($oTabla->documentoDespacho == "")? Null: $oTabla->documentoDespacho, 
			'cantidadDespachada' => ($oTabla->cantidadDespachada == 0)? Null: $oTabla->cantidadDespachada, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC RecetaDetalleItemModificar :idReceta, :idItem, :documentoDespacho, :cantidadDespachada, :idUsuarioAuditoria";

		$params = [
			'idReceta' => ($oTabla->idReceta == 0)? Null: $oTabla->idReceta, 
			'idItem' => ($oTabla->idItem == 0)? Null: $oTabla->idItem, 
			'documentoDespacho' => ($oTabla->documentoDespacho == "")? Null: $oTabla->documentoDespacho, 
			'cantidadDespachada' => ($oTabla->cantidadDespachada == 0)? Null: $oTabla->cantidadDespachada, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC RecetaDetalleItemEliminar :idReceta, :idUsuarioAuditoria";

		$params = [
			'idReceta' => $oTabla->idReceta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC RecetaDetalleItemSeleccionarPorId :idReceta";

		$params = [
			'idReceta' => $oTabla->idReceta, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}