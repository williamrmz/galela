<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FarmMovimientoDetalle extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC farmMovimientoDetalleAgregar :movNumero, :movTipo, :idProducto, :lote, :fechaVencimiento, :item, :cantidad, :precio, :total, :registroSanitario, :idTipoSalidaBienInsumo, :documentoNumero, :idUsuarioAuditoria";

		$params = [
			'movNumero' => ($oTabla->movNumero == "")? Null: $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'lote' => ($oTabla->lote == "")? Null: $oTabla->lote, 
			'fechaVencimiento' => ($oTabla->fechaVencimiento == 0)? Null: $oTabla->fechaVencimiento, 
			'item' => ($oTabla->item == 0)? Null: $oTabla->item, 
			'cantidad' => $oTabla->cantidad, 
			'precio' => $oTabla->precio, 
			'total' => $oTabla->total, 
			'registroSanitario' => ($oTabla->registroSanitario == "")? Null: $oTabla->registroSanitario, 
			'idTipoSalidaBienInsumo' => ($oTabla->idTipoSalidaBienInsumo == 0)? Null: $oTabla->idTipoSalidaBienInsumo, 
			'documentoNumero' => $oTabla->documentoNumero, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC farmMovimientoDetalleModificar :movNumero, :movTipo, :idProducto, :lote, :fechaVencimiento, :item, :cantidad, :precio, :total, :registroSanitario, :idTipoSalidaBienInsumo, :documentoNumero, :idUsuarioAuditoria";

		$params = [
			'movNumero' => ($oTabla->movNumero == "")? Null: $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'lote' => ($oTabla->lote == "")? Null: $oTabla->lote, 
			'fechaVencimiento' => ($oTabla->fechaVencimiento == 0)? Null: $oTabla->fechaVencimiento, 
			'item' => ($oTabla->item == 0)? Null: $oTabla->item, 
			'cantidad' => ($oTabla->cantidad == 0)? Null: $oTabla->cantidad, 
			'precio' => $oTabla->precio, 
			'total' => $oTabla->total, 
			'registroSanitario' => ($oTabla->registroSanitario == "")? Null: $oTabla->registroSanitario, 
			'idTipoSalidaBienInsumo' => ($oTabla->idTipoSalidaBienInsumo == 0)? Null: $oTabla->idTipoSalidaBienInsumo, 
			'documentoNumero' => $oTabla->documentoNumero, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC farmMovimientoDetalleEliminar :movNumero, :movTipo, :idProducto, :lote, :fechaVencimiento, :idTipoSalidaBienInsumo, :idUsuarioAuditoria";

		$params = [
			'movNumero' => $oTabla->movNumero, 
			'movTipo' => $oTabla->movTipo, 
			'idProducto' => $oTabla->idProducto, 
			'lote' => $oTabla->lote, 
			'fechaVencimiento' => $oTabla->fechaVencimiento, 
			'idTipoSalidaBienInsumo' => ($oTabla->idTipoSalidaBienInsumo == 0)? Null: $oTabla->idTipoSalidaBienInsumo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC farmMovimientoDetalleSeleccionarPorId :movNumero";

		$params = [
			'movNumero' => $oTabla->movNumero, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function DevuelveTodosItems($lcMovNumero, $lcMovTipo)
	{
		$query = "
			EXEC FarmMovimientosDetalleDevuelveTodosItems :movNumero, :movTipo";

		$params = [
			'movNumero' => LcMovNumero, 
			'movTipo' => LcMovTipo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FarmDevuelveMovimientosDeProducto($lnIdProducto, $ldFechaFin)
	{
		$query = "
			EXEC FarmDevuelveMovimientosDeProducto :idProducto, :fechaInicio, :fechaFin";

		$params = [
			'idProducto' => $lnIdProducto, 
			'fechaInicio' => ldFechaInicio, 
			'fechaFin' => $ldFechaFin, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FarmDevuelveMovimientosParaICIeIDI($ldFechaInicio, $ldFechaFin, $lnIdAlmacen, $lcMovTipo)
	{
		$query = "
			EXEC FarmDevuelveMovimientosParaICIeIDI :fechaInicio, :fechaFin, :idAlmacen, :movTipo";

		$params = [
			'fechaInicio' => $ldFechaInicio, 
			'fechaFin' => $ldFechaFin, 
			'idAlmacen' => $lnIdAlmacen, 
			'movTipo' => LcMovTipo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizaSaldosPorProducto($lcEntradaOsalida, $lnIdAlmacen, $lnIdProducto, $lcLote, $ldFechaVencimiento, $lnidTipoSalidaBienInsumo, $lnCantidad, $lnPrecio, $ldFechaMovimiento)
	{
		$query = "
			EXEC FarmActualizaSaldosPorProducto :lcEntradaSalida, :idAlmacen, :idProducto, :lote, :fechaVencimiento, :cantidad, :precio, :idTipoSalidaBienInsumo";

		$params = [
			'lcEntradaSalida' => $lcEntradaOsalida, 
			'idAlmacen' => $lnIdAlmacen, 
			'idProducto' => $lnIdProducto, 
			'lote' => $lcLote, 
			'fechaVencimiento' => $ldFechaVencimiento, 
			'cantidad' => $lnCantidad, 
			'precio' => $lnPrecio, 
			'idTipoSalidaBienInsumo' => $lnidTipoSalidaBienInsumo, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function FarmDevuelveSaldosConLotesSegunAlmacen($lnIdAlmacen, $lnOrden, $lcFiltro)
	{
		$query = "
			EXEC farmDevuelveSaldosConLotesSegunAlmacen :idAlmacen, :orden, :filtro";

		$params = [
			'idAlmacen' => $lnIdAlmacen, 
			'orden' => $lnOrden, 
			'filtro' => $lcFiltro, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function farmDevuelveSaldosSegunAlmacenProductoLote($lnIdAlmacen, $lnIdProducto, $lcLote, $ldFechaVencimiento, $lnidTipoSalidaBienInsumo)
	{
		$query = "
			EXEC farmDevuelveSaldosSegunAlmacenProductoLote :idAlmacen, :idProducto, :lote, :fechaVencimiento, :idTipoSalidaBienInsumo";

		$params = [
			'idAlmacen' => $lnIdAlmacen, 
			'idProducto' => $lnIdProducto, 
			'lote' => $lcLote, 
			'fechaVencimiento' => $ldFechaVencimiento, 
			'idTipoSalidaBienInsumo' => $lnidTipoSalidaBienInsumo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function farmMovimientoDetalleDevuelveSalidasSegunAlmacenProductoLote($lnIdAlmacen, $lnIdProducto, $lcLote, $ldFechaVencimiento)
	{
		$query = "
			EXEC farmMovimientoDetalleDevuelveSalidasSegunAlmacenProductoLote :idAlmacen, :idProducto, :lote, :fechaVencimiento";

		$params = [
			'idAlmacen' => $lnIdAlmacen, 
			'idProducto' => $lnIdProducto, 
			'lote' => $lcLote, 
			'fechaVencimiento' => $ldFechaVencimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizaSaldosMensuales($lcEntradaOsalida, $lnIdAlmacen, $lnIdProducto, $ldFechaMovimiento, $lnidTipoSalidaBienInsumo, $lnCantidad, $lcLote, $ldFechaVencimiento, $lnPrecio)
	{
		$query = "
			EXEC FarmActualizaSaldosMensual :lcEntradaSalida, :idAlmacen, :idProducto, :cantidad, :fechaMov, :lote, :fechaVencimiento, :precio, :idTipoSalidaBienInsumo";

		$params = [
			'lcEntradaSalida' => $lcEntradaOsalida, 
			'idAlmacen' => $lnIdAlmacen, 
			'idProducto' => $lnIdProducto, 
			'cantidad' => $lnCantidad, 
			'fechaMov' => ldFechaMov, 
			'lote' => $lcLote, 
			'fechaVencimiento' => $ldFechaVencimiento, 
			'precio' => $lnPrecio, 
			'idTipoSalidaBienInsumo' => $lnidTipoSalidaBienInsumo, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function FarmDevuelveMovimientosParaICIeIDIPorTproducto($ldFechaInicio, $ldFechaFin, $lnIdAlmacen, $lcMovTipo)
	{
		$query = "
			EXEC FarmDevuelveMovimientosParaICIeIDIPorTproducto :fechaInicio, :fechaFin, :idAlmacen, :movTipo";

		$params = [
			'fechaInicio' => $ldFechaInicio, 
			'fechaFin' => $ldFechaFin, 
			'idAlmacen' => $lnIdAlmacen, 
			'movTipo' => LcMovTipo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FarmDevuelveSaldosConLotesSegunAlmacenCliente($lnIdAlmacen, $lnOrden, $lcFiltro)
	{
		$query = "
			EXEC FarmMovimientoDetalleDevuelveSaldosConLotesSegunAlmacenCliente :lnidAlmacen, :lnorden, :lcFiltro";

		$params = [
			'lnidAlmacen' => $lnIdAlmacen, 
			'lnorden' => $lnOrden, 
			'lcFiltro' => $lcFiltro, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function DevuelveTodosItemsSOPORTE($lcMovNumero, $lcMovTipo)
	{
		$query = "
			EXEC FarmMovimientosDetalleDevuelveTodosItemsSOPORTE :movNumero, :movTipo";

		$params = [
			'movNumero' => LcMovNumero, 
			'movTipo' => LcMovTipo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}