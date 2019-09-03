<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class SisFuaAtencionDIA extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @id AS Int = :id
			SET NOCOUNT ON 
			EXEC SisFuaAtencionDIAAgregar @id OUTPUT, :idCuentaAtencion, :dxNumero, :dxTipoIE, :dxCodigo, :dxTipoDPR, :cabDniUsuarioRegistra, :cabFechaFuaPrimeraVez, :cabEstado, :cabNroEnvioAlSIS, :cabCodigoPuntoDigitacion, :cabCodigoUDR, :fuaDisa, :fuaLote, :fuaNumero, :cabOrigenDelRegistro, :cabVersionAplicativo, :cabIdentificacionPaquete, :idUsuarioAuditoria
			SELECT @id AS id";

		$params = [
			'id' => 0, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'dxNumero' => ($oTabla->dxNumero == 0)? Null: $oTabla->dxNumero, 
			'dxTipoIE' => ($oTabla->dxTipoIE == "")? Null: $oTabla->dxTipoIE, 
			'dxCodigo' => ($oTabla->dxCodigo == "")? Null: $oTabla->dxCodigo, 
			'dxTipoDPR' => ($oTabla->dxTipoDPR == "")? Null: $oTabla->dxTipoDPR, 
			'cabDniUsuarioRegistra' => ($oTabla->cabDniUsuarioRegistra == "")? Null: Left($oTabla->cabDniUsuarioRegistra, 
			'cabFechaFuaPrimeraVez' => ($oTabla->cabFechaFuaPrimeraVez == "")? Null: $oTabla->cabFechaFuaPrimeraVez, 
			'cabEstado' => ($oTabla->cabEstado == "")? Null: $oTabla->cabEstado, 
			'cabNroEnvioAlSIS' => ($oTabla->cabNroEnvioAlSIS == "")? Null: $oTabla->cabNroEnvioAlSIS, 
			'cabCodigoPuntoDigitacion' => ($oTabla->cabCodigoPuntoDigitacion == 0)? Null: $oTabla->cabCodigoPuntoDigitacion, 
			'cabCodigoUDR' => ($oTabla->cabCodigoUDR == "")? Null: $oTabla->cabCodigoUDR, 
			'fuaDisa' => ($oTabla->fuaDisa == "")? Null: $oTabla->fuaDisa, 
			'fuaLote' => ($oTabla->fuaLote == "")? Null: $oTabla->fuaLote, 
			'fuaNumero' => ($oTabla->fuaNumero == "")? Null: $oTabla->fuaNumero, 
			'cabOrigenDelRegistro' => ($oTabla->cabOrigenDelRegistro == "")? Null: $oTabla->cabOrigenDelRegistro, 
			'cabVersionAplicativo' => ($oTabla->cabVersionAplicativo == "")? Null: $oTabla->cabVersionAplicativo, 
			'cabIdentificacionPaquete' => $oTabla->cabIdentificacionPaquete, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC SisFuaAtencionDIAModificar :id, :idCuentaAtencion, :dxNumero, :dxTipoIE, :dxCodigo, :dxTipoDPR, :cabDniUsuarioRegistra, :cabFechaFuaPrimeraVez, :cabEstado, :cabNroEnvioAlSIS, :cabCodigoPuntoDigitacion, :cabCodigoUDR, :fuaDisa, :fuaLote, :fuaNumero, :cabOrigenDelRegistro, :cabVersionAplicativo, :cabIdentificacionPaquete, :idUsuarioAuditoria";

		$params = [
			'id' => ($oTabla->id == 0)? Null: $oTabla->id, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'dxNumero' => ($oTabla->dxNumero == 0)? Null: $oTabla->dxNumero, 
			'dxTipoIE' => ($oTabla->dxTipoIE == "")? Null: $oTabla->dxTipoIE, 
			'dxCodigo' => ($oTabla->dxCodigo == "")? Null: $oTabla->dxCodigo, 
			'dxTipoDPR' => ($oTabla->dxTipoDPR == "")? Null: $oTabla->dxTipoDPR, 
			'cabDniUsuarioRegistra' => ($oTabla->cabDniUsuarioRegistra == "")? Null: Left($oTabla->cabDniUsuarioRegistra, 
			'cabFechaFuaPrimeraVez' => ($oTabla->cabFechaFuaPrimeraVez == "")? Null: $oTabla->cabFechaFuaPrimeraVez, 
			'cabEstado' => ($oTabla->cabEstado == "")? Null: $oTabla->cabEstado, 
			'cabNroEnvioAlSIS' => ($oTabla->cabNroEnvioAlSIS == "")? Null: $oTabla->cabNroEnvioAlSIS, 
			'cabCodigoPuntoDigitacion' => ($oTabla->cabCodigoPuntoDigitacion == 0)? Null: $oTabla->cabCodigoPuntoDigitacion, 
			'cabCodigoUDR' => ($oTabla->cabCodigoUDR == "")? Null: $oTabla->cabCodigoUDR, 
			'fuaDisa' => ($oTabla->fuaDisa == "")? Null: $oTabla->fuaDisa, 
			'fuaLote' => ($oTabla->fuaLote == "")? Null: $oTabla->fuaLote, 
			'fuaNumero' => ($oTabla->fuaNumero == "")? Null: $oTabla->fuaNumero, 
			'cabOrigenDelRegistro' => ($oTabla->cabOrigenDelRegistro == "")? Null: $oTabla->cabOrigenDelRegistro, 
			'cabVersionAplicativo' => ($oTabla->cabVersionAplicativo == "")? Null: $oTabla->cabVersionAplicativo, 
			'cabIdentificacionPaquete' => $oTabla->cabIdentificacionPaquete, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC SisFuaAtencionDIAEliminar :id, :idUsuarioAuditoria";

		$params = [
			'id' => $oTabla->id, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC SisFuaAtencionDIASeleccionarPorId :id";

		$params = [
			'id' => $oTabla->id, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SisFuaAtencionDIAeliminarPorCuenta($lnIdCuentaAtencion)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SisFuaAtencionDIAanularPorCuenta($lnIdCuentaAtencion)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}