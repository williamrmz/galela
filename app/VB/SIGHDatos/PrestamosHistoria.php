<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class PrestamosHistoria extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPrestamo AS Int = :idPrestamo
			SET NOCOUNT ON 
			EXEC PrestamosHistoriaClinicaAgregar :idMotivo, :fechaPrestamoRequerida, :horaPrestamoRequerida, :fechaPrestamoReal, @idPrestamo OUTPUT, :fechaSolicitud, :horaSolicitud, :idEstadoPrestamo, :idPaciente, :idEnvio, :observacion, :idServicio, :horaPrestamoReal, :horaDevolucion, :nroFolios, :fechaDevolucion, :idUsuarioAuditoria
			SELECT @idPrestamo AS idPrestamo";

		$params = [
			'idMotivo' => ($oTabla->idMotivo == 0)? Null: $oTabla->idMotivo, 
			'fechaPrestamoRequerida' => ($oTabla->fechaPrestamoRequerida == 0)? Null: $oTabla->fechaPrestamoRequerida, 
			'horaPrestamoRequerida' => ($oTabla->horaPrestamoRequerida == "")? Null: $oTabla->horaPrestamoRequerida, 
			'fechaPrestamoReal' => ($oTabla->fechaPrestamoReal == 0)? Null: $oTabla->fechaPrestamoReal, 
			'idPrestamo' => 0, 
			'fechaSolicitud' => ($oTabla->fechaSolicitud == 0)? Null: $oTabla->fechaSolicitud, 
			'horaSolicitud' => ($oTabla->horaSolicitud == "")? Null: $oTabla->horaSolicitud, 
			'idEstadoPrestamo' => ($oTabla->idEstadoPrestamo == 0)? Null: $oTabla->idEstadoPrestamo, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idEnvio' => ($oTabla->idEnvio == 0)? Null: $oTabla->idEnvio, 
			'observacion' => ($oTabla->observacion == "")? Null: $oTabla->observacion, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'horaPrestamoReal' => ($oTabla->horaPrestamoReal == "")? Null: $oTabla->horaPrestamoReal, 
			'horaDevolucion' => ($oTabla->horaDevolucion == "")? Null: $oTabla->horaDevolucion, 
			'nroFolios' => ($oTabla->nroFolios == 0)? Null: $oTabla->nroFolios, 
			'fechaDevolucion' => ($oTabla->fechaDevolucion == 0)? Null: $oTabla->fechaDevolucion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC PrestamosHistoriaClinicaModificar :idMotivo, :fechaPrestamoRequerida, :horaPrestamoRequerida, :fechaPrestamoReal, :idPrestamo, :fechaSolicitud, :horaSolicitud, :idEstadoPrestamo, :idPaciente, :idEnvio, :observacion, :idServicio, :horaPrestamoReal, :horaDevolucion, :nroFolios, :fechaDevolucion, :idUsuarioAuditoria";

		$params = [
			'idMotivo' => ($oTabla->idMotivo == 0)? Null: $oTabla->idMotivo, 
			'fechaPrestamoRequerida' => ($oTabla->fechaPrestamoRequerida == 0)? Null: $oTabla->fechaPrestamoRequerida, 
			'horaPrestamoRequerida' => ($oTabla->horaPrestamoRequerida == "")? Null: $oTabla->horaPrestamoRequerida, 
			'fechaPrestamoReal' => ($oTabla->fechaPrestamoReal == 0)? Null: $oTabla->fechaPrestamoReal, 
			'idPrestamo' => ($oTabla->idPrestamo == 0)? Null: $oTabla->idPrestamo, 
			'fechaSolicitud' => ($oTabla->fechaSolicitud == 0)? Null: $oTabla->fechaSolicitud, 
			'horaSolicitud' => ($oTabla->horaSolicitud == "")? Null: $oTabla->horaSolicitud, 
			'idEstadoPrestamo' => ($oTabla->idEstadoPrestamo == 0)? Null: $oTabla->idEstadoPrestamo, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idEnvio' => ($oTabla->idEnvio == 0)? Null: $oTabla->idEnvio, 
			'observacion' => ($oTabla->observacion == "")? Null: $oTabla->observacion, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'horaPrestamoReal' => ($oTabla->horaPrestamoReal == "")? Null: $oTabla->horaPrestamoReal, 
			'horaDevolucion' => ($oTabla->horaDevolucion == "")? Null: $oTabla->horaDevolucion, 
			'nroFolios' => ($oTabla->nroFolios == 0)? Null: $oTabla->nroFolios, 
			'fechaDevolucion' => ($oTabla->fechaDevolucion == 0)? Null: $oTabla->fechaDevolucion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC PrestamosHistoriaClinicaEliminar :idPrestamo, :idUsuarioAuditoria";

		$params = [
			'idPrestamo' => ($oTabla->idPrestamo == 0)? Null: $oTabla->idPrestamo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC PrestamosHistoriaClinicaSeleccionarPorId :idPrestamo";

		$params = [
			'idPrestamo' => $oTabla->idPrestamo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oDOPaciente, $oDOPrestamo)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarEnviados($oDOPaciente, $oDOPrestamo)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarParaEnvio($oBusqueda)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizarIdEnvio($oDOEnvio, $oPrestamos)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}