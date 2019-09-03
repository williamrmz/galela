<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class PerinatalAtencionDx extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionDiagnosticosAgregar :idPerinatalAtencion, :idModulo, :idLista, :idDiagnostico, :codigoHIS, :idAtencion, :labConfHIS, :idSubclasificacionDx, :idClasificacionDx, :idUsuarioAuditoria";

		$params = [
			'idPerinatalAtencion' => ($oTabla->idPerinatalAtencion == 0)? Null: $oTabla->idPerinatalAtencion, 
			'idModulo' => ($oTabla->idModulo == 0)? Null: $oTabla->idModulo, 
			'idLista' => ($oTabla->idLista == 0)? Null: $oTabla->idLista, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'codigoHIS' => ($oTabla->codigoHIS == "")? Null: $oTabla->codigoHIS, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'labConfHIS' => ($oTabla->labConfHIS == "")? Null: $oTabla->labConfHIS, 
			'idSubclasificacionDx' => ($oTabla->idSubClasificacionDX == 0)? Null: $oTabla->idSubClasificacionDX, 
			'idClasificacionDx' => ($oTabla->idClasificacionDx == 0)? Null: $oTabla->idClasificacionDx, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionDiagnosticosModificar :idPerinatalAtencion, :idModulo, :idLista, :idDiagnostico, :codigoHIS, :idAtencion, :labConfHIS, :idSubclasificacionDx, :idClasificacionDx, :idUsuarioAuditoria";

		$params = [
			'idPerinatalAtencion' => ($oTabla->idPerinatalAtencion == 0)? Null: $oTabla->idPerinatalAtencion, 
			'idModulo' => ($oTabla->idModulo == 0)? Null: $oTabla->idModulo, 
			'idLista' => ($oTabla->idLista == 0)? Null: $oTabla->idLista, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'codigoHIS' => ($oTabla->codigoHIS == "")? Null: $oTabla->codigoHIS, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'labConfHIS' => ($oTabla->labConfHIS == "")? Null: $oTabla->labConfHIS, 
			'idSubclasificacionDx' => ($oTabla->idSubClasificacionDX == 0)? Null: $oTabla->idSubClasificacionDX, 
			'idClasificacionDx' => ($oTabla->idClasificacionDx == 0)? Null: $oTabla->idClasificacionDx, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionDiagnosticosEliminar :idPerinatalAtencion, :idUsuarioAuditoria";

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
			EXEC PerinatalAtencionDiagnosticosSeleccionarPorId :idPerinatalAtencion";

		$params = [
			'idPerinatalAtencion' => $oTabla->idPerinatalAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function PerinatalAtencionDxSeleccionarPorIdPerinatalAtencion($mo_idPerinatalAtencion)
	{
		$query = "
			EXEC PerinatalAtencionDxSeleccionarPorIdPerinatalAtencion :mo_idPerinatalAtencion";

		$params = [
			'mo_idPerinatalAtencion' => $mo_idPerinatalAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarXatencion($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionDiagnosticosEliminarXidAtencion :idAtencion, :idUsuarioAuditoria";

		$params = [
			'idAtencion' => $oTabla->idAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}