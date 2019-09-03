<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Provincias extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC ProvinciasAgregar :idProvincia, :nombre, :idDepartamento";

		$params = [
			'idProvincia' => $oTabla->idProvincia, 
			'nombre' => $oTabla->nombre, 
			'idDepartamento' => $oTabla->idDepartamento, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC ProvinciasModificar :idDepartamento, :nombre, :idProvincia, :idUsuarioAuditoria";

		$params = [
			'idDepartamento' => $oTabla->idDepartamento, 
			'nombre' => $oTabla->nombre, 
			'idProvincia' => $oTabla->idProvincia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC ProvinciasEliminar :idProvincia, :idUsuarioAuditoria";

		$params = [
			'idProvincia' => $oTabla->idProvincia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC ProvinciasSeleccionarPorId :idProvincia";

		$params = [
			'idProvincia' => $oTabla->idProvincia, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorDepartamento($idDepartamento)
	{
		$query = "
			EXEC ProvinciasSeleccionarPorDepartamento :idDepartamento";

		$params = [
			'idDepartamento' => IdDepartamento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}