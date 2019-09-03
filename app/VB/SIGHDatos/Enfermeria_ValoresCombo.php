<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Enfermeria_ValoresCombo extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC Enfermeria_ValoresComboAgregar :idCuentaAtencion, :idVisita, :idVariable, :idValorCombo, :idUsuarioAuditoria";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idVisita' => ($oTabla->idVisita == 0)? Null: $oTabla->idVisita, 
			'idVariable' => ($oTabla->idVariable == 0)? Null: $oTabla->idVariable, 
			'idValorCombo' => ($oTabla->idValorCombo == 0)? Null: $oTabla->idValorCombo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC Enfermeria_ValoresComboModificar :idCuentaAtencion, :idVisita, :idVariable, :idValorCombo, :idUsuarioAuditoria";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idVisita' => ($oTabla->idVisita == 0)? Null: $oTabla->idVisita, 
			'idVariable' => ($oTabla->idVariable == 0)? Null: $oTabla->idVariable, 
			'idValorCombo' => ($oTabla->idValorCombo == 0)? Null: $oTabla->idValorCombo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($lnIdCuentaAtencion, $lnIdVisita)
	{
		$query = "
			EXEC Enfermeria_ValoresComboEliminar :idCuentaAtencion, :idVisita, :idUsuarioAuditoria";

		$params = [
			'idCuentaAtencion' => $lnIdCuentaAtencion, 
			'idVisita' => $lnIdVisita, 
			'idUsuarioAuditoria' => 1, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC Enfermeria_ValoresComboSeleccionarPorId :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $oTabla->idCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}