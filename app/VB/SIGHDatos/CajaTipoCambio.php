<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CajaTipoCambio extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC CajaTipoCambioAgregar :tipoCambio, :fecha, :idTipoMoneda, :idUsuarioAuditoria";

		$params = [
			'tipoCambio' => ($oTabla->tipoCambio == "")? Null: $oTabla->tipoCambio, 
			'fecha' => ($oTabla->fecha == "")? Null: $oTabla->fecha, 
			'idTipoMoneda' => ($oTabla->idTipoMoneda == "")? Null: $oTabla->idTipoMoneda, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CajaTipoCambioModificar :tipoCambio, :fecha, :idTipoMoneda, :idUsuarioAuditoria";

		$params = [
			'tipoCambio' => ($oTabla->tipoCambio == "")? Null: $oTabla->tipoCambio, 
			'fecha' => ($oTabla->fecha == "")? Null: $oTabla->fecha, 
			'idTipoMoneda' => ($oTabla->idTipoMoneda == "")? Null: $oTabla->idTipoMoneda, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CajaTipoCambioEliminar :idUsuarioAuditoria";

		$params = [
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CajaTipoCambioSeleccionarPorId ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerTipoCambioActualMoneda($oTipoMoneda)
	{
		$query = "
			EXEC Select top 1 isnull(tc.TipoCambio,0) as TipoCambio,tc.Fecha,tc.IdTipoMoneda  ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}