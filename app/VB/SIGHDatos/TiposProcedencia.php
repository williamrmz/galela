<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposProcedencia extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC TiposProcedenciaAgregar :descripcion, :idProcedencia, :idUsuarioAuditoria";

		$params = [
			'descripcion' => $oTabla->descripcion, 
			'idProcedencia' => $oTabla->idProcedencia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposProcedenciaModificar :descripcion, :idProcedencia, :idUsuarioAuditoria";

		$params = [
			'descripcion' => $oTabla->descripcion, 
			'idProcedencia' => $oTabla->idProcedencia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposProcedenciaEliminar :idProcedencia, :idUsuarioAuditoria";

		$params = [
			'idProcedencia' => $oTabla->idProcedencia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposProcedenciaSeleccionarPorId :idProcedencia";

		$params = [
			'idProcedencia' => $oTabla->idProcedencia, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposProcedenciaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Todos()
	{
		$query = "
			EXEC TiposProcedenciaTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}