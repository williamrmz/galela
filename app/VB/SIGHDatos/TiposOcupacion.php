<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposOcupacion extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC TiposOcupacionAgregar :descripcion, :idTipoOcupacion, :idUsuarioAuditoria";

		$params = [
			'descripcion' => $oTabla->descripcion, 
			'idTipoOcupacion' => $oTabla->idTipoOcupacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposOcupacionModificar :descripcion, :idTipoOcupacion, :idUsuarioAuditoria";

		$params = [
			'descripcion' => $oTabla->descripcion, 
			'idTipoOcupacion' => $oTabla->idTipoOcupacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposOcupacionEliminar :idTipoOcupacion, :idUsuarioAuditoria";

		$params = [
			'idTipoOcupacion' => $oTabla->idTipoOcupacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposOcupacionSeleccionarPorId :idTipoOcupacion";

		$params = [
			'idTipoOcupacion' => $oTabla->idTipoOcupacion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposOcupacionSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Todos()
	{
		$query = "
			EXEC TiposOcupacionTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}