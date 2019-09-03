<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FarmInventarioDetalle extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC farmInventarioDetalleAgregar :idInventario, :idProducto, :lote, :fechaVencimiento, :cantidad, :precio, :registroSanitario, :idTipoSalidaBienInsumo, :cantidadSaldo, :cantidadFaltante, :cantidadSobrante, :esHistoricoSaldo, :idUsuarioAuditoria";

		$params = [
			'idInventario' => ($oTabla->idInventario == 0)? Null: $oTabla->idInventario, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'lote' => ($oTabla->lote == "")? Null: $oTabla->lote, 
			'fechaVencimiento' => ($oTabla->fechaVencimiento == 0)? Null: $oTabla->fechaVencimiento, 
			'cantidad' => $oTabla->cantidad, 
			'precio' => $oTabla->precio, 
			'registroSanitario' => ($oTabla->registroSanitario == "")? Null: $oTabla->registroSanitario, 
			'idTipoSalidaBienInsumo' => ($oTabla->idTipoSalidaBienInsumo == 0)? Null: $oTabla->idTipoSalidaBienInsumo, 
			'cantidadSaldo' => $oTabla->cantidadSaldo, 
			'cantidadFaltante' => $oTabla->cantidadFaltante, 
			'cantidadSobrante' => $oTabla->cantidadSobrante, 
			'esHistoricoSaldo' => $oTabla->esHistoricoSaldo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC farmInventarioDetalleModificar :idInventario, :idProducto, :lote, :fechaVencimiento, :cantidad, :precio, :registroSanitario, :idTipoSalidaBienInsumo, :cantidadSaldo, :cantidadFaltante, :cantidadSobrante, :esHistoricoSaldo, :idUsuarioAuditoria";

		$params = [
			'idInventario' => ($oTabla->idInventario == 0)? Null: $oTabla->idInventario, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'lote' => ($oTabla->lote == "")? Null: $oTabla->lote, 
			'fechaVencimiento' => ($oTabla->fechaVencimiento == 0)? Null: $oTabla->fechaVencimiento, 
			'cantidad' => $oTabla->cantidad, 
			'precio' => $oTabla->precio, 
			'registroSanitario' => ($oTabla->registroSanitario == "")? Null: $oTabla->registroSanitario, 
			'idTipoSalidaBienInsumo' => ($oTabla->idTipoSalidaBienInsumo == 0)? Null: $oTabla->idTipoSalidaBienInsumo, 
			'cantidadSaldo' => $oTabla->cantidadSaldo, 
			'cantidadFaltante' => $oTabla->cantidadFaltante, 
			'cantidadSobrante' => $oTabla->cantidadSobrante, 
			'esHistoricoSaldo' => $oTabla->esHistoricoSaldo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC farmInventarioDetalleEliminar :idInventario, :idUsuarioAuditoria";

		$params = [
			'idInventario' => $oTabla->idInventario, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC farmInventarioDetalleSeleccionarPorId :idInventario";

		$params = [
			'idInventario' => $oTabla->idInventario, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function DevuelveProductosLotesPorId($lnIdInventario)
	{
		$query = "
			EXEC farmInventarioDetalleDevuelveProductosLotesPorId :lnIdInventario";

		$params = [
			'lnIdInventario' => $lnIdInventario, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}