<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FarmHistPrecio extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idHistPrecio AS Int = :idHistPrecio
			SET NOCOUNT ON 
			EXEC farmHistPrecioAgregar @idHistPrecio OUTPUT, :idProducto, :fecha, :precioCompra, :precioDistribucion, :precioVenta, :precioDonacion, :idUsuario, :idUsuarioAuditoria
			SELECT @idHistPrecio AS idHistPrecio";

		$params = [
			'idHistPrecio' => 0, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'precioCompra' => $oTabla->precioCompra, 
			'precioDistribucion' => $oTabla->precioDistribucion, 
			'precioVenta' => $oTabla->precioVenta, 
			'precioDonacion' => $oTabla->precioDonacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC farmHistPrecioModificar :idHistPrecio, :idProducto, :fecha, :precioCompra, :precioDistribucion, :precioVenta, :precioDonacion, :idUsuario, :idUsuarioAuditoria";

		$params = [
			'idHistPrecio' => ($oTabla->idHistPrecio == 0)? Null: $oTabla->idHistPrecio, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'precioCompra' => $oTabla->precioCompra, 
			'precioDistribucion' => $oTabla->precioDistribucion, 
			'precioVenta' => $oTabla->precioVenta, 
			'precioDonacion' => $oTabla->precioDonacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC farmHistPrecioEliminar :idHistPrecio, :idUsuarioAuditoria";

		$params = [
			'idHistPrecio' => $oTabla->idHistPrecio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC farmHistPrecioSeleccionarPorId :idHistPrecio";

		$params = [
			'idHistPrecio' => $oTabla->idHistPrecio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}