<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class EstadosMovimientoHistoria extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idEstadoMovimiento AS Int = :idEstadoMovimiento
			SET NOCOUNT ON 
			EXEC EstadosMovimientoHistoriaAgregar :descripcion, @idEstadoMovimiento OUTPUT, :idUsuarioAuditoria
			SELECT @idEstadoMovimiento AS idEstadoMovimiento";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idEstadoMovimiento' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC EstadosMovimientoHistoriaModificar :descripcion, :idEstadoMovimiento, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idEstadoMovimiento' => ($oTabla->idEstadoMovimiento == 0)? Null: $oTabla->idEstadoMovimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC EstadosMovimientoHistoriaEliminar :idEstadoMovimiento, :idUsuarioAuditoria";

		$params = [
			'idEstadoMovimiento' => ($oTabla->idEstadoMovimiento == 0)? Null: $oTabla->idEstadoMovimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC EstadosMovimientoHistoriaSeleccionarPorId :idEstadoMovimiento";

		$params = [
			'idEstadoMovimiento' => $oTabla->idEstadoMovimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}