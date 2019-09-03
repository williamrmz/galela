<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class InterconsultaDiagnosticos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idInterconsultaDiag AS Int = :idInterconsultaDiag
			SET NOCOUNT ON 
			EXEC InterconsultaDiagnosticosAgregar :idInterconsulta, :idDiagnostico, @idInterconsultaDiag OUTPUT, :idUsuarioAuditoria
			SELECT @idInterconsultaDiag AS idInterconsultaDiag";

		$params = [
			'idInterconsulta' => ($oTabla->idInterconsulta == 0)? Null: $oTabla->idInterconsulta, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idInterconsultaDiag' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC InterconsultaDiagnosticosModificar :idInterconsulta, :idDiagnostico, :idInterconsultaDiag, :idUsuarioAuditoria";

		$params = [
			'idInterconsulta' => ($oTabla->idInterconsulta == 0)? Null: $oTabla->idInterconsulta, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idInterconsultaDiag' => ($oTabla->idInterconsultaDiag == 0)? Null: $oTabla->idInterconsultaDiag, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC InterconsultaDiagnosticosEliminar :idInterconsultaDiag, :idUsuarioAuditoria";

		$params = [
			'idInterconsultaDiag' => ($oTabla->idInterconsultaDiag == 0)? Null: $oTabla->idInterconsultaDiag, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC InterconsultaDiagnosticosSeleccionarPorId :idInterconsultaDiag";

		$params = [
			'idInterconsultaDiag' => $oTabla->idInterconsultaDiag, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}