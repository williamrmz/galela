<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class LabRecojeExamen extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC LabRecojeExamenAgregar :idRecojeExamen, :recojeExamen, :idUsuarioAuditoria";

		$params = [
			'idRecojeExamen' => ($oTabla->idRecojeExamen == 0)? Null: $oTabla->idRecojeExamen, 
			'recojeExamen' => ($oTabla->recojeExamen == "")? Null: $oTabla->recojeExamen, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC LabRecojeExamenModificar :idRecojeExamen, :recojeExamen, :idUsuarioAuditoria";

		$params = [
			'idRecojeExamen' => ($oTabla->idRecojeExamen == 0)? Null: $oTabla->idRecojeExamen, 
			'recojeExamen' => ($oTabla->recojeExamen == "")? Null: $oTabla->recojeExamen, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC LabRecojeExamenEliminar :idRecojeExamen, :idUsuarioAuditoria";

		$params = [
			'idRecojeExamen' => $oTabla->idRecojeExamen, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC LabRecojeExamenSeleccionarPorId :idRecojeExamen";

		$params = [
			'idRecojeExamen' => $oTabla->idRecojeExamen, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}