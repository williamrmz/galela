<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposEmpleado extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC TiposEmpleadoAgregar :idTipoEmpleado, :descripcion, :idUsuarioAuditoria";

		$params = [
			'idTipoEmpleado' => $oTabla->idTipoEmpleado, 
			'descripcion' => $oTabla->descripcion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposEmpleadoModificar :idTipoEmpleado, :descripcion, :idUsuarioAuditoria";

		$params = [
			'idTipoEmpleado' => $oTabla->idTipoEmpleado, 
			'descripcion' => $oTabla->descripcion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposEmpleadoEliminar :idTipoEmpleado, :idUsuarioAuditoria";

		$params = [
			'idTipoEmpleado' => $oTabla->idTipoEmpleado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposEmpleadoSeleccionarPorId :idTipoEmpleado";

		$params = [
			'idTipoEmpleado' => $oTabla->idTipoEmpleado, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposEmpleadoSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}