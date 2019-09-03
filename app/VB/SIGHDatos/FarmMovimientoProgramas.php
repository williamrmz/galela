<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FarmMovimientoProgramas extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC farmMovimientoProgramasAgregar :movNumero, :movTipo, :idCoordinador, :idPrescriptor, :idDiagnostico, :idPaciente, :idComponente, :idSubComponente, :fechaHoraPrescribe, :idUsuarioAuditoria";

		$params = [
			'movNumero' => ($oTabla->movNumero == "")? Null: $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'idCoordinador' => ($oTabla->idCoordinador == 0)? Null: $oTabla->idCoordinador, 
			'idPrescriptor' => ($oTabla->idPrescriptor == "")? Null: $oTabla->idPrescriptor, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idComponente' => ($oTabla->idComponente == 0)? Null: $oTabla->idComponente, 
			'idSubComponente' => ($oTabla->idSubComponente == 0)? Null: $oTabla->idSubComponente, 
			'fechaHoraPrescribe' => ($oTabla->fechaHoraPrescribe == 0)? Null: $oTabla->fechaHoraPrescribe, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC farmMovimientoProgramasModificar :movNumero, :movTipo, :idCoordinador, :idPrescriptor, :idDiagnostico, :idPaciente, :idComponente, :idSubComponente, :fechaHoraPrescribe, :idUsuarioAuditoria";

		$params = [
			'movNumero' => ($oTabla->movNumero == "")? Null: $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'idCoordinador' => ($oTabla->idCoordinador == 0)? Null: $oTabla->idCoordinador, 
			'idPrescriptor' => ($oTabla->idPrescriptor == "")? Null: $oTabla->idPrescriptor, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idComponente' => ($oTabla->idComponente == 0)? Null: $oTabla->idComponente, 
			'idSubComponente' => ($oTabla->idSubComponente == 0)? Null: $oTabla->idSubComponente, 
			'fechaHoraPrescribe' => ($oTabla->fechaHoraPrescribe == 0)? Null: $oTabla->fechaHoraPrescribe, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC farmMovimientoProgramasEliminar :movNumero, :movTipo, :idUsuarioAuditoria";

		$params = [
			'movNumero' => $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC farmMovimientoProgramasSeleccionarPorId :movNumero, :movTipo";

		$params = [
			'movNumero' => $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}