<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AreasHospital extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC AreasHospitalAgregar :nombre, :idArea, :idUsuarioAuditoria";

		$params = [
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'idArea' => ($oTabla->idArea == "")? Null: $oTabla->idArea, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AreasHospitalModificar :nombre, :idArea, :idUsuarioAuditoria";

		$params = [
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'idArea' => ($oTabla->idArea == "")? Null: $oTabla->idArea, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AreasHospitalEliminar :idArea, :idUsuarioAuditoria";

		$params = [
			'idArea' => ($oTabla->idArea == "")? Null: $oTabla->idArea, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AreasHospitalSeleccionarPorId :idArea";

		$params = [
			'idArea' => $oTabla->idArea, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}