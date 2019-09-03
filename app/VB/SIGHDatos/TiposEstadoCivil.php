<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposEstadoCivil extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC TiposEstadoCivilAgregar :descripcion, :idEstadoCivil, :idUsuarioAuditoria";

		$params = [
			'descripcion' => $oTabla->descripcion, 
			'idEstadoCivil' => $oTabla->idEstadoCivil, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposEstadoCivilModificar :descripcion, :idEstadoCivil, :idUsuarioAuditoria";

		$params = [
			'descripcion' => $oTabla->descripcion, 
			'idEstadoCivil' => $oTabla->idEstadoCivil, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposEstadoCivilEliminar :idEstadoCivil, :idUsuarioAuditoria";

		$params = [
			'idEstadoCivil' => $oTabla->idEstadoCivil, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposEstadoCivilSeleccionarPorId :idEstadoCivil";

		$params = [
			'idEstadoCivil' => $oTabla->idEstadoCivil, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposEstadoCivilSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Todos()
	{
		$query = "
			EXEC TiposEstadoCivilTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}