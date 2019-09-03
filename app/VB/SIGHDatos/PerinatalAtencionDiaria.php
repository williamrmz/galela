<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class PerinatalAtencionDiaria extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionDiariaAgregar :idPerinatalAtencion, :idAtencion, :idUsuarioAuditoria";

		$params = [
			'idPerinatalAtencion' => ($oTabla->idPerinatalAtencion == 0)? Null: $oTabla->idPerinatalAtencion, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionDiariaModificar :idPerinatalAtencion, :idAtencion, :idUsuarioAuditoria";

		$params = [
			'idPerinatalAtencion' => ($oTabla->idPerinatalAtencion == 0)? Null: $oTabla->idPerinatalAtencion, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionDiariaEliminar :idPerinatalAtencion, :idUsuarioAuditoria";

		$params = [
			'idPerinatalAtencion' => $oTabla->idPerinatalAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionDiariaSeleccionarPorId :idPerinatalAtencion";

		$params = [
			'idPerinatalAtencion' => $oTabla->idPerinatalAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarXidAtencion($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionDiariaEliminarXidAtencion :idAtencion, :idUsuarioAuditoria";

		$params = [
			'idAtencion' => $oTabla->idAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}