<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Distritos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC DistritoAgregar :idDistrito, :nombre, :idProvincia";

		$params = [
			'idDistrito' => $oTabla->idDistrito, 
			'nombre' => $oTabla->nombre, 
			'idProvincia' => $oTabla->idProvincia, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC DistritosModificar :idProvincia, :nombre, :idDistrito, :idUsuarioAuditoria";

		$params = [
			'idProvincia' => $oTabla->idProvincia, 
			'nombre' => $oTabla->nombre, 
			'idDistrito' => $oTabla->idDistrito, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC DistritosEliminar :idDistrito, :idUsuarioAuditoria";

		$params = [
			'idDistrito' => $oTabla->idDistrito, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC DistritosSeleccionarPorId :idDistrito";

		$params = [
			'idDistrito' => $oTabla->idDistrito, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorProvincia($idProvincia)
	{
		$query = "
			EXEC DistritosSeleccionarPorProvincia :idProvincia";

		$params = [
			'idProvincia' => IdProvincia, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorProvinciaYDescripcion($idProvincia, $descripcion)
	{
		$query = "
			EXEC DistritosSeleccionarPorProvinciaYDescripcion :lcFiltro, :idProvincia";

		$params = [
			'lcFiltro' => sSql, 
			'idProvincia' => IdProvincia, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorDepartamentoYDescripcion($lnIdDepartamento, $descripcion)
	{
		$query = "
			EXEC DistritosSeleccionarPorDepartamentoYDescripcion :lcFiltro, :idDepartamento";

		$params = [
			'lcFiltro' => sSql, 
			'idDepartamento' => $lnIdDepartamento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}