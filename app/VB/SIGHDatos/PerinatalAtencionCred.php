<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class PerinatalAtencionCred extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionCredAgregar :idPerinatalAtencion, :edadEnAnios, :credNumero, :credCheck, :idAtencion, :idUsuarioAuditoria";

		$params = [
			'idPerinatalAtencion' => ($oTabla->idPerinatalAtencion == 0)? Null: $oTabla->idPerinatalAtencion, 
			'edadEnAnios' => ($oTabla->edadEnAnios == "")? Null: $oTabla->edadEnAnios, 
			'credNumero' => ($oTabla->credNumero == 0)? Null: $oTabla->credNumero, 
			'credCheck' => ($oTabla->credCheck == "")? Null: $oTabla->credCheck, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionCredModificar :idPerinatalAtencion, :edadEnAnios, :credNumero, :credCheck, :idAtencion, :idUsuarioAuditoria";

		$params = [
			'idPerinatalAtencion' => ($oTabla->idPerinatalAtencion == 0)? Null: $oTabla->idPerinatalAtencion, 
			'edadEnAnios' => ($oTabla->edadEnAnios == "")? Null: $oTabla->edadEnAnios, 
			'credNumero' => ($oTabla->credNumero == 0)? Null: $oTabla->credNumero, 
			'credCheck' => ($oTabla->credCheck == "")? Null: $oTabla->credCheck, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionCredEliminar :idPerinatalAtencion, :idUsuarioAuditoria";

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
			EXEC PerinatalAtencionCredSeleccionarPorId :idPerinatalAtencion";

		$params = [
			'idPerinatalAtencion' => $oTabla->idPerinatalAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function PerinatalAtencionCredSeleccionarPorIdPaciente($ml_idPaciente)
	{
		$query = "
			EXEC PerinatalAtencionCredSeleccionarPorIdPaciente :ml_idPaciente";

		$params = [
			'ml_idPaciente' => $ml_idPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarXatencion($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionCredEliminarXidAtencion :idAtencion, :idUsuarioAuditoria";

		$params = [
			'idAtencion' => $oTabla->idAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}