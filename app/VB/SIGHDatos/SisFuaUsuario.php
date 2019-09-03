<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class SisFuaUsuario extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idUsuario AS Int = :idUsuario
			SET NOCOUNT ON 
			EXEC SisFuaUsuarioAgregar @idUsuario OUTPUT, :dNI, :tipoDoc, :apellidoPat, :apellidoMat, :primerNombre, :segundoNombre, :nroEnvio, :periodo, :mes, :codigoEstablecimiento, :idUsuarioAuditoria
			SELECT @idUsuario AS idUsuario";

		$params = [
			'idUsuario' => 0, 
			'dNI' => ($oTabla->dNI == "")? Null: Trim($oTabla->dNI), 
			'tipoDoc' => ($oTabla->tipoDoc == "")? Null: $oTabla->tipoDoc, 
			'apellidoPat' => ($oTabla->apellidoPat == "")? Null: $oTabla->apellidoPat, 
			'apellidoMat' => ($oTabla->apellidoMat == "")? Null: $oTabla->apellidoMat, 
			'primerNombre' => ($oTabla->primerNombre == "")? Null: $oTabla->primerNombre, 
			'segundoNombre' => ($oTabla->segundoNombre == "")? Null: $oTabla->segundoNombre, 
			'nroEnvio' => ($oTabla->nroEnvio == 0)? Null: $oTabla->nroEnvio, 
			'periodo' => ($oTabla->periodo == "")? Null: $oTabla->periodo, 
			'mes' => ($oTabla->mes == "")? Null: $oTabla->mes, 
			'codigoEstablecimiento' => ($oTabla->codigoEstablecimiento == "")? Null: $oTabla->codigoEstablecimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC SisFuaUsuarioModificar :idUsuario, :dNI, :tipoDoc, :apellidoPat, :apellidoMat, :primerNombre, :segundoNombre, :nroEnvio, :periodo, :mes, :codigoEstablecimiento, :idUsuarioAuditoria";

		$params = [
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'dNI' => ($oTabla->dNI == "")? Null: $oTabla->dNI, 
			'tipoDoc' => ($oTabla->tipoDoc == "")? Null: $oTabla->tipoDoc, 
			'apellidoPat' => ($oTabla->apellidoPat == "")? Null: $oTabla->apellidoPat, 
			'apellidoMat' => ($oTabla->apellidoMat == "")? Null: $oTabla->apellidoMat, 
			'primerNombre' => ($oTabla->primerNombre == "")? Null: $oTabla->primerNombre, 
			'segundoNombre' => ($oTabla->segundoNombre == "")? Null: $oTabla->segundoNombre, 
			'nroEnvio' => ($oTabla->nroEnvio == 0)? Null: $oTabla->nroEnvio, 
			'periodo' => ($oTabla->periodo == "")? Null: $oTabla->periodo, 
			'mes' => ($oTabla->mes == "")? Null: $oTabla->mes, 
			'codigoEstablecimiento' => ($oTabla->codigoEstablecimiento == "")? Null: $oTabla->codigoEstablecimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC SisFuaUsuarioEliminar :idUsuario, :idUsuarioAuditoria";

		$params = [
			'idUsuario' => $oTabla->idUsuario, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC SisFuaUsuarioSeleccionarPorId :idUsuario";

		$params = [
			'idUsuario' => $oTabla->idUsuario, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorDNI($oDni)
	{
		$query = "
			EXEC SisFuaUsuarioSeleccionarPorDNI :dNI";

		$params = [
			'dNI' => Trim($oDni), 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}