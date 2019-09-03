<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Enfermeria_TratamientoDosis extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC Enfermeria_TratamientoDosisAgregar :idCuentaAtencion, :idVisita, :idDiaVisita, :idReceta, :idItem, :dosis, :datoProrenata, :idUsuarioAuditoria";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idVisita' => ($oTabla->idVisita == 0)? Null: $oTabla->idVisita, 
			'idDiaVisita' => ($oTabla->idDiaVisita == 0)? Null: $oTabla->idDiaVisita, 
			'idReceta' => ($oTabla->idReceta == 0)? Null: $oTabla->idReceta, 
			'idItem' => ($oTabla->idItem == 0)? Null: $oTabla->idItem, 
			'dosis' => ($oTabla->dosis == 0)? Null: $oTabla->dosis, 
			'datoProrenata' => ($oTabla->datoProrenata == 0)? Null: $oTabla->datoProrenata, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC Enfermeria_TratamientoDosisModificar :idCuentaAtencion, :idVisita, :idDiaVisita, :idReceta, :idItem, :dosis, :datoProrenata, :idUsuarioAuditoria";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idVisita' => ($oTabla->idVisita == 0)? Null: $oTabla->idVisita, 
			'idDiaVisita' => ($oTabla->idDiaVisita == 0)? Null: $oTabla->idDiaVisita, 
			'idReceta' => ($oTabla->idReceta == 0)? Null: $oTabla->idReceta, 
			'idItem' => ($oTabla->idItem == 0)? Null: $oTabla->idItem, 
			'dosis' => ($oTabla->dosis == 0)? Null: $oTabla->dosis, 
			'datoProrenata' => ($oTabla->datoProrenata == 0)? Null: $oTabla->datoProrenata, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC Enfermeria_TratamientoDosisEliminar :idCuentaAtencion, :idUsuarioAuditoria";

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
			EXEC Enfermeria_TratamientoDosisSeleccionarPorId :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $oTabla->idCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}