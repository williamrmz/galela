<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposAnestesia extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idAnestesia AS Int = :idAnestesia
			SET NOCOUNT ON 
			EXEC TiposAnestesiaAgregar @idAnestesia OUTPUT, :descripcion, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idAnestesia AS idAnestesia";

		$params = [
			'idAnestesia' => 0, 
			'descripcion' => $oTabla->descripcion, 
			'estadoReg' => ($oTabla->estadoReg == 0)? Null: $oTabla->estadoReg, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposAnestesiaModificar :idAnestesia, :descripcion, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idAnestesia' => ($oTabla->idAnestesia == 0)? Null: $oTabla->idAnestesia, 
			'descripcion' => $oTabla->descripcion, 
			'estadoReg' => ($oTabla->estadoReg == 0)? Null: $oTabla->estadoReg, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposAnestesiaEliminar :idAnestesia, :idUsuarioAuditoria";

		$params = [
			'idAnestesia' => $oTabla->idAnestesia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposAnestesiaSeleccionarPorId :idAnestesia";

		$params = [
			'idAnestesia' => $oTabla->idAnestesia, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}