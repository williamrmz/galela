<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class HIS_DatosEstablecimiento extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idDatoEstablec AS Int = :idDatoEstablec
			SET NOCOUNT ON 
			EXEC HIS_DatosEstablecimientoAgregar @idDatoEstablec OUTPUT, :idEstablecimiento, :color, :turnos, :ultimoNroFormatoHIS, :idUsuarioAuditoria
			SELECT @idDatoEstablec AS idDatoEstablec";

		$params = [
			'idDatoEstablec' => 0, 
			'idEstablecimiento' => ($oTabla->idEstablecimiento == 0)? Null: $oTabla->idEstablecimiento, 
			'color' => ($oTabla->color == "")? Null: $oTabla->color, 
			'turnos' => ($oTabla->turnos == 0)? Null: $oTabla->turnos, 
			'ultimoNroFormatoHIS' => ($oTabla->ultimoNroFormatoHIS == 0)? Null: $oTabla->ultimoNroFormatoHIS, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC HIS_DatosEstablecimientoModificar :idDatoEstablec, :idEstablecimiento, :color, :turnos, :ultimoNroFormatoHIS, :idUsuarioAuditoria";

		$params = [
			'idDatoEstablec' => ($oTabla->idDatoEstablec == 0)? Null: $oTabla->idDatoEstablec, 
			'idEstablecimiento' => ($oTabla->idEstablecimiento == 0)? Null: $oTabla->idEstablecimiento, 
			'color' => ($oTabla->color == "")? Null: $oTabla->color, 
			'turnos' => ($oTabla->turnos == 0)? Null: $oTabla->turnos, 
			'ultimoNroFormatoHIS' => ($oTabla->ultimoNroFormatoHIS == 0)? Null: $oTabla->ultimoNroFormatoHIS, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC HIS_DatosEstablecimientoEliminar :idDatoEstablec, :idUsuarioAuditoria";

		$params = [
			'idDatoEstablec' => $oTabla->idDatoEstablec, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC HIS_DatosEstablecimientoSeleccionarPorId :idDatoEstablec";

		$params = [
			'idDatoEstablec' => $oTabla->idDatoEstablec, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}