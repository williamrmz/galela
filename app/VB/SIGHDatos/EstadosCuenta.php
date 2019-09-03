<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class EstadosCuenta extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idEstado AS Int = :idEstado
			SET NOCOUNT ON 
			EXEC EstadosCuentaAgregar :descripcion, @idEstado OUTPUT, :idUsuarioAuditoria
			SELECT @idEstado AS idEstado";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idEstado' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC EstadosCuentaModificar :descripcion, :idEstado, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idEstado' => ($oTabla->idEstado == 0)? Null: $oTabla->idEstado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC EstadosCuentaEliminar :idEstado, :idUsuarioAuditoria";

		$params = [
			'idEstado' => ($oTabla->idEstado == 0)? Null: $oTabla->idEstado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC EstadosCuentaSeleccionarPorId :idEstado";

		$params = [
			'idEstado' => $oTabla->idEstado, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC EstadosCuentaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}