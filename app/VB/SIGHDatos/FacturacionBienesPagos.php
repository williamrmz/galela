<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FacturacionBienesPagos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC FacturacionBienesPagosAgregar :idOrden, :idProducto, :cantidadPagar, :precioVenta, :totalPagar, :idUsuarioAuditoria";

		$params = [
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cantidadPagar' => $oTabla->cantidadPagar, 
			'precioVenta' => $oTabla->precioVenta, 
			'totalPagar' => $oTabla->totalPagar, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FacturacionBienesPagosModificar :idOrden, :idProducto, :cantidadPagar, :precioVenta, :totalPagar, :idUsuarioAuditoria";

		$params = [
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cantidadPagar' => $oTabla->cantidadPagar, 
			'precioVenta' => $oTabla->precioVenta, 
			'totalPagar' => $oTabla->totalPagar, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FacturacionBienesPagosEliminar :idOrden, :idUsuarioAuditoria";

		$params = [
			'idOrden' => $oTabla->idOrden, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FacturacionBienesPagosSeleccionarPorId :idOrden";

		$params = [
			'idOrden' => $oTabla->idOrden, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorMovNumeroIdProducto($lcMovNumero, $lcMovTipo, $lnIdProducto)
	{
		$query = "
			EXEC FacturacionBienesPagosSeleccionarPorMovnumeroIdProducto :movNumero, :movTipo, :idProducto";

		$params = [
			'movNumero' => LcMovNumero, 
			'movTipo' => LcMovTipo, 
			'idProducto' => $lnIdProducto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ModificarXidOrdenIdProducto($oTabla)
	{
		$query = "
			EXEC FacturacionBienesPagosModificarXidOrdenIdProducto :idOrden, :idProducto, :cantidadPagar, :precioVenta, :totalPagar, :idUsuarioAuditoria";

		$params = [
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'cantidadPagar' => $oTabla->cantidadPagar, 
			'precioVenta' => $oTabla->precioVenta, 
			'totalPagar' => $oTabla->totalPagar, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}