<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposGradoInstruccion extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC TiposGradoInstruccionAgregar :descripcion, :idGradoInstruccion, :idUsuarioAuditoria";

		$params = [
			'descripcion' => $oTabla->descripcion, 
			'idGradoInstruccion' => $oTabla->idGradoInstruccion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposGradoInstruccionModificar :descripcion, :idGradoInstruccion, :idUsuarioAuditoria";

		$params = [
			'descripcion' => $oTabla->descripcion, 
			'idGradoInstruccion' => $oTabla->idGradoInstruccion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposGradoInstruccionEliminar :idGradoInstruccion, :idUsuarioAuditoria";

		$params = [
			'idGradoInstruccion' => $oTabla->idGradoInstruccion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposGradoInstruccionSeleccionarPorId :idGradoInstruccion";

		$params = [
			'idGradoInstruccion' => $oTabla->idGradoInstruccion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposGradoInstruccionSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Todos()
	{
		$query = "
			EXEC TiposGradoInstruccionTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}