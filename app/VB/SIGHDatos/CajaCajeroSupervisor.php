<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CajaCajeroSupervisor extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idCajeroSupervisor AS Int = :idCajeroSupervisor
			SET NOCOUNT ON 
			EXEC CajaCajeroSupervisorAgregar :idSupervisor, :idTurno, :idCajero, @idCajeroSupervisor OUTPUT, :idUsuarioAuditoria
			SELECT @idCajeroSupervisor AS idCajeroSupervisor";

		$params = [
			'idSupervisor' => ($oTabla->idSupervisor == 0)? Null: $oTabla->idSupervisor, 
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'idCajero' => ($oTabla->idCajero == 0)? Null: $oTabla->idCajero, 
			'idCajeroSupervisor' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CajaCajeroSupervisorModificar :idSupervisor, :idTurno, :idCajero, :idCajeroSupervisor, :idUsuarioAuditoria";

		$params = [
			'idSupervisor' => ($oTabla->idSupervisor == 0)? Null: $oTabla->idSupervisor, 
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'idCajero' => ($oTabla->idCajero == 0)? Null: $oTabla->idCajero, 
			'idCajeroSupervisor' => ($oTabla->idCajeroSupervisor == 0)? Null: $oTabla->idCajeroSupervisor, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CajaCajeroSupervisorEliminar :idCajeroSupervisor, :idUsuarioAuditoria";

		$params = [
			'idCajeroSupervisor' => ($oTabla->idCajeroSupervisor == 0)? Null: $oTabla->idCajeroSupervisor, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CajaCajeroSupervisorSeleccionarPorId :idCajeroSupervisor";

		$params = [
			'idCajeroSupervisor' => $oTabla->idCajeroSupervisor, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdCajero($lIdCajero)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarPorCajero($lIdCajero)
	{
		$query = "
			EXEC Delete from CajaCajeroSupervisor where IdCajero =  ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}