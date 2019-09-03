<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class SisFuaAtencionSMI extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @id AS Int = :id
			SET NOCOUNT ON 
			EXEC SisFuaAtencionSMIAgregar @id OUTPUT, :idCuentaAtencion, :intervencionesPreventivas, :valor, :cabDniUsuarioRegistra, :cabFechaFuaPrimeraVez, :cabEstado, :cabNroEnvioAlSIS, :cabCodigoPuntoDigitacion, :cabCodigoUDR, :fuaDisa, :fuaLote, :fuaNumero, :cabOrigenDelRegistro, :cabVersionAplicativo, :cabIdentificacionPaquete, :idUsuarioAuditoria
			SELECT @id AS id";

		$params = [
			'id' => 0, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'intervencionesPreventivas' => ($oTabla->intervencionesPreventivas == "")? Null: $oTabla->intervencionesPreventivas, 
			'valor' => ($oTabla->valor == "")? Null: $oTabla->valor, 
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
			EXEC SisFuaAtencionSMIModificar :id, :idCuentaAtencion, :intervencionesPreventivas, :valor, :cabDniUsuarioRegistra, :cabFechaFuaPrimeraVez, :cabEstado, :cabNroEnvioAlSIS, :cabCodigoPuntoDigitacion, :cabCodigoUDR, :fuaDisa, :fuaLote, :fuaNumero, :cabOrigenDelRegistro, :cabVersionAplicativo, :cabIdentificacionPaquete, :idUsuarioAuditoria";

		$params = [
			'id' => ($oTabla->id == 0)? Null: $oTabla->id, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'intervencionesPreventivas' => ($oTabla->intervencionesPreventivas == "")? Null: $oTabla->intervencionesPreventivas, 
			'valor' => ($oTabla->valor == "")? Null: $oTabla->valor, 
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
			EXEC SisFuaAtencionSMIEliminar :id, :idUsuarioAuditoria";

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
			EXEC SisFuaAtencionSMISeleccionarPorId :id";

		$params = [
			'id' => $oTabla->id, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SisFuaAtencionSMIeliminarPorCuenta($lnIdCuentaAtencion)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SisFuaAtencionSMIanularPorCuenta($lnIdCuentaAtencion)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}