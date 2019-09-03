<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Productos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idProducto AS Int = :idProducto
			SET NOCOUNT ON 
			EXEC ProductosAgregar :idCategoriaProducto, :bloqueado, :precioBase, :nombre, @idProducto OUTPUT, :codigo, :idUsuarioAuditoria
			SELECT @idProducto AS idProducto";

		$params = [
			'idCategoriaProducto' => ($oTabla->idCategoriaProducto == 0)? Null: $oTabla->idCategoriaProducto, 
			'bloqueado' => $oTabla->bloqueado, 
			'precioBase' => ($oTabla->precioBase == 0)? Null: $oTabla->precioBase, 
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'idProducto' => 0, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC ProductosModificar :idCategoriaProducto, :bloqueado, :precioBase, :nombre, :idProducto, :codigo, :idUsuarioAuditoria";

		$params = [
			'idCategoriaProducto' => ($oTabla->idCategoriaProducto == 0)? Null: $oTabla->idCategoriaProducto, 
			'bloqueado' => ($oTabla->bloqueado == 0)? Null: $oTabla->bloqueado, 
			'precioBase' => ($oTabla->precioBase == 0)? Null: $oTabla->precioBase, 
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC ProductosEliminar :idProducto, :idUsuarioAuditoria";

		$params = [
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC Select * from FactCatalogoBienesInsumos where IdProducto =  ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC ProductosSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}