<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Cqxanestesiageneraldet extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idAnestesiaGeneralDet AS Int = :idAnestesiaGeneralDet
			SET NOCOUNT ON 
			EXEC CQxAnestesiaGeneralDetAgregar @idAnestesiaGeneralDet OUTPUT, :idRegistroAnestesiologiaCab, :idAnestesiaGeneral, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idAnestesiaGeneralDet AS idAnestesiaGeneralDet";

		$params = [
			'idAnestesiaGeneralDet' => 0, 
			'idRegistroAnestesiologiaCab' => ($oTabla->idRegistroAnestesiologiaCab == 0)? Null: $oTabla->idRegistroAnestesiologiaCab, 
			'idAnestesiaGeneral' => ($oTabla->idAnestesiaGeneral == 0)? Null: $oTabla->idAnestesiaGeneral, 
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
			EXEC CQxAnestesiaGeneralDetModificar :idAnestesiaGeneralDet, :idRegistroAnestesiologiaCab, :idAnestesiaGeneral, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idAnestesiaGeneralDet' => ($oTabla->idAnestesiaGeneralDet == 0)? Null: $oTabla->idAnestesiaGeneralDet, 
			'idRegistroAnestesiologiaCab' => ($oTabla->idRegistroAnestesiologiaCab == 0)? Null: $oTabla->idRegistroAnestesiologiaCab, 
			'idAnestesiaGeneral' => ($oTabla->idAnestesiaGeneral == 0)? Null: $oTabla->idAnestesiaGeneral, 
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
			EXEC CQxAnestesiaGeneralDetEliminar :idAnestesiaGeneralDet, :idUsuarioAuditoria";

		$params = [
			'idAnestesiaGeneralDet' => $oTabla->idRegistroAnestesiologiaCab, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxAnestesiaGeneralDetSeleccionarPorId :idAnestesiaGeneralDet";

		$params = [
			'idAnestesiaGeneralDet' => $oTabla->idAnestesiaGeneralDet, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarAnestesiaGeneralDet($lnIdPaciente)
	{
		$query = "
			EXEC cqxanestesiageneraldetlistar :idordenoperatoriamq";

		$params = [
			'idordenoperatoriamq' => $lnIdPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}