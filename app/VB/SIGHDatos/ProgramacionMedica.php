<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ProgramacionMedica extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idProgramacion AS Int = :idProgramacion
			SET NOCOUNT ON 
			EXEC ProgramacionMedicaAgregar :idEspecialidad, :idTurno, :color, :idServicio, @idProgramacion OUTPUT, :idMedico, :idDepartamento, :idTipoServicio, :fecha, :horaInicio, :horaFin, :descripcion, :idTipoProgramacion, :fechaReg, :tiempoPromedioAtencion, :idUsuarioAuditoria
			SELECT @idProgramacion AS idProgramacion";

		$params = [
			'idEspecialidad' => ($oTabla->idEspecialidad == 0)? Null: $oTabla->idEspecialidad, 
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'color' => ($oTabla->color == 0)? Null: $oTabla->color, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'idProgramacion' => 0, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'idDepartamento' => ($oTabla->idDepartamento == 0)? Null: $oTabla->idDepartamento, 
			'idTipoServicio' => ($oTabla->idTipoServicio == 0)? Null: $oTabla->idTipoServicio, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'horaInicio' => ($oTabla->horaInicio == "")? Null: $oTabla->horaInicio, 
			'horaFin' => ($oTabla->horaFin == "")? Null: $oTabla->horaFin, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoProgramacion' => ($oTabla->idTipoProgramacion == 0)? Null: $oTabla->idTipoProgramacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'tiempoPromedioAtencion' => ($oTabla->tiempoPromedioAtencion == 0)? Null: $oTabla->tiempoPromedioAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC ProgramacionMedicaModificar :idEspecialidad, :idTurno, :color, :idServicio, :idProgramacion, :idMedico, :idDepartamento, :idTipoServicio, :fecha, :horaInicio, :horaFin, :descripcion, :idTipoProgramacion, :tiempoPromedioAtencion, :idUsuarioAuditoria";

		$params = [
			'idEspecialidad' => ($oTabla->idEspecialidad == 0)? Null: $oTabla->idEspecialidad, 
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'color' => ($oTabla->color == 0)? Null: $oTabla->color, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'idProgramacion' => ($oTabla->idProgramacion == 0)? Null: $oTabla->idProgramacion, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'idDepartamento' => ($oTabla->idDepartamento == 0)? Null: $oTabla->idDepartamento, 
			'idTipoServicio' => ($oTabla->idTipoServicio == 0)? Null: $oTabla->idTipoServicio, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'horaInicio' => ($oTabla->horaInicio == "")? Null: $oTabla->horaInicio, 
			'horaFin' => ($oTabla->horaFin == "")? Null: $oTabla->horaFin, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoProgramacion' => ($oTabla->idTipoProgramacion == 0)? Null: $oTabla->idTipoProgramacion, 
			'tiempoPromedioAtencion' => ($oTabla->tiempoPromedioAtencion == 0)? Null: $oTabla->tiempoPromedioAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC ProgramacionMedicaEliminar :idProgramacion, :idUsuarioAuditoria";

		$params = [
			'idProgramacion' => ($oTabla->idProgramacion == 0)? Null: $oTabla->idProgramacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC ProgramacionMedicaSeleccionarPorId :idProgramacion";

		$params = [
			'idProgramacion' => $oTabla->idProgramacion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarPorMedicoYMes($lIdMedico, $iMes, $iAnio, $lIdUsuario)
	{
		$query = "
			EXEC ProgramacionMedicaEliminarPorMedicoYMes :idMedico, :mes, :anio, :idUsuarioAuditoria";

		$params = [
			'idMedico' => $lIdMedico, 
			'mes' => $iMes, 
			'anio' => $iAnio, 
			'idUsuarioAuditoria' => $lIdUsuario, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorMedicoYMes($lIdMedico, $iMes, $iAnio)
	{
		$query = "
			EXEC ProgramacionMedicaSeleccionarPorMedicoYMes :idMedico, :mes, :anio";

		$params = [
			'idMedico' => $lIdMedico, 
			'mes' => $iMes, 
			'anio' => $iAnio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDiasDeCEProgPorMedicoYMes($lIdMedico, $iMes, $iAnio)
	{
		$query = "
			EXEC ProgramacionMedicaXMedicoMesAnio :lIdMedico, :iMes, :iAnio";

		$params = [
			'lIdMedico' => $lIdMedico, 
			'iMes' => $iMes, 
			'iAnio' => $iAnio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorMedico($lIdMedico)
	{
		$query = "
			EXEC ProgramacionMedicaXmedico :lIdMedico";

		$params = [
			'lIdMedico' => $lIdMedico, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ModificarHoraFinPorCitaAdicional($oTabla)
	{
		$query = "
			EXEC ProgramacionMedicaModificarHoraPorCitaAdicional :idProgramacion, :horaFin, :idUsuarioAuditoria";

		$params = [
			'idProgramacion' => ($oTabla->idProgramacion == 0)? Null: $oTabla->idProgramacion, 
			'horaFin' => ($oTabla->horaFin == "")? Null: $oTabla->horaFin, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}