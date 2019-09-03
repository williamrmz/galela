<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class EstadosAtencion extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idEstadoAtencion AS Int = :idEstadoAtencion
			SET NOCOUNT ON 
			EXEC EstadosAtencionAgregar :descripcion, @idEstadoAtencion OUTPUT, :idUsuarioAuditoria
			SELECT @idEstadoAtencion AS idEstadoAtencion";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idEstadoAtencion' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC EstadosAtencionModificar :descripcion, :idEstadoAtencion, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idEstadoAtencion' => ($oTabla->idEstadoAtencion == 0)? Null: $oTabla->idEstadoAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC EstadosAtencionEliminar :idEstadoAtencion, :idUsuarioAuditoria";

		$params = [
			'idEstadoAtencion' => ($oTabla->idEstadoAtencion == 0)? Null: $oTabla->idEstadoAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC EstadosAtencionSeleccionarPorId :idEstadoAtencion";

		$params = [
			'idEstadoAtencion' => $oTabla->idEstadoAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC EstadosAtencionSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}