<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CentroPoblados extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC CentrosPobladosAgregar :idDistrito, :nombre, :idCentroPoblado, :idUsuarioAuditoria";

		$params = [
			'idDistrito' => $oTabla->idDistrito, 
			'nombre' => $oTabla->nombre, 
			'idCentroPoblado' => $oTabla->idCentroPoblado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CentrosPobladosModificar :idDistrito, :nombre, :idCentroPoblado, :idUsuarioAuditoria";

		$params = [
			'idDistrito' => $oTabla->idDistrito, 
			'nombre' => $oTabla->nombre, 
			'idCentroPoblado' => $oTabla->idCentroPoblado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CentrosPobladosEliminar :idCentroPoblado, :idUsuarioAuditoria";

		$params = [
			'idCentroPoblado' => $oTabla->idCentroPoblado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CentrosPobladosSeleccionarPorId :idCentroPoblado";

		$params = [
			'idCentroPoblado' => $oTabla->idCentroPoblado, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorDistrito($idDistrito)
	{
		$query = "
			EXEC CentrosPobladosSeleccionarPorDistrito :idDistrito";

		$params = [
			'idDistrito' => $idDistrito, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC CentrosPobladosSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}