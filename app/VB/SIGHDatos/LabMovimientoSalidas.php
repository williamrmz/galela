<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class LabMovimientoSalidas extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC LabMovimientoSalidasAgregar :idMovimiento, :idResponsable, :idMotivoSalida, :idUsuarioAuditoria";

		$params = [
			'idMovimiento' => ($oTabla->idMovimiento == 0)? Null: $oTabla->idMovimiento, 
			'idResponsable' => ($oTabla->idResponsable == 0)? Null: $oTabla->idResponsable, 
			'idMotivoSalida' => ($oTabla->idMotivoSalida == 0)? Null: $oTabla->idMotivoSalida, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC LabMovimientoSalidasModificar :idMovimiento, :idResponsable, :idMotivoSalida, :idUsuarioAuditoria";

		$params = [
			'idMovimiento' => ($oTabla->idMovimiento == 0)? Null: $oTabla->idMovimiento, 
			'idResponsable' => ($oTabla->idResponsable == 0)? Null: $oTabla->idResponsable, 
			'idMotivoSalida' => ($oTabla->idMotivoSalida == 0)? Null: $oTabla->idMotivoSalida, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC LabMovimientoSalidasEliminar :idMovimiento, :idUsuarioAuditoria";

		$params = [
			'idMovimiento' => $oTabla->idMovimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC LabMovimientoSalidasSeleccionarPorId :idMovimiento";

		$params = [
			'idMovimiento' => $oTabla->idMovimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}