<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Departamentos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC DepartamentosAgregar :nombre, :idDepartamento, :idUsuarioAuditoria";

		$params = [
			'nombre' => $oTabla->nombre, 
			'idDepartamento' => $oTabla->idDepartamento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC DepartamentosModificar :nombre, :idDepartamento, :idUsuarioAuditoria";

		$params = [
			'nombre' => $oTabla->nombre, 
			'idDepartamento' => $oTabla->idDepartamento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC DepartamentosEliminar :idDepartamento, :idUsuarioAuditoria";

		$params = [
			'idDepartamento' => $oTabla->idDepartamento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC DepartamentosSeleccionarPorId :idDepartamento";

		$params = [
			'idDepartamento' => $oTabla->idDepartamento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC DepartamentosSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}