<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CqxExamenFisicoDet extends Model
{
	public function InsertarExamen($oTabla)
	{
		$query = "
			DECLARE @idExamenFisicoDet AS Int = :idExamenFisicoDet
			SET NOCOUNT ON 
			EXEC CQxExamenFisicoDetAgregar @idExamenFisicoDet OUTPUT, :idExamenFisico, :valor, :idUsuario, :estacion
			SELECT @idExamenFisicoDet AS idExamenFisicoDet";

		$params = [
			'idExamenFisicoDet' => 0, 
			'idExamenFisico' => ($oTabla->idExamenFisico == 0)? Null: $oTabla->idExamenFisico, 
			'valor' => ($oTabla->valor == "")? Null: $oTabla->valor, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CQxExamenFisicoDetModificar :idExamenFisicoDet, :idEvaluacionPreAnestesicaCab, :idExamenFisico, :valor, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idExamenFisicoDet' => ($oTabla->idExamenFisicoDet == 0)? Null: $oTabla->idExamenFisicoDet, 
			'idEvaluacionPreAnestesicaCab' => ($oTabla->idEvaluacionPreAnestesicaCab == 0)? Null: $oTabla->idEvaluacionPreAnestesicaCab, 
			'idExamenFisico' => ($oTabla->idExamenFisico == 0)? Null: $oTabla->idExamenFisico, 
			'valor' => ($oTabla->valor == "")? Null: $oTabla->valor, 
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
			EXEC CQxExamenFisicoDetEliminar :idExamenFisicoDet, :idUsuarioAuditoria";

		$params = [
			'idExamenFisicoDet' => $oTabla->idExamenFisicoDet, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxExamenFisicoDetSeleccionarPorId :idExamenFisicoDet";

		$params = [
			'idExamenFisicoDet' => $oTabla->idExamenFisicoDet, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}