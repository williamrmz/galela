<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class InterconsultaAtencion extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idInterconsulta AS Int = :idInterconsulta
			SET NOCOUNT ON 
			EXEC InterconsultaAtencionAgregar :horaSolicitud, :fechaSolicitud, :horaRealizacion, :idDetalleProducto, :idDiagnostico, :fechaRealizacion, :idCuentaAtencion, :idMedicoRealiza, :idMedicoSolicita, @idInterconsulta OUTPUT, :idUsuarioAuditoria
			SELECT @idInterconsulta AS idInterconsulta";

		$params = [
			'horaSolicitud' => ($oTabla->horaSolicitud == "")? Null: $oTabla->horaSolicitud, 
			'fechaSolicitud' => ($oTabla->fechaSolicitud == 0)? Null: $oTabla->fechaSolicitud, 
			'horaRealizacion' => ($oTabla->horaRealizacion == "")? Null: $oTabla->horaRealizacion, 
			'idDetalleProducto' => ($oTabla->idDetalleProducto == 0)? Null: $oTabla->idDetalleProducto, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'fechaRealizacion' => ($oTabla->fechaRealizacion == 0)? Null: $oTabla->fechaRealizacion, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
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
			EXEC InterconsultaAtencionModificar :horaSolicitud, :fechaSolicitud, :horaRealizacion, :idDetalleProducto, :idDiagnostico, :fechaRealizacion, :idCuentaAtencion, :idMedicoRealiza, :idMedicoSolicita, :idInterconsulta, :idUsuarioAuditoria";

		$params = [
			'horaSolicitud' => ($oTabla->horaSolicitud == "")? Null: $oTabla->horaSolicitud, 
			'fechaSolicitud' => ($oTabla->fechaSolicitud == 0)? Null: $oTabla->fechaSolicitud, 
			'horaRealizacion' => ($oTabla->horaRealizacion == "")? Null: $oTabla->horaRealizacion, 
			'idDetalleProducto' => ($oTabla->idDetalleProducto == 0)? Null: $oTabla->idDetalleProducto, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'fechaRealizacion' => ($oTabla->fechaRealizacion == 0)? Null: $oTabla->fechaRealizacion, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
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
			EXEC InterconsultaAtencionEliminar :idInterconsulta, :idUsuarioAuditoria";

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
			EXEC InterconsultaAtencionSeleccionarPorId :idInterconsulta";

		$params = [
			'idInterconsulta' => $oTabla->idInterconsulta, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCuentaAtencion($lIdCuentaAtencion)
	{
		$query = "
			EXEC InterconsultaAtencionSeleccionarPorCuentaAtencion :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $lIdCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizarInterconsultas($oInterconsultas, $lIdCuentaAtencion)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarInterconsultas($lIdCuentaAtencion)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}