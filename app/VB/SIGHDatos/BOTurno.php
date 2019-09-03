<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class BOTurno extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idTurno AS Int = :idTurno
			SET NOCOUNT ON 
			EXEC TurnosAgregar :codigo, :idTipoServicio, :horaFin, :horaInicio, :descripcion, @idTurno OUTPUT, :idUsuarioAuditoria
			SELECT @idTurno AS idTurno";

		$params = [
			'codigo' => $oTabla->codigo, 
			'idTipoServicio' => $oTabla->idTipoServicio, 
			'horaFin' => $oTabla->horaFin, 
			'horaInicio' => $oTabla->horaInicio, 
			'descripcion' => $oTabla->descripcion, 
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
			EXEC TurnosModificar :codigo, :idTipoServicio, :horaFin, :horaInicio, :descripcion, :idTurno, :idUsuarioAuditoria";

		$params = [
			'codigo' => $oTabla->codigo, 
			'idTipoServicio' => $oTabla->idTipoServicio, 
			'horaFin' => $oTabla->horaFin, 
			'horaInicio' => $oTabla->horaInicio, 
			'descripcion' => $oTabla->descripcion, 
			'idTurno' => $oTabla->idTurno, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TurnosEliminar :idTurno, :idUsuarioAuditoria";

		$params = [
			'idTurno' => $oTabla->idTurno, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorPrimaryKey($oTabla)
	{
		$query = "
			EXEC TurnosSeleccionarPorPrimaryKey :idTurno";

		$params = [
			'idTurno' => $oTabla->idTurno, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}