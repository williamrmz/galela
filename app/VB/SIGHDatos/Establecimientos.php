<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Establecimientos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC EstablecimientosAgregar :idEstablecimiento, :codigo, :nombre, :idDistrito, :idTipo, :idUsuarioAuditoria";

		$params = [
			'idEstablecimiento' => $oTabla->idEstablecimiento, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'idDistrito' => ($oTabla->idDistrito == 0)? Null: $oTabla->idDistrito, 
			'idTipo' => ($oTabla->idTipo == 0)? Null: $oTabla->idTipo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			DECLARE @idEstablecimiento AS Int = :idEstablecimiento
			SET NOCOUNT ON 
			EXEC EstablecimientosModificar @idEstablecimiento OUTPUT, :codigo, :nombre, :idDistrito, :idTipo, :idUsuarioAuditoria
			SELECT @idEstablecimiento AS idEstablecimiento";

		$params = [
			'idEstablecimiento' => 0, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'idDistrito' => ($oTabla->idDistrito == 0)? Null: $oTabla->idDistrito, 
			'idTipo' => ($oTabla->idTipo == 0)? Null: $oTabla->idTipo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC EstablecimientosEliminar :idEstablecimiento, :idUsuarioAuditoria";

		$params = [
			'idEstablecimiento' => ($oTabla->idEstablecimiento == 0)? Null: $oTabla->idEstablecimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC EstablecimientosSeleccionarPorId :idEstablecimiento";

		$params = [
			'idEstablecimiento' => $oTabla->idEstablecimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oTabla)
	{
		$query = "
			EXEC EstablecimientosFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCodigo($oDoEstablecimiento)
	{
		$query = "
			EXEC EstablecimientosXcodigo :codi";

		$params = [
			'codi' => 0, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDatosEstablecimientoPorIdUsuario($idUsuario)
	{
		$query = "
			EXEC EstablecimientosPorIdUsuario :idUsuario";

		$params = [
			'idUsuario' => IdUsuario, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDatosEstablecimientoPorId($oTabla)
	{
		$query = "
			EXEC EstablecimientosXid :idEstablecimiento";

		$params = [
			'idEstablecimiento' => $oTabla->idEstablecimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC EstablecimientosSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}