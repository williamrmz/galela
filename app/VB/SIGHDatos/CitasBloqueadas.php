<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CitasBloqueadas extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idCitaBloqueada AS Int = :idCitaBloqueada
			SET NOCOUNT ON 
			EXEC CitasBloqueadasAgregar @idCitaBloqueada OUTPUT, :horaBloqueo, :fechaBloqueo, :idMedico, :horaFin, :horaInicio, :fecha, :idUsuario, :idUsuarioAuditoria
			SELECT @idCitaBloqueada AS idCitaBloqueada";

		$params = [
			'idCitaBloqueada' => 0, 
			'horaBloqueo' => ($oTabla->horaBloqueo == "")? Null: $oTabla->horaBloqueo, 
			'fechaBloqueo' => ($oTabla->fechaBloqueo == 0)? Null: $oTabla->fechaBloqueo, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'horaFin' => ($oTabla->horaFin == "")? Null: $oTabla->horaFin, 
			'horaInicio' => ($oTabla->horaInicio == "")? Null: $oTabla->horaInicio, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CitasBloqueadasModificar :idCitaBloqueada, :horaBloqueo, :fechaBloqueo, :idMedico, :horaFin, :horaInicio, :fecha, :idUsuario, :idUsuarioAuditoria";

		$params = [
			'idCitaBloqueada' => ($oTabla->idCitaBloqueada == 0)? Null: $oTabla->idCitaBloqueada, 
			'horaBloqueo' => ($oTabla->horaBloqueo == "")? Null: $oTabla->horaBloqueo, 
			'fechaBloqueo' => ($oTabla->fechaBloqueo == 0)? Null: $oTabla->fechaBloqueo, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'horaFin' => ($oTabla->horaFin == "")? Null: $oTabla->horaFin, 
			'horaInicio' => ($oTabla->horaInicio == "")? Null: $oTabla->horaInicio, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CitasBloqueadasEliminar :idCitaBloqueada, :idUsuarioAuditoria";

		$params = [
			'idCitaBloqueada' => ($oTabla->idCitaBloqueada == 0)? Null: $oTabla->idCitaBloqueada, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CitasBloqueadasSeleccionarPorId :idCitaBloqueada";

		$params = [
			'idCitaBloqueada' => $oTabla->idCitaBloqueada, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarPorUsuario($lIdUsuario)
	{
		$query = "
			EXEC CitasBloqueadasEliminarXusuario :lIdUsuario";

		$params = [
			'lIdUsuario' => $lIdUsuario, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function CitasBloqueadasEliminarPorFechaHora($ldFecha, $lcHoraInicio, $ldIdMedico, $oConexion)
	{
		$query = "
			EXEC CitasBloqueadasEliminarPorFechayHora :fecha, :horaInicio, :idMedico";

		$params = [
			'fecha' => "@Fecha", adDBTimeStamp, adParamInput, 0, Format($ldFecha, "dd/mm/yyyy"), 
			'horaInicio' => $lcHoraInicio, 
			'idMedico' => $ldIdMedico, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}