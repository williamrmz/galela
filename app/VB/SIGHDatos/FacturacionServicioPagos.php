<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FacturacionServicioPagos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC FacturacionServicioPagosAgregar :idOrdenPago, :idProducto, :cantidad, :precio, :total, :idUsuarioAuditoria";

		$params = [
			'idOrdenPago' => ($oTabla->idOrdenPago == 0)? Null: $oTabla->idOrdenPago, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cantidad' => $oTabla->cantidad, 
			'precio' => $oTabla->precio, 
			'total' => $oTabla->total, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FacturacionServicioPagosModificar :idOrdenPago, :idProducto, :cantidad, :precio, :total, :idUsuarioAuditoria";

		$params = [
			'idOrdenPago' => ($oTabla->idOrdenPago == 0)? Null: $oTabla->idOrdenPago, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cantidad' => $oTabla->cantidad, 
			'precio' => $oTabla->precio, 
			'total' => $oTabla->total, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FacturacionServicioPagosEliminar :idOrdenPago, :idUsuarioAuditoria";

		$params = [
			'idOrdenPago' => $oTabla->idOrdenPago, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FacturacionServicioPagosSeleccionarPorId :idOrdenPago";

		$params = [
			'idOrdenPago' => $oTabla->idOrdenPago, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdOrdenIdProducto($lnIdOrden, $lnIdProducto)
	{
		$query = "
			EXEC FacturacionServicioPagosSeleccionarPorIdOrdenIdProducto :idOrden, :idProducto";

		$params = [
			'idOrden' => $lnIdOrden, 
			'idProducto' => $lnIdProducto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AgregarPagosOtrosProcedimientos($lnIdCuentaPago, $lnfecha, $lnEstado, $lnIdProducto)
	{
		$query = "
			EXEC PagoOtrosProcedimientosAgregar :idCuentaPago, :fechaPago, :estadoPago, :idProducto";

		$params = [
			'idCuentaPago' => ($lnIdCuentaPago == 0)? Null: $lnIdCuentaPago, 
			'fechaPago' => ($lnfecha == "")? Null: $lnfecha, 
			'estadoPago' => $lnEstado, 
			'idProducto' => $lnIdProducto, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}