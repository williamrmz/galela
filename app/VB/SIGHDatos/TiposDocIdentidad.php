<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposDocIdentidad extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC TiposDocIdentidadAgregar :descripcion, :idDocIdentidad, :idUsuarioAuditoria";

		$params = [
			'descripcion' => $oTabla->descripcion, 
			'idDocIdentidad' => $oTabla->idDocIdentidad, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposDocIdentidadModificar :descripcion, :idDocIdentidad, :idUsuarioAuditoria";

		$params = [
			'descripcion' => $oTabla->descripcion, 
			'idDocIdentidad' => $oTabla->idDocIdentidad, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposDocIdentidadEliminar :idDocIdentidad, :idUsuarioAuditoria";

		$params = [
			'idDocIdentidad' => $oTabla->idDocIdentidad, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposDocIdentidadSeleccionarPorId :idDocIdentidad";

		$params = [
			'idDocIdentidad' => $oTabla->idDocIdentidad, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposDocIdentidadSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodosIncSinTipoDoc()
	{
		$query = "
			EXEC TiposDocIdentidadSeleccionarTodosIncSinTipoDoc ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodosTiposDocRN()
	{
		$query = "
			EXEC TiposDocIdentidadSeleccionarTipoDocRN ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}