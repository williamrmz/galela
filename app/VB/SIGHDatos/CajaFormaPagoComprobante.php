<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CajaFormaPagoComprobante extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idFormaPago AS Int = :idFormaPago
			SET NOCOUNT ON 
			EXEC CajaFormaPagoComprobanteAgregar :idTipoFormaPago, :idTipoMoneda, :idComprobantePago, :importe, :totalSoles, :tipoCambio, @idFormaPago OUTPUT, :idUsuarioAuditoria
			SELECT @idFormaPago AS idFormaPago";

		$params = [
			'idTipoFormaPago' => ($oTabla->idTipoFormaPago == 0)? Null: $oTabla->idTipoFormaPago, 
			'idTipoMoneda' => ($oTabla->idTipoMoneda == 0)? Null: $oTabla->idTipoMoneda, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'importe' => $oTabla->importe, 
			'totalSoles' => $oTabla->totalSoles, 
			'tipoCambio' => $oTabla->tipoCambio, 
			'idFormaPago' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CajaFormaPagoComprobanteModificar :tipoCambio, :totalSoles, :totalDolares, :idComprobantePago, :idTipoMoneda, :idTipoFormaPago, :idFormaPago, :idUsuarioAuditoria";

		$params = [
			'tipoCambio' => ($oTabla->tipoCambio == "")? Null: $oTabla->tipoCambio, 
			'totalSoles' => ($oTabla->totalSoles == "")? Null: $oTabla->totalSoles, 
			'totalDolares' => ($oTabla->importe == "")? Null: $oTabla->importe, 
			'idComprobantePago' => ($oTabla->idComprobantePago == "")? Null: $oTabla->idComprobantePago, 
			'idTipoMoneda' => ($oTabla->idTipoMoneda == "")? Null: $oTabla->idTipoMoneda, 
			'idTipoFormaPago' => ($oTabla->idTipoFormaPago == "")? Null: $oTabla->idTipoFormaPago, 
			'idFormaPago' => ($oTabla->idFormaPago == "")? Null: $oTabla->idFormaPago, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CommandText = SQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarPorComprobante($oTabla)
	{
		$query = "
			EXEC CommandText = SQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC Select * from CajaFormaPagoComprobante where id =  ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorComprobante($oCajaFormaPago)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}