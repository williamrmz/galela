<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class EstadosProducto extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idEstadoProducto AS Int = :idEstadoProducto
			SET NOCOUNT ON 
			EXEC EstadoProductoAgregar :descripcion, @idEstadoProducto OUTPUT, :idUsuarioAuditoria
			SELECT @idEstadoProducto AS idEstadoProducto";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idEstadoProducto' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC EstadoProductoModificar :descripcion, :idEstadoProducto, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idEstadoProducto' => ($oTabla->idEstadoProducto == 0)? Null: $oTabla->idEstadoProducto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC EstadoProductoEliminar :idEstadoProducto, :idUsuarioAuditoria";

		$params = [
			'idEstadoProducto' => ($oTabla->idEstadoProducto == 0)? Null: $oTabla->idEstadoProducto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC EstadoProductoSeleccionarPorId :idEstadoProducto";

		$params = [
			'idEstadoProducto' => $oTabla->idEstadoProducto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}