<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CamasMovimientos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idMovimiento AS Int = :idMovimiento
			SET NOCOUNT ON 
			EXEC CamasMovimientosAgregar @idMovimiento OUTPUT, :idCama, :idServicio, :fechaIngreso, :fechaSalida, :idUsuarioAuditoria
			SELECT @idMovimiento AS idMovimiento";

		$params = [
			'idMovimiento' => 0, 
			'idCama' => $oTabla->idCama, 
			'idServicio' => $oTabla->idServicio, 
			'fechaIngreso' => $oTabla->idFechaIngreso, 
			'fechaSalida' => ($oTabla->idFechaSalida == 0)? Null: $oTabla->idFechaSalida, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function EliminarPorCama($oTabla)
	{
		$query = "
			EXEC CamasMovimientosEliminarPorCama :idCama, :idUsuarioAuditoria";

		$params = [
			'idCama' => ($oTabla->idCama == 0)? Null: $oTabla->idCama, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorCama($lnIdCama)
	{
		$query = "
			EXEC CamasMovimientosSeleccionarPorCama :idCama";

		$params = [
			'idCama' => $lnIdCama, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}