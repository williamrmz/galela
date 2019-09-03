<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxChequeoEnfermeriaPOCab extends Model
{
	public function Insertar($oTabla, $detChequeo)
	{
		$query = "
			DECLARE @idChequeoEnfermeriaPreOperatoriaCab AS Int = :idChequeoEnfermeriaPreOperatoriaCab
			SET NOCOUNT ON 
			EXEC CQxChequeoEnfermeriaPreOperatoriaCabAgregar @idChequeoEnfermeriaPreOperatoriaCab OUTPUT, :idChequeoEnfermeriaPreOperatoria, :idProgramacion, :idOOpMQ, :peso, :talla, :iCM, :idUsuario, :estacion, :sI, :nO, :nO_APLICA, :observacion
			SELECT @idChequeoEnfermeriaPreOperatoriaCab AS idChequeoEnfermeriaPreOperatoriaCab";

		$params = [
			'idChequeoEnfermeriaPreOperatoriaCab' => 0, 
			'idChequeoEnfermeriaPreOperatoria' => ($detChequeo->idChequeoEnfermeriaPreOperatoria == 0)? Null: $detChequeo->idChequeoEnfermeriaPreOperatoria, 
			'idProgramacion' => ($oTabla->idProgramacion == 0)? Null: $oTabla->idProgramacion, 
			'idOOpMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
			'peso' => $oTabla->peso, 
			'talla' => $oTabla->talla, 
			'iCM' => $oTabla->iCM, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'sI' => ($detChequeo->si == 0)? Null: $detChequeo->si, 
			'nO' => ($detChequeo->nO == 0)? Null: $detChequeo->nO, 
			'nO_APLICA' => ($detChequeo->nO_APLICA == 0)? Null: $detChequeo->nO_APLICA, 
			'observacion' => ($detChequeo->observacion == "")? Null: $detChequeo->observacion, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CQxChequeoEnfermeriaPreOperatoriaCabModificar :idChequeoEnfermeriaPreOperatoriaCab, :idOrdenOperatoriaMQ, :fecha, :hora, :peso, :talla, :iCM, :nroChequeoEnfermeriaPreOperatoria, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idChequeoEnfermeriaPreOperatoriaCab' => ($oTabla->idChequeoEnfermeriaPreOperatoriaCab == 0)? Null: $oTabla->idChequeoEnfermeriaPreOperatoriaCab, 
			'idOrdenOperatoriaMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'hora' => ($oTabla->hora == "")? Null: $oTabla->hora, 
			'peso' => $oTabla->peso, 
			'talla' => $oTabla->talla, 
			'iCM' => $oTabla->iCM, 
			'nroChequeoEnfermeriaPreOperatoria' => $oTabla->nroChequeoEnfermeriaPreOperatoria, 
			'estadoReg' => ($oTabla->estadoReg == 0)? Null: $oTabla->estadoReg, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxChequeoEnfermeriaPreOperatoriaCabSeleccionarPorId :idChequeoEnfermeriaPreOperatoriaCab";

		$params = [
			'idChequeoEnfermeriaPreOperatoriaCab' => $oTabla->idChequeoEnfermeriaPreOperatoriaCab, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function BuscarChequeoEnfermeria($aDOCheq)
	{
		$query = "
			EXEC pa_CQxObtenerChequeoEnfermeriaPreOperatoria :idOrdenOperatoriaMQ, :idProgramacion";

		$params = [
			'idOrdenOperatoriaMQ' => $aDOCheq->idOrdenOperatoriaMQ, 
			'idProgramacion' => $aDOCheq->idProgramacion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function UsuarioRegCheqEnfermeria($id)
	{
		$query = "
			EXEC pa_UsuarioRegCheqEnfermeria :idProgramacion";

		$params = [
			'idProgramacion' => Id, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}