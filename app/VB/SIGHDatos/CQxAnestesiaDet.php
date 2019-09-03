<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxAnestesiaDet extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idAnestesiaDet AS Int = :idAnestesiaDet
			SET NOCOUNT ON 
			EXEC CQxAnestesiaDetAgregar @idAnestesiaDet OUTPUT, :idRegistroAnestesiologiaCab, :idAnestesia, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idAnestesiaDet AS idAnestesiaDet";

		$params = [
			'idAnestesiaDet' => 0, 
			'idRegistroAnestesiologiaCab' => ($oTabla->idRegistroAnestesiologiaCab == 0)? Null: $oTabla->idRegistroAnestesiologiaCab, 
			'idAnestesia' => ($oTabla->idAnestesia == 0)? Null: $oTabla->idAnestesia, 
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
			EXEC CQxAnestesiaDetModificar :idAnestesiaDet, :idRegistroAnestesiologiaCab, :idAnestesia, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idAnestesiaDet' => ($oTabla->idAnestesiaDet == 0)? Null: $oTabla->idAnestesiaDet, 
			'idRegistroAnestesiologiaCab' => ($oTabla->idRegistroAnestesiologiaCab == 0)? Null: $oTabla->idRegistroAnestesiologiaCab, 
			'idAnestesia' => ($oTabla->idAnestesia == 0)? Null: $oTabla->idAnestesia, 
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
			EXEC CQxAnestesiaDetEliminar :idAnestesiaDet, :idUsuarioAuditoria";

		$params = [
			'idAnestesiaDet' => $oTabla->idRegistroAnestesiologiaCab, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxAnestesiaDetSeleccionarPorId :idAnestesiaDet";

		$params = [
			'idAnestesiaDet' => $oTabla->idAnestesiaDet, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarAnestesiaDet($lnIdPaciente)
	{
		$query = "
			EXEC cqxanestesiadetlistar :idordenoperatoriamq";

		$params = [
			'idordenoperatoriamq' => $lnIdPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarRecetaa()
	{
		$query = "
			EXEC ListarReceta ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarMedicamentos($lidreceta)
	{
		$query = "
			EXEC ListarMedicamentos :idreceta";

		$params = [
			'idreceta' => $lidreceta, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}