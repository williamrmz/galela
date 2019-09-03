<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtencionesInterconsultas extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idInterconsulta AS Int = :idInterconsulta
			SET NOCOUNT ON 
			EXEC AtencionesInterconsultasAgregar :idDetalleProducto, :idAtencion, :horaSolicitud, :horaRealizacion, :fechaSolicitud, :fechaRealizacion, :idMedicoRealiza, :idMedicoSolicita, @idInterconsulta OUTPUT, :idUsuarioAuditoria
			SELECT @idInterconsulta AS idInterconsulta";

		$params = [
			'idDetalleProducto' => ($oTabla->idDetalleProducto == 0)? Null: $oTabla->idDetalleProducto, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'horaSolicitud' => ($oTabla->horaSolicitud == "")? Null: $oTabla->horaSolicitud, 
			'horaRealizacion' => ($oTabla->horaRealizacion == "")? Null: $oTabla->horaRealizacion, 
			'fechaSolicitud' => ($oTabla->fechaSolicitud == 0)? Null: $oTabla->fechaSolicitud, 
			'fechaRealizacion' => ($oTabla->fechaRealizacion == 0)? Null: $oTabla->fechaRealizacion, 
			'idMedicoRealiza' => ($oTabla->idMedicoRealiza == 0)? Null: $oTabla->idMedicoRealiza, 
			'idMedicoSolicita' => ($oTabla->idMedicoSolicita == 0)? Null: $oTabla->idMedicoSolicita, 
			'idInterconsulta' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtencionesInterconsultasModificar :idDetalleProducto, :idAtencion, :horaSolicitud, :horaRealizacion, :fechaSolicitud, :fechaRealizacion, :idMedicoRealiza, :idMedicoSolicita, :idInterconsulta, :idUsuarioAuditoria";

		$params = [
			'idDetalleProducto' => ($oTabla->idDetalleProducto == 0)? Null: $oTabla->idDetalleProducto, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'horaSolicitud' => ($oTabla->horaSolicitud == "")? Null: $oTabla->horaSolicitud, 
			'horaRealizacion' => ($oTabla->horaRealizacion == "")? Null: $oTabla->horaRealizacion, 
			'fechaSolicitud' => ($oTabla->fechaSolicitud == 0)? Null: $oTabla->fechaSolicitud, 
			'fechaRealizacion' => ($oTabla->fechaRealizacion == 0)? Null: $oTabla->fechaRealizacion, 
			'idMedicoRealiza' => ($oTabla->idMedicoRealiza == 0)? Null: $oTabla->idMedicoRealiza, 
			'idMedicoSolicita' => ($oTabla->idMedicoSolicita == 0)? Null: $oTabla->idMedicoSolicita, 
			'idInterconsulta' => ($oTabla->idInterconsulta == 0)? Null: $oTabla->idInterconsulta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtencionesInterconsultasEliminar :idInterconsulta, :idUsuarioAuditoria";

		$params = [
			'idInterconsulta' => ($oTabla->idInterconsulta == 0)? Null: $oTabla->idInterconsulta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtencionesInterconsultasSeleccionarPorId :idInterconsulta";

		$params = [
			'idInterconsulta' => $oTabla->idInterconsulta, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarConsultaExterna($oDOPaciente)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarConsultorioEmergencia($oDOPaciente)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarObservacionEmergencia($oDOPaciente)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarHospitalizacion($oDOPaciente)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizarDiagnosticosInterconsultas($oDiagnosticos, $lIdInterconsulta)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDiagnosticosPorInterconsulta($lIdInterconsulta)
	{
		$query = "
			EXEC AtencionesInterconsultasSeleccionarDiagnosticos :lIdInterconsulta";

		$params = [
			'lIdInterconsulta' => $lIdInterconsulta, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}