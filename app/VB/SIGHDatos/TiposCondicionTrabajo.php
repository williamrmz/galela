<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposCondicionTrabajo extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC TiposCondicionTrabajoAgregar :idCondicionTrabajo, :descripcion, :idUsuarioAuditoria";

		$params = [
			'idCondicionTrabajo' => $oTabla->idCondicionTrabajo, 
			'descripcion' => $oTabla->descripcion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposCondicionTrabajoModificar :idCondicionTrabajo, :descripcion, :idUsuarioAuditoria";

		$params = [
			'idCondicionTrabajo' => $oTabla->idCondicionTrabajo, 
			'descripcion' => $oTabla->descripcion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposCondicionTrabajoEliminar :idCondicionTrabajo, :idUsuarioAuditoria";

		$params = [
			'idCondicionTrabajo' => $oTabla->idCondicionTrabajo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposCondicionTrabajoSeleccionarPorId :idCondicionTrabajo";

		$params = [
			'idCondicionTrabajo' => $oTabla->idCondicionTrabajo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposCondicionTrabajoSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}