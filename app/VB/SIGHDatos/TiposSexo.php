<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposSexo extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC TiposSexoAgregar :descripcion, :idTipoSexo, :idUsuarioAuditoria";

		$params = [
			'descripcion' => $oTabla->descripcion, 
			'idTipoSexo' => $oTabla->idTipoSexo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposSexoModificar :descripcion, :idTipoSexo, :idUsuarioAuditoria";

		$params = [
			'descripcion' => $oTabla->descripcion, 
			'idTipoSexo' => $oTabla->idTipoSexo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposSexoEliminar :idTipoSexo, :idUsuarioAuditoria";

		$params = [
			'idTipoSexo' => $oTabla->idTipoSexo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposSexoSeleccionarPorId :idTipoSexo";

		$params = [
			'idTipoSexo' => $oTabla->idTipoSexo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposSexoSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}