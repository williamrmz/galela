<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CajaGestion extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idGestionCaja AS Int = :idGestionCaja
			SET NOCOUNT ON 
			EXEC CajaGestionAgregar :totalCobrado, :fechaCierre, :idTurno, :idCaja, :idCajero, :estadoLote, :fechaApertura, @idGestionCaja OUTPUT, :idUsuarioAuditoria
			SELECT @idGestionCaja AS idGestionCaja";

		$params = [
			'totalCobrado' => ($oTabla->totalCobrado == "")? Null: $oTabla->totalCobrado, 
			'fechaCierre' => ($oTabla->fechaCierre == 0)? Null: $oTabla->fechaCierre, 
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'idCaja' => ($oTabla->idCaja == 0)? Null: $oTabla->idCaja, 
			'idCajero' => ($oTabla->idCajero == 0)? Null: $oTabla->idCajero, 
			'estadoLote' => ($oTabla->estadoLote == "")? Null: $oTabla->estadoLote, 
			'fechaApertura' => ($oTabla->fechaApertura == 0)? Null: $oTabla->fechaApertura, 
			'idGestionCaja' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CajaGestionModificar :totalCobrado, :fechaCierre, :idTurno, :idCaja, :idCajero, :estadoLote, :fechaApertura, :idGestionCaja, :idUsuarioAuditoria";

		$params = [
			'totalCobrado' => ($oTabla->totalCobrado == "")? Null: $oTabla->totalCobrado, 
			'fechaCierre' => ($oTabla->fechaCierre == 0)? Null: $oTabla->fechaCierre, 
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'idCaja' => ($oTabla->idCaja == 0)? Null: $oTabla->idCaja, 
			'idCajero' => ($oTabla->idCajero == 0)? Null: $oTabla->idCajero, 
			'estadoLote' => ($oTabla->estadoLote == "")? Null: $oTabla->estadoLote, 
			'fechaApertura' => ($oTabla->fechaApertura == 0)? Null: $oTabla->fechaApertura, 
			'idGestionCaja' => ($oTabla->idGestionCaja == 0)? Null: $oTabla->idGestionCaja, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CajaGestionEliminar :idGestionCaja, :idUsuarioAuditoria";

		$params = [
			'idGestionCaja' => ($oTabla->idGestionCaja == 0)? Null: $oTabla->idGestionCaja, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CajaGestionSeleccionarPorId :idGestionCaja";

		$params = [
			'idGestionCaja' => $oTabla->idGestionCaja, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarCajaGestion($oDOCajaGestion, $oDOCajaComprobantesPago, $oDOPaciente, $lcFechaComprobante)
	{
		$query = "
			EXEC CajaGestionFiltrar :lcFiltro1, :lcFiltro2";

		$params = [
			'lcFiltro1' => sSQL1, 
			'lcFiltro2' => sSQL2, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function CajaGestionPorCajeroCajaYTurno($idCaja, $idCajero, $idTurno)
	{
		$query = "
			EXEC CajaGestionPorCajeroCajaYTurno :idCajero, :idCaja, :idTurno";

		$params = [
			'idCajero' => IdCajero, 
			'idCaja' => IdCaja, 
			'idTurno' => IdTurno, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function TotalPorGestion($idGestionCaja)
	{
		$query = "
			EXEC CajaComprobantesPagoTotalPorGestion :idGestionCaja";

		$params = [
			'idGestionCaja' => IdGestionCaja, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}