<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxAnestesiaRegionalDet extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idAnestesiaRegionalDet AS Int = :idAnestesiaRegionalDet
			SET NOCOUNT ON 
			EXEC CQxAnestesiaRegionalDetAgregar @idAnestesiaRegionalDet OUTPUT, :idRegistroAnestesiologiaCab, :idTecnicaAnestesiaRegional, :valor, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idAnestesiaRegionalDet AS idAnestesiaRegionalDet";

		$params = [
			'idAnestesiaRegionalDet' => 0, 
			'idRegistroAnestesiologiaCab' => ($oTabla->idRegistroAnestesiologiaCab == 0)? Null: $oTabla->idRegistroAnestesiologiaCab, 
			'idTecnicaAnestesiaRegional' => ($oTabla->idTecnicaAnestesiaRegional == 0)? Null: $oTabla->idTecnicaAnestesiaRegional, 
			'valor' => ($oTabla->valor == "")? Null: $oTabla->valor, 
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
			EXEC CQxAnestesiaRegionalDetModificar :idAnestesiaRegionalDet, :idRegistroAnestesiologiaCab, :idTecnicaAnestesiaRegional, :valor, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idAnestesiaRegionalDet' => ($oTabla->idAnestesiaRegionalDet == 0)? Null: $oTabla->idAnestesiaRegionalDet, 
			'idRegistroAnestesiologiaCab' => ($oTabla->idRegistroAnestesiologiaCab == 0)? Null: $oTabla->idRegistroAnestesiologiaCab, 
			'idTecnicaAnestesiaRegional' => ($oTabla->idTecnicaAnestesiaRegional == 0)? Null: $oTabla->idTecnicaAnestesiaRegional, 
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
			EXEC CQxAnestesiaRegionalDetEliminar :idAnestesiaRegionalDet, :idUsuarioAuditoria";

		$params = [
			'idAnestesiaRegionalDet' => $oTabla->idRegistroAnestesiologiaCab, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxAnestesiaRegionalDetSeleccionarPorId :idAnestesiaRegionalDet";

		$params = [
			'idAnestesiaRegionalDet' => $oTabla->idAnestesiaRegionalDet, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarAnestesiaRegionalDet($lnIdPaciente)
	{
		$query = "
			EXEC CQxAnestesiaRegionalListar :idordenoperatoriamq";

		$params = [
			'idordenoperatoriamq' => $lnIdPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}