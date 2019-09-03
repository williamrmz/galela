<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class InterconsultasDiagnosticos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idInterconsultaDiagnostico AS Int = :idInterconsultaDiagnostico
			SET NOCOUNT ON 
			EXEC InterconsultasDiagnosticosAgregar @idInterconsultaDiagnostico OUTPUT, :idSubclasificacionDx, :idClasificacionDx, :idDiagnostico, :idInterconsulta, :idUsuarioAuditoria
			SELECT @idInterconsultaDiagnostico AS idInterconsultaDiagnostico";

		$params = [
			'idInterconsultaDiagnostico' => 0, 
			'idSubclasificacionDx' => ($oTabla->idSubclasificacionDx == 0)? Null: $oTabla->idSubclasificacionDx, 
			'idClasificacionDx' => ($oTabla->idClasificacionDx == 0)? Null: $oTabla->idClasificacionDx, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idInterconsulta' => ($oTabla->idInterconsulta == 0)? Null: $oTabla->idInterconsulta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC InterconsultasDiagnosticosModificar :idInterconsultaDiagnostico, :idSubclasificacionDx, :idClasificacionDx, :idDiagnostico, :idInterconsulta, :idUsuarioAuditoria";

		$params = [
			'idInterconsultaDiagnostico' => ($oTabla->idInterconsultaDiagnostico == 0)? Null: $oTabla->idInterconsultaDiagnostico, 
			'idSubclasificacionDx' => ($oTabla->idSubclasificacionDx == 0)? Null: $oTabla->idSubclasificacionDx, 
			'idClasificacionDx' => ($oTabla->idClasificacionDx == 0)? Null: $oTabla->idClasificacionDx, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idInterconsulta' => ($oTabla->idInterconsulta == 0)? Null: $oTabla->idInterconsulta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC InterconsultasDiagnosticosEliminar :idInterconsultaDiagnostico, :idUsuarioAuditoria";

		$params = [
			'idInterconsultaDiagnostico' => ($oTabla->idInterconsultaDiagnostico == 0)? Null: $oTabla->idInterconsultaDiagnostico, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC InterconsultasDiagnosticosSeleccionarPorId :idInterconsultaDiagnostico";

		$params = [
			'idInterconsultaDiagnostico' => $oTabla->idInterconsultaDiagnostico, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}