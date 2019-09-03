<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class LabMotivoSalidas extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC LabMotivoSalidasAgregar :idMotivoSalida, :motivo, :idUsuarioAuditoria";

		$params = [
			'idMotivoSalida' => ($oTabla->idMotivoSalida == 0)? Null: $oTabla->idMotivoSalida, 
			'motivo' => ($oTabla->motivo == "")? Null: $oTabla->motivo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC LabMotivoSalidasModificar :idMotivoSalida, :motivo, :idUsuarioAuditoria";

		$params = [
			'idMotivoSalida' => ($oTabla->idMotivoSalida == 0)? Null: $oTabla->idMotivoSalida, 
			'motivo' => ($oTabla->motivo == "")? Null: $oTabla->motivo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC LabMotivoSalidasEliminar :idMotivoSalida, :idUsuarioAuditoria";

		$params = [
			'idMotivoSalida' => $oTabla->idMotivoSalida, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC LabMotivoSalidasSeleccionarPorId :idMotivoSalida";

		$params = [
			'idMotivoSalida' => $oTabla->idMotivoSalida, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}