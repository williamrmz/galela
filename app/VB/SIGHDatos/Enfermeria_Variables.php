<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Enfermeria_Variables extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC Enfermeria_VariablesAgregar :idCuentaAtencion, :idVisita, :idVariable, :variableDato, :idUsuarioAuditoria";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idVisita' => ($oTabla->idVisita == 0)? Null: $oTabla->idVisita, 
			'idVariable' => ($oTabla->idVariable == 0)? Null: $oTabla->idVariable, 
			'variableDato' => ($oTabla->variableDato == "")? Null: $oTabla->variableDato, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC Enfermeria_VariablesModificar :idCuentaAtencion, :idVisita, :idVariable, :variableDato, :idUsuarioAuditoria";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idVisita' => ($oTabla->idVisita == 0)? Null: $oTabla->idVisita, 
			'idVariable' => ($oTabla->idVariable == 0)? Null: $oTabla->idVariable, 
			'variableDato' => ($oTabla->variableDato == "")? Null: $oTabla->variableDato, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC Enfermeria_VariablesEliminar :idCuentaAtencion, :idUsuarioAuditoria";

		$params = [
			'idCuentaAtencion' => $oTabla->idCuentaAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC Enfermeria_VariablesSeleccionarPorId :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $oTabla->idCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}