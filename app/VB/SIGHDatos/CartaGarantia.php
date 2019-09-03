<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CartaGarantia extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idCartaGarantia AS Int = :idCartaGarantia
			SET NOCOUNT ON 
			EXEC CartaGarantiaAgregar :idCuentaAtencion, :fechaVigencia, :nroCarta, :observacion, :valorCobertura, @idCartaGarantia OUTPUT, :idUsuarioAuditoria
			SELECT @idCartaGarantia AS idCartaGarantia";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'fechaVigencia' => ($oTabla->fechaVigencia == 0)? Null: $oTabla->fechaVigencia, 
			'nroCarta' => ($oTabla->nroCarta == "")? Null: $oTabla->nroCarta, 
			'observacion' => ($oTabla->observacion == "")? Null: $oTabla->observacion, 
			'valorCobertura' => ($oTabla->valorCobertura == 0)? Null: $oTabla->valorCobertura, 
			'idCartaGarantia' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CartaGarantiaModificar :idCuentaAtencion, :fechaVigencia, :nroCarta, :observacion, :valorCobertura, :idCartaGarantia, :idUsuarioAuditoria";

		$params = [
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'fechaVigencia' => ($oTabla->fechaVigencia == 0)? Null: $oTabla->fechaVigencia, 
			'nroCarta' => ($oTabla->nroCarta == "")? Null: $oTabla->nroCarta, 
			'observacion' => ($oTabla->observacion == "")? Null: $oTabla->observacion, 
			'valorCobertura' => ($oTabla->valorCobertura == 0)? Null: $oTabla->valorCobertura, 
			'idCartaGarantia' => ($oTabla->idCartaGarantia == 0)? Null: $oTabla->idCartaGarantia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CartaGarantiaEliminar :idCartaGarantia, :idUsuarioAuditoria";

		$params = [
			'idCartaGarantia' => ($oTabla->idCartaGarantia == 0)? Null: $oTabla->idCartaGarantia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CartaGarantiaSeleccionarPorId :idCartaGarantia";

		$params = [
			'idCartaGarantia' => $oTabla->idCartaGarantia, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oTabla)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}