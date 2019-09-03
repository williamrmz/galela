<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxChequeoEnfermeriaPODet extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idChequeoEnfermeriaPreOperatoriaDet AS Int = :idChequeoEnfermeriaPreOperatoriaDet
			SET NOCOUNT ON 
			EXEC CQxChequeoEnfermeriaPreOperatoriaDetAgregar @idChequeoEnfermeriaPreOperatoriaDet OUTPUT, :idChequeoEnfermeriaPreOperatoria, :idChequeoEnfermeriaPreOperatoriaCab, :sI, :nO, :nO_APLICA, :observacion, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idChequeoEnfermeriaPreOperatoriaDet AS idChequeoEnfermeriaPreOperatoriaDet";

		$params = [
			'idChequeoEnfermeriaPreOperatoriaDet' => 0, 
			'idChequeoEnfermeriaPreOperatoria' => ($oTabla->idChequeoEnfermeriaPreOperatoria == 0)? Null: $oTabla->idChequeoEnfermeriaPreOperatoria, 
			'idChequeoEnfermeriaPreOperatoriaCab' => ($oTabla->idChequeoEnfermeriaPreOperatoriaCab == 0)? Null: $oTabla->idChequeoEnfermeriaPreOperatoriaCab, 
			'sI' => ($oTabla->sI == 0)? Null: $oTabla->sI, 
			'nO' => ($oTabla->nO == 0)? Null: $oTabla->nO, 
			'nO_APLICA' => ($oTabla->nO_APLICA == 0)? Null: $oTabla->nO_APLICA, 
			'observacion' => ($oTabla->observacion == "")? Null: $oTabla->observacion, 
			'estadoReg' => ($oTabla->estadoReg == 0)? Null: $oTabla->estadoReg, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CQxChequeoEnfermeriaPreOperatoriaDetModificar :idChequeoEnfermeriaPreOperatoriaDet, :idChequeoEnfermeriaPreOperatoria, :idChequeoEnfermeriaPreOperatoriaCab, :sI, :nO, :nO_APLICA, :observacion, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idChequeoEnfermeriaPreOperatoriaDet' => ($oTabla->idChequeoEnfermeriaPreOperatoriaDet == 0)? Null: $oTabla->idChequeoEnfermeriaPreOperatoriaDet, 
			'idChequeoEnfermeriaPreOperatoria' => ($oTabla->idChequeoEnfermeriaPreOperatoria == 0)? Null: $oTabla->idChequeoEnfermeriaPreOperatoria, 
			'idChequeoEnfermeriaPreOperatoriaCab' => ($oTabla->idChequeoEnfermeriaPreOperatoriaCab == 0)? Null: $oTabla->idChequeoEnfermeriaPreOperatoriaCab, 
			'sI' => ($oTabla->sI == 0)? Null: $oTabla->sI, 
			'nO' => ($oTabla->nO == 0)? Null: $oTabla->nO, 
			'nO_APLICA' => ($oTabla->nO_APLICA == 0)? Null: $oTabla->nO_APLICA, 
			'observacion' => ($oTabla->observacion == "")? Null: $oTabla->observacion, 
			'estadoReg' => ($oTabla->estadoReg == 0)? Null: $oTabla->estadoReg, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CQxChequeoEnfermeriaPreOperatoriaDetEliminar :idChequeoEnfermeriaPreOperatoriaDet, :idUsuarioAuditoria";

		$params = [
			'idChequeoEnfermeriaPreOperatoriaDet' => $oTabla->idChequeoEnfermeriaPreOperatoriaDet, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxChequeoEnfermeriaPreOperatoriaDetSeleccionarPorId :idChequeoEnfermeriaPreOperatoriaDet";

		$params = [
			'idChequeoEnfermeriaPreOperatoriaDet' => $oTabla->idChequeoEnfermeriaPreOperatoriaDet, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}