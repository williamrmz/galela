<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CajaTurno extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idTurno AS Int = :idTurno
			SET NOCOUNT ON 
			EXEC CajaTurnoAgregar :descripcion, @idTurno OUTPUT, :idUsuarioAuditoria
			SELECT @idTurno AS idTurno";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTurno' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CajaTurnoModificar :descripcion, :idTurno, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTurno' => ($oTabla->idTurno == "")? Null: $oTabla->idTurno, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CajaTurnoEliminar :idTurno, :idUsuarioAuditoria";

		$params = [
			'idTurno' => ($oTabla->idTurno == "")? Null: $oTabla->idTurno, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CajaTurnoSeleccionarPorId :idTurno";

		$params = [
			'idTurno' => $oTabla->idTurno, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodosParaLista()
	{
		$query = "
			EXEC CajaTurnoSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}