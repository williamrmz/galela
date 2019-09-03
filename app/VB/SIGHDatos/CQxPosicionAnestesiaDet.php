<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxPosicionAnestesiaDet extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPosicionAnestesiaDet AS Int = :idPosicionAnestesiaDet
			SET NOCOUNT ON 
			EXEC CQxPosicionAnestesiaDetAgregar @idPosicionAnestesiaDet OUTPUT, :idRegistroAnestesiologiaCab, :idPosicionAnestesia, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idPosicionAnestesiaDet AS idPosicionAnestesiaDet";

		$params = [
			'idPosicionAnestesiaDet' => 0, 
			'idRegistroAnestesiologiaCab' => ($oTabla->idRegistroAnestesiologiaCab == 0)? Null: $oTabla->idRegistroAnestesiologiaCab, 
			'idPosicionAnestesia' => ($oTabla->idPosicionAnestesia == 0)? Null: $oTabla->idPosicionAnestesia, 
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
			EXEC CQxPosicionAnestesiaDetModificar :idPosicionAnestesiaDet, :idRegistroAnestesiologiaCab, :idPosicionAnestesia, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idPosicionAnestesiaDet' => ($oTabla->idPosicionAnestesiaDet == 0)? Null: $oTabla->idPosicionAnestesiaDet, 
			'idRegistroAnestesiologiaCab' => ($oTabla->idRegistroAnestesiologiaCab == 0)? Null: $oTabla->idRegistroAnestesiologiaCab, 
			'idPosicionAnestesia' => ($oTabla->idPosicionAnestesia == 0)? Null: $oTabla->idPosicionAnestesia, 
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
			EXEC CQxPosicionAnestesiaDetEliminar :idPosicionAnestesiaDet, :idUsuarioAuditoria";

		$params = [
			'idPosicionAnestesiaDet' => $oTabla->idRegistroAnestesiologiaCab, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxPosicionAnestesiaDetSeleccionarPorId :idPosicionAnestesiaDet";

		$params = [
			'idPosicionAnestesiaDet' => $oTabla->idPosicionAnestesiaDet, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarPosicionAnestesiaDet($lnIdPaciente)
	{
		$query = "
			EXEC cqxposicionanestesialistar :idordenoperatoriamq";

		$params = [
			'idordenoperatoriamq' => $lnIdPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}