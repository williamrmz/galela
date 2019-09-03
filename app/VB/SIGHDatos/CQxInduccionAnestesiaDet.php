<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxInduccionAnestesiaDet extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idInduccionAnestesiaDet AS Int = :idInduccionAnestesiaDet
			SET NOCOUNT ON 
			EXEC CQxInduccionAnestesiaDetAgregar @idInduccionAnestesiaDet OUTPUT, :idRegistroAnestesiologiaCab, :idInduccionAnestesia, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idInduccionAnestesiaDet AS idInduccionAnestesiaDet";

		$params = [
			'idInduccionAnestesiaDet' => 0, 
			'idRegistroAnestesiologiaCab' => ($oTabla->idRegistroAnestesiologiaCab == 0)? Null: $oTabla->idRegistroAnestesiologiaCab, 
			'idInduccionAnestesia' => ($oTabla->idInduccionAnestesia == 0)? Null: $oTabla->idInduccionAnestesia, 
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
			EXEC CQxInduccionAnestesiaDetModificar :idInduccionAnestesiaDet, :idRegistroAnestesiologiaCab, :idInduccionAnestesia, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idInduccionAnestesiaDet' => ($oTabla->idInduccionAnestesiaDet == 0)? Null: $oTabla->idInduccionAnestesiaDet, 
			'idRegistroAnestesiologiaCab' => ($oTabla->idRegistroAnestesiologiaCab == 0)? Null: $oTabla->idRegistroAnestesiologiaCab, 
			'idInduccionAnestesia' => ($oTabla->idInduccionAnestesia == 0)? Null: $oTabla->idInduccionAnestesia, 
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
			EXEC CQxInduccionAnestesiaDetEliminar :idInduccionAnestesiaDet, :idUsuarioAuditoria";

		$params = [
			'idInduccionAnestesiaDet' => $oTabla->idRegistroAnestesiologiaCab, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxInduccionAnestesiaDetSeleccionarPorId :idInduccionAnestesiaDet";

		$params = [
			'idInduccionAnestesiaDet' => $oTabla->idInduccionAnestesiaDet, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarAnestesiaInduccionDet($lnIdPaciente)
	{
		$query = "
			EXEC CQxInduccionAnestesiaListar :idordenoperatoriamq";

		$params = [
			'idordenoperatoriamq' => $lnIdPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}