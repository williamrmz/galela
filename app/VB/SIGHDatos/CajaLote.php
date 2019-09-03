<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CajaLote extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idLote AS Int = :idLote
			SET NOCOUNT ON 
			EXEC CajaLoteAgregar :idCajero, :saldoInicialDolares, :saldoInicialSoles, :estadoLote, :fecha, @idLote OUTPUT, :idCaja, :idTurno, :idUsuarioAuditoria
			SELECT @idLote AS idLote";

		$params = [
			'idCajero' => ($oTabla->idCajero == 0)? Null: $oTabla->idCajero, 
			'saldoInicialDolares' => ($oTabla->saldoInicialDolares == 0)? Null: $oTabla->saldoInicialDolares, 
			'saldoInicialSoles' => ($oTabla->saldoInicialSoles == 0)? Null: $oTabla->saldoInicialSoles, 
			'estadoLote' => ($oTabla->estadoLote == "")? Null: $oTabla->estadoLote, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'idLote' => 0, 
			'idCaja' => ($oTabla->idCaja == 0)? Null: $oTabla->idCaja, 
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CajaLoteModificar :idCajero, :saldoInicialDolares, :saldoInicialSoles, :estadoLote, :fecha, :idLote, :idCaja, :idTurno, :idUsuarioAuditoria";

		$params = [
			'idCajero' => ($oTabla->idCajero == 0)? Null: $oTabla->idCajero, 
			'saldoInicialDolares' => ($oTabla->saldoInicialDolares == 0)? Null: $oTabla->saldoInicialDolares, 
			'saldoInicialSoles' => ($oTabla->saldoInicialSoles == 0)? Null: $oTabla->saldoInicialSoles, 
			'estadoLote' => ($oTabla->estadoLote == "")? Null: $oTabla->estadoLote, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'idLote' => ($oTabla->idLote == 0)? Null: $oTabla->idLote, 
			'idCaja' => ($oTabla->idCaja == 0)? Null: $oTabla->idCaja, 
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CajaLoteEliminar :idLote, :idUsuarioAuditoria";

		$params = [
			'idLote' => ($oTabla->idLote == 0)? Null: $oTabla->idLote, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC Select * from CajaLote where IdLote =  :idLote";

		$params = [
			'idLote' => $oTabla->idLote, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorFechaCajero($oTabla)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RealizarFiltro($oLote)
	{
		$query = "
			EXEC CommandText = SQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPendientesParaLista($idLoteDefault)
	{
		$query = "
			EXEC CommandText = SQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ExisteAsignacionCaja($oTabla)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerMontoCalculado($idLote)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}