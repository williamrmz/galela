<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CategoriasProducto extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idClasificacionServicio AS Int = :idClasificacionServicio
			SET NOCOUNT ON 
			EXEC FactClasificacionServiciosAgregar :descripcion, @idClasificacionServicio OUTPUT, :idUsuarioAuditoria
			SELECT @idClasificacionServicio AS idClasificacionServicio";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idClasificacionServicio' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactClasificacionServiciosModificar :descripcion, :idClasificacionServicio, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idClasificacionServicio' => ($oTabla->idClasificacionServicio == 0)? Null: $oTabla->idClasificacionServicio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactClasificacionServiciosEliminar :idClasificacionServicio, :idUsuarioAuditoria";

		$params = [
			'idClasificacionServicio' => ($oTabla->idClasificacionServicio == 0)? Null: $oTabla->idClasificacionServicio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FactClasificacionServiciosSeleccionarPorId :idClasificacionServicio";

		$params = [
			'idClasificacionServicio' => $oTabla->idClasificacionServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC Select * from ClasificacionServicios ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}