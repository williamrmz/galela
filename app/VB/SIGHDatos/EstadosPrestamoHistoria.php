<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class EstadosPrestamoHistoria extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idEstadoPrestamo AS Int = :idEstadoPrestamo
			SET NOCOUNT ON 
			EXEC EstadosPrestamoHistoriaAgregar :descripcion, @idEstadoPrestamo OUTPUT, :idUsuarioAuditoria
			SELECT @idEstadoPrestamo AS idEstadoPrestamo";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idEstadoPrestamo' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC EstadosPrestamoHistoriaModificar :descripcion, :idEstadoPrestamo, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idEstadoPrestamo' => ($oTabla->idEstadoPrestamo == 0)? Null: $oTabla->idEstadoPrestamo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC EstadosPrestamoHistoriaEliminar :idEstadoPrestamo, :idUsuarioAuditoria";

		$params = [
			'idEstadoPrestamo' => ($oTabla->idEstadoPrestamo == 0)? Null: $oTabla->idEstadoPrestamo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC EstadosPrestamoHistoriaSeleccionarPorId :idEstadoPrestamo";

		$params = [
			'idEstadoPrestamo' => $oTabla->idEstadoPrestamo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC EstadosPrestamoHistoriaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}