<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class PlanesProductos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPlanProducto AS Int = :idPlanProducto
			SET NOCOUNT ON 
			EXEC PlanesProductosAgregar :precio, :idProducto, :idPlan, @idPlanProducto OUTPUT, :idUsuarioAuditoria
			SELECT @idPlanProducto AS idPlanProducto";

		$params = [
			'precio' => ($oTabla->precio == 0)? Null: $oTabla->precio, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idPlan' => ($oTabla->idPlan == 0)? Null: $oTabla->idPlan, 
			'idPlanProducto' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC PlanesProductosModificar :precio, :idProducto, :idPlan, :idPlanProducto, :idUsuarioAuditoria";

		$params = [
			'precio' => ($oTabla->precio == 0)? Null: $oTabla->precio, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idPlan' => ($oTabla->idPlan == 0)? Null: $oTabla->idPlan, 
			'idPlanProducto' => ($oTabla->idPlanProducto == 0)? Null: $oTabla->idPlanProducto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC PlanesProductosEliminar :idPlanProducto, :idUsuarioAuditoria";

		$params = [
			'idPlanProducto' => ($oTabla->idPlanProducto == 0)? Null: $oTabla->idPlanProducto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC PlanesProductosSeleccionarPorId :idPlanProducto";

		$params = [
			'idPlanProducto' => $oTabla->idPlanProducto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarPorIdProducto($lIdProducto)
	{
		$query = "
			EXEC PlanesProductosEliminarPorIdProducto :idProducto";

		$params = [
			'idProducto' => $lIdProducto, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorIdProducto($lIdProducto)
	{
		$query = "
			EXEC PlanesProductosSeleccionarPorIdProducto :idProducto";

		$params = [
			'idProducto' => $lIdProducto, 
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