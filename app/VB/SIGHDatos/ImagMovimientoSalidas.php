<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ImagMovimientoSalidas extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC ImagMovimientoSalidasAgregar :idMovimiento, :idResponsable, :idMotivoSalida, :idUsuarioAuditoria";

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
			EXEC ImagMovimientoSalidasModificar :idMovimiento, :idResponsable, :idMotivoSalida, :idUsuarioAuditoria";

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
			EXEC ImagMovimientoSalidasEliminar :idMovimiento, :idUsuarioAuditoria";

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
			EXEC ImagMovimientoSalidasSeleccionarPorId :idMovimiento";

		$params = [
			'idMovimiento' => $oTabla->idMovimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}