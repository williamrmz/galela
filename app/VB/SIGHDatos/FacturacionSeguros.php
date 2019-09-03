<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FacturacionSeguros extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idFacturacionSeguro AS Int = :idFacturacionSeguro
			SET NOCOUNT ON 
			EXEC FacturacionSegurosAgregar :nroPlaca, :codigoAutorizacion, :idTipoFinanciamiento, :idFuenteFinanciamiento, :idCuentaAtencion, @idFacturacionSeguro OUTPUT, :totalAsegurado, :idUsuarioAuditoria
			SELECT @idFacturacionSeguro AS idFacturacionSeguro";

		$params = [
			'nroPlaca' => ($oTabla->nroPlaca == "")? Null: $oTabla->nroPlaca, 
			'codigoAutorizacion' => ($oTabla->codigoAutorizacion == "")? Null: $oTabla->codigoAutorizacion, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idFacturacionSeguro' => 0, 
			'totalAsegurado' => ($oTabla->totalAsegurado == 0)? Null: $oTabla->totalAsegurado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FacturacionSegurosModificar :nroPlaca, :codigoAutorizacion, :idTipoFinanciamiento, :idFuenteFinanciamiento, :idCuentaAtencion, :idFacturacionSeguro, :totalAsegurado, :idUsuarioAuditoria";

		$params = [
			'nroPlaca' => ($oTabla->nroPlaca == "")? Null: $oTabla->nroPlaca, 
			'codigoAutorizacion' => ($oTabla->codigoAutorizacion == "")? Null: $oTabla->codigoAutorizacion, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idFacturacionSeguro' => ($oTabla->idFacturacionSeguro == 0)? Null: $oTabla->idFacturacionSeguro, 
			'totalAsegurado' => ($oTabla->totalAsegurado == 0)? Null: $oTabla->totalAsegurado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FacturacionSegurosEliminar :idFacturacionSeguro, :idUsuarioAuditoria";

		$params = [
			'idFacturacionSeguro' => ($oTabla->idFacturacionSeguro == 0)? Null: $oTabla->idFacturacionSeguro, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FacturacionSegurosSeleccionarPorId :idFacturacionSeguro";

		$params = [
			'idFacturacionSeguro' => $oTabla->idFacturacionSeguro, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCuentaAtencionParaEstadoCuenta($idCuentaAtencion)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}