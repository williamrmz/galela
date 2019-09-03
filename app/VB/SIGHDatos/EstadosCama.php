<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class EstadosCama extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idEstadoCama AS Int = :idEstadoCama
			SET NOCOUNT ON 
			EXEC EstadosCamaAgregar :descripcion, @idEstadoCama OUTPUT, :idUsuarioAuditoria
			SELECT @idEstadoCama AS idEstadoCama";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idEstadoCama' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC EstadosCamaModificar :descripcion, :idEstadoCama, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idEstadoCama' => ($oTabla->idEstadoCama == 0)? Null: $oTabla->idEstadoCama, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC EstadosCamaEliminar :idEstadoCama, :idUsuarioAuditoria";

		$params = [
			'idEstadoCama' => ($oTabla->idEstadoCama == 0)? Null: $oTabla->idEstadoCama, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC EstadosCamaSeleccionarPorId :idEstadoCama";

		$params = [
			'idEstadoCama' => $oTabla->idEstadoCama, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC EstadosCamaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}