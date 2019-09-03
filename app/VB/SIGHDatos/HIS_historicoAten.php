<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class HIS_historicoAten extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC his_historicoAtencionesAgregar :idPaciente, :fecha, :diagnost, :cpt, :ups, :idUsuarioAuditoria";

		$params = [
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'diagnost' => ($oTabla->diagnost == "")? Null: $oTabla->diagnost, 
			'cpt' => ($oTabla->cpt == "")? Null: $oTabla->cpt, 
			'ups' => ($oTabla->ups == "")? Null: $oTabla->ups, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC his_historicoAtencionesModificar :idPaciente, :fecha, :diagnost, :cpt, :ups, :idUsuarioAuditoria";

		$params = [
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'diagnost' => ($oTabla->diagnost == "")? Null: $oTabla->diagnost, 
			'cpt' => ($oTabla->cpt == "")? Null: $oTabla->cpt, 
			'ups' => ($oTabla->ups == "")? Null: $oTabla->ups, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC his_historicoAtencionesEliminar :idPaciente, :idUsuarioAuditoria";

		$params = [
			'idPaciente' => $oTabla->idPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC his_historicoAtencionesSeleccionarPorId :idPaciente";

		$params = [
			'idPaciente' => $oTabla->idPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}