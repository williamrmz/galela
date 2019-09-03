<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class EstablecimientosNoMinsa extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idEstablecimientoNoMinsa AS Int = :idEstablecimientoNoMinsa
			SET NOCOUNT ON 
			EXEC EstablecimientosNoMinsaAgregar @idEstablecimientoNoMinsa OUTPUT, :nombre, :idTipoSubsector, :idDistrito, :codigo, :idUsuarioAuditoria
			SELECT @idEstablecimientoNoMinsa AS idEstablecimientoNoMinsa";

		$params = [
			'idEstablecimientoNoMinsa' => 0, 
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'idTipoSubsector' => ($oTabla->idTipoSubsector == 0)? Null: $oTabla->idTipoSubsector, 
			'idDistrito' => ($oTabla->idDistrito == 0)? Null: $oTabla->idDistrito, 
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
			EXEC EstablecimientosNoMinsaModificar :idEstablecimientoNoMinsa, :nombre, :idTipoSubsector, :idDistrito, :codigo, :idUsuarioAuditoria";

		$params = [
			'idEstablecimientoNoMinsa' => ($oTabla->idEstablecimientoNoMinsa == 0)? Null: $oTabla->idEstablecimientoNoMinsa, 
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'idTipoSubsector' => ($oTabla->idTipoSubsector == 0)? Null: $oTabla->idTipoSubsector, 
			'idDistrito' => ($oTabla->idDistrito == 0)? Null: $oTabla->idDistrito, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC EstablecimientosNoMinsaEliminar :idEstablecimientoNoMinsa, :idUsuarioAuditoria";

		$params = [
			'idEstablecimientoNoMinsa' => ($oTabla->idEstablecimientoNoMinsa == 0)? Null: $oTabla->idEstablecimientoNoMinsa, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC EstablecimientosNoMinsaSeleccionarPorId :idEstablecimientoNoMinsa";

		$params = [
			'idEstablecimientoNoMinsa' => $oTabla->idEstablecimientoNoMinsa, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC EstablecimientosNoMinsaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oTabla, $lDepartamento, $lProvincia)
	{
		$query = "
			EXEC EstablecimientosNoMinsaFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}