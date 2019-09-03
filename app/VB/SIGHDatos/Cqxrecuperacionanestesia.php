<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Cqxrecuperacionanestesia extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idRecuperacionAnestesia AS Int = :idRecuperacionAnestesia
			SET NOCOUNT ON 
			EXEC CQxRecuperacionAnestesiaAgregar @idRecuperacionAnestesia OUTPUT, :idRegistroAnestesiologiaCab, :satisfactorio, :no_Satisfactorio, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idRecuperacionAnestesia AS idRecuperacionAnestesia";

		$params = [
			'idRecuperacionAnestesia' => 0, 
			'idRegistroAnestesiologiaCab' => ($oTabla->idRegistroAnestesiologiaCab == 0)? Null: $oTabla->idRegistroAnestesiologiaCab, 
			'satisfactorio' => ($oTabla->satisfactorio == 0)? Null: $oTabla->satisfactorio, 
			'no_Satisfactorio' => ($oTabla->no_Satisfactorio == 0)? Null: $oTabla->no_Satisfactorio, 
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
			EXEC CQxRecuperacionAnestesiaModificar :idRecuperacionAnestesia, :idRegistroAnestesiologiaCab, :satisfactorio, :no_Satisfactorio, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idRecuperacionAnestesia' => ($oTabla->idRecuperacionAnestesia == 0)? Null: $oTabla->idRecuperacionAnestesia, 
			'idRegistroAnestesiologiaCab' => ($oTabla->idRegistroAnestesiologiaCab == 0)? Null: $oTabla->idRegistroAnestesiologiaCab, 
			'satisfactorio' => ($oTabla->satisfactorio == 0)? Null: $oTabla->satisfactorio, 
			'no_Satisfactorio' => ($oTabla->no_Satisfactorio == 0)? Null: $oTabla->no_Satisfactorio, 
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
			EXEC CQxRecuperacionAnestesiaEliminar :idRecuperacionAnestesia, :idUsuarioAuditoria";

		$params = [
			'idRecuperacionAnestesia' => $oTabla->idRegistroAnestesiologiaCab, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxRecuperacionAnestesiaSeleccionarPorId :idRecuperacionAnestesia";

		$params = [
			'idRecuperacionAnestesia' => $oTabla->idRegistroAnestesiologiaCab, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}