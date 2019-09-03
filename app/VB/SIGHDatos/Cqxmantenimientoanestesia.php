<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Cqxmantenimientoanestesia extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idMantenimientoAnestesia AS Int = :idMantenimientoAnestesia
			SET NOCOUNT ON 
			EXEC CQxMantenimientoAnestesiaAgregar @idMantenimientoAnestesia OUTPUT, :idRegistroAnestesiologiaCab, :satisfactorio, :no_Satisfactorio, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idMantenimientoAnestesia AS idMantenimientoAnestesia";

		$params = [
			'idMantenimientoAnestesia' => 0, 
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
			EXEC CQxMantenimientoAnestesiaModificar :idMantenimientoAnestesia, :idRegistroAnestesiologiaCab, :satisfactorio, :no_Satisfactorio, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idMantenimientoAnestesia' => ($oTabla->idMantenimientoAnestesia == 0)? Null: $oTabla->idMantenimientoAnestesia, 
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
			EXEC CQxMantenimientoAnestesiaEliminar :idMantenimientoAnestesia, :idUsuarioAuditoria";

		$params = [
			'idMantenimientoAnestesia' => $oTabla->idRegistroAnestesiologiaCab, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxMantenimientoAnestesiaSeleccionarPorId :idMantenimientoAnestesia";

		$params = [
			'idMantenimientoAnestesia' => $oTabla->idRegistroAnestesiologiaCab, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}