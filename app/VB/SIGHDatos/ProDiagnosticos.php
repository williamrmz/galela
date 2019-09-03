<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ProDiagnosticos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC ProDiagnosticosAgregar :idPrograma, :idProCabecera, :idControl, :idDiagnostico, :principal, :labConfHIS, :idSubclasificacionDx, :idUsuarioAuditoria";

		$params = [
			'idPrograma' => ($oTabla->idPrograma == 0)? Null: $oTabla->idPrograma, 
			'idProCabecera' => ($oTabla->idProCabecera == 0)? Null: $oTabla->idProCabecera, 
			'idControl' => ($oTabla->idControl == 0)? Null: $oTabla->idControl, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'principal' => $oTabla->principal, 
			'labConfHIS' => ($oTabla->labConfHIS == "")? Null: $oTabla->labConfHIS, 
			'idSubclasificacionDx' => ($oTabla->idSubClasificacionDX == 0)? Null: $oTabla->idSubClasificacionDX, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC ProDiagnosticosModificar :idPrograma, :idProCabecera, :idControl, :idDiagnostico, :principal, :labConfHIS, :idSubclasificacionDx, :idUsuarioAuditoria";

		$params = [
			'idPrograma' => ($oTabla->idPrograma == 0)? Null: $oTabla->idPrograma, 
			'idProCabecera' => ($oTabla->idProCabecera == 0)? Null: $oTabla->idProCabecera, 
			'idControl' => ($oTabla->idControl == 0)? Null: $oTabla->idControl, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'principal' => ($oTabla->principal == 0)? Null: $oTabla->principal, 
			'labConfHIS' => ($oTabla->labConfHIS == "")? Null: $oTabla->labConfHIS, 
			'idSubclasificacionDx' => ($oTabla->idSubClasificacionDX == 0)? Null: $oTabla->idSubClasificacionDX, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC ProDiagnosticosEliminar :idPrograma, :idUsuarioAuditoria";

		$params = [
			'idPrograma' => $oTabla->idPrograma, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC ProDiagnosticosSeleccionarPorId :idPrograma";

		$params = [
			'idPrograma' => $oTabla->idPrograma, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}