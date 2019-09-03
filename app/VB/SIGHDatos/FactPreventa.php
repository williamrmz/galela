<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FactPreventa extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idFactPreventa AS Int = :idFactPreventa
			SET NOCOUNT ON 
			EXEC FactPreventaAgregar @idFactPreventa OUTPUT, :idServicio, :idTipoFinanciamiento, :total, :fechaCreacion, :idUsuario, :idEstadoPreventa, :idAtencion, :idOrden, :idUsuarioAuditoria
			SELECT @idFactPreventa AS idFactPreventa";

		$params = [
			'idFactPreventa' => 0, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'idTipoFinanciamiento' => $oTabla->idTipoFinanciamiento, 
			'total' => $oTabla->total, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idEstadoPreventa' => ($oTabla->idEstadoPreventa == 0)? Null: $oTabla->idEstadoPreventa, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactPreventaModificar :idFactPreventa, :idServicio, :idTipoFinanciamiento, :total, :fechaCreacion, :idUsuario, :idEstadoPreventa, :idAtencion, :idOrden, :idUsuarioAuditoria";

		$params = [
			'idFactPreventa' => ($oTabla->idFactPreventa == 0)? Null: $oTabla->idFactPreventa, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'idTipoFinanciamiento' => $oTabla->idTipoFinanciamiento, 
			'total' => $oTabla->total, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idEstadoPreventa' => $oTabla->idEstadoPreventa, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idOrden' => ($oTabla->idOrden == 0)? Null: $oTabla->idOrden, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactPreventaEliminar :idFactPreventa, :idUsuarioAuditoria";

		$params = [
			'idFactPreventa' => $oTabla->idFactPreventa, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FactPreventaSeleccionarPorId :idFactPreventa";

		$params = [
			'idFactPreventa' => $oTabla->idFactPreventa, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdOrden($lnIdOrden, $oDoFactPreventa)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}