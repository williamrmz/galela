<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CentrosCosto extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idCentroCosto AS Int = :idCentroCosto
			SET NOCOUNT ON 
			EXEC CentrosCostoAgregar :codigo, @idCentroCosto OUTPUT, :descripcion, :idUsuarioAuditoria
			SELECT @idCentroCosto AS idCentroCosto";

		$params = [
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idCentroCosto' => 0, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CentrosCostoModificar :codigo, :idCentroCosto, :descripcion, :idUsuarioAuditoria";

		$params = [
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idCentroCosto' => ($oTabla->idCentroCosto == 0)? Null: $oTabla->idCentroCosto, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CentrosCostoEliminar :idCentroCosto, :idUsuarioAuditoria";

		$params = [
			'idCentroCosto' => ($oTabla->idCentroCosto == 0)? Null: $oTabla->idCentroCosto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CentrosCostoSeleccionarPorId :idCentroCosto";

		$params = [
			'idCentroCosto' => $oTabla->idCentroCosto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC CentrosCostoSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oTabla)
	{
		$query = "
			EXEC CentrosCostoFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}