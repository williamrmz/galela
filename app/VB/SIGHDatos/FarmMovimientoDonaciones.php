<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FarmMovimientoDonaciones extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC FarmMovimientoDonacionesAgregar :movNumero, :movTipo, :idCuentaAtencion, :idPrescriptorReceta, :idCoordinadorServicioSocial, :idDiagnostico, :idUsuarioAuditoria";

		$params = [
			'movNumero' => ($oTabla->movNumero == "")? Null: $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idPrescriptorReceta' => ($oTabla->idPrescriptorReceta == 0)? Null: $oTabla->idPrescriptorReceta, 
			'idCoordinadorServicioSocial' => ($oTabla->idCoordinadorServicioSocial == 0)? Null: $oTabla->idCoordinadorServicioSocial, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FarmMovimientoDonacionesModificar :movNumero, :movTipo, :idCuentaAtencion, :idPrescriptorReceta, :idCoordinadorServicioSocial, :idDiagnostico, :idUsuarioAuditoria";

		$params = [
			'movNumero' => ($oTabla->movNumero == "")? Null: $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idPrescriptorReceta' => ($oTabla->idPrescriptorReceta == 0)? Null: $oTabla->idPrescriptorReceta, 
			'idCoordinadorServicioSocial' => ($oTabla->idCoordinadorServicioSocial == 0)? Null: $oTabla->idCoordinadorServicioSocial, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FarmMovimientoDonacionesEliminar :movNumero, :movTipo, :idUsuarioAuditoria";

		$params = [
			'movNumero' => $oTabla->movNumero, 
			'movTipo' => $oTabla->movTipo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FarmMovimientoDonacionesSeleccionarPorId :movNumero, :movTipo";

		$params = [
			'movNumero' => $oTabla->movNumero, 
			'movTipo' => $oTabla->movTipo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}