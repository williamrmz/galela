<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class MARJustificacion extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idJustificacion AS Int = :idJustificacion
			SET NOCOUNT ON 
			EXEC MARJustificacionAgregar @idJustificacion OUTPUT, :idCita, :idMedico, :fecha, :hora, :descripcion, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idJustificacion AS idJustificacion";

		$params = [
			'idJustificacion' => 0, 
			'idCita' => ($oTabla->idCita == 0)? Null: $oTabla->idCita, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'hora' => $oTabla->hora, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
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
			EXEC MARJustificacionModificar :idJustificacion, :idCita, :idMedico, :fecha, :hora, :descripcion, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idJustificacion' => ($oTabla->idJustificacion == 0)? Null: $oTabla->idJustificacion, 
			'idCita' => ($oTabla->idCita == 0)? Null: $oTabla->idCita, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'hora' => $oTabla->hora, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'estadoReg' => ($oTabla->estadoReg == 0)? Null: $oTabla->estadoReg, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorIdPacienteMAR($oTabla)
	{
		$query = "
			EXEC PacienteSeleccionarPorIdMAR :idPaciente";

		$params = [
			'idPaciente' => $oTabla->idatencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC MARJustificacionEliminar :idJustificacion, :idUsuarioAuditoria";

		$params = [
			'idJustificacion' => $oTabla->idJustificacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC MARJustificacionSeleccionarPorId :idJustificacion";

		$params = [
			'idJustificacion' => $oTabla->idJustificacion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Validar($id)
	{
		$query = "
			EXEC MARValidarUsuario :idJustificacion";

		$params = [
			'idJustificacion' => Id, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AtencionesSeleccionarCEPorCuentaPorHistoriaPorApellidosPorServicioMAR($lnHistoriaClinica, $lnIdCuentaAtencion, $lcApellidoPaterno, $lcFechaIngreso, $lnIdServicio, $lcDNI)
	{
		$query = "
			EXEC AtencionesSeleccionarCEPorCuentaPorHistoriaPorApellidosPorServicioMAR :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AtencionesSeleccionarEmergPorCuentaPorHistoriaPorApellidosPorServicioMAR($lnHistoriaClinica, $lnIdCuentaAtencion, $lcApellidoPaterno, $lcFechaIngreso, $lnIdServicio, $lcDNI)
	{
		$query = "
			EXEC AtencionesSeleccionarEmergPorCuentaPorHistoriaPorApellidosPorServicioMAR :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AtencionesSeleccionarHospPorCuentaPorHistoriaPorApellidosPorServicioMAR($lnHistoriaClinica, $lnIdCuentaAtencion, $lcApellidoPaterno, $lcFechaIngreso, $lnIdServicio, $lcDNI)
	{
		$query = "
			EXEC AtencionesSeleccionarHospPorCuentaPorHistoriaPorApellidosPorServicioMAR :lcFiltro, :lcParametro289";

		$params = [
			'lcFiltro' => sSql, 
			'lcParametro289' => lcParametro289, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}