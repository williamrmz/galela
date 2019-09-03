<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class HistoriasSolicitadas extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idHistoriaSolicitada AS Int = :idHistoriaSolicitada
			SET NOCOUNT ON 
			EXEC HistoriasSolicitadasAgregar :idMotivo, :horaRequerida, :fechaRequerida, :horaSolicitud, :fechaSolicitud, :idPaciente, @idHistoriaSolicitada OUTPUT, :idEmpleadoSolicita, :idMovimiento, :observacion, :idServicio, :idUsuarioAuditoria, :idAtencion
			SELECT @idHistoriaSolicitada AS idHistoriaSolicitada";

		$params = [
			'idMotivo' => ($oTabla->idMotivo == 0)? Null: $oTabla->idMotivo, 
			'horaRequerida' => ($oTabla->horaRequerida == "")? Null: $oTabla->horaRequerida, 
			'fechaRequerida' => ($oTabla->fecharequerida == 0)? Null: $oTabla->fecharequerida, 
			'horaSolicitud' => ($oTabla->horaSolicitud == "")? Null: $oTabla->horaSolicitud, 
			'fechaSolicitud' => ($oTabla->fechaSolicitud == 0)? Null: $oTabla->fechaSolicitud, 
			'idPaciente' => ($oTabla->idPaciente == 0)? 0: $oTabla->idPaciente, 
			'idHistoriaSolicitada' => 0, 
			'idEmpleadoSolicita' => ($oTabla->idEmpleadoSolicita == 0)? Null: $oTabla->idEmpleadoSolicita, 
			'idMovimiento' => ($oTabla->idMovimiento == 0)? Null: $oTabla->idMovimiento, 
			'observacion' => ($oTabla->observacion == "")? Null: $oTabla->observacion, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idAtencion' => ($oTabla->idatencion == 0)? Null: $oTabla->idatencion, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC HistoriasSolicitadasModificar :idMotivo, :horaRequerida, :fechaRequerida, :horaSolicitud, :fechaSolicitud, :idPaciente, :idHistoriaSolicitada, :idEmpleadoSolicita, :idMovimiento, :observacion, :idServicio, :idUsuarioAuditoria, :idAtencion";

		$params = [
			'idMotivo' => ($oTabla->idMotivo == 0)? Null: $oTabla->idMotivo, 
			'horaRequerida' => ($oTabla->horaRequerida == "")? Null: $oTabla->horaRequerida, 
			'fechaRequerida' => ($oTabla->fecharequerida == 0)? Null: $oTabla->fecharequerida, 
			'horaSolicitud' => ($oTabla->horaSolicitud == "")? Null: $oTabla->horaSolicitud, 
			'fechaSolicitud' => ($oTabla->fechaSolicitud == 0)? Null: $oTabla->fechaSolicitud, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idHistoriaSolicitada' => ($oTabla->idHistoriaSolicitada == 0)? Null: $oTabla->idHistoriaSolicitada, 
			'idEmpleadoSolicita' => ($oTabla->idEmpleadoSolicita == 0)? Null: $oTabla->idEmpleadoSolicita, 
			'idMovimiento' => ($oTabla->idMovimiento == 0)? Null: $oTabla->idMovimiento, 
			'observacion' => ($oTabla->observacion == "")? Null: $oTabla->observacion, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idAtencion' => ($oTabla->idatencion == 0)? Null: $oTabla->idatencion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC HistoriasSolicitadasEliminar :idHistoriaSolicitada, :idUsuarioAuditoria";

		$params = [
			'idHistoriaSolicitada' => ($oTabla->idHistoriaSolicitada == 0)? Null: $oTabla->idHistoriaSolicitada, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC HistoriasSolicitadasSeleccionarPorId :idHistoriaSolicitada";

		$params = [
			'idHistoriaSolicitada' => $oTabla->idHistoriaSolicitada, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oDOPaciente, $oDOHistoria, $oDOArchiveroServ)
	{
		$query = "
			EXEC HistoriasSolicitadasSegunFiltro :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdPaciente($lIdPaciente)
	{
		$query = "
			EXEC HistoriasSolicitadasXidPaciente :lIdPaciente";

		$params = [
			'lIdPaciente' => $lIdPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdMovimiento($lIdMovimiento)
	{
		$query = "
			EXEC HistoriasSolicitadasXidMovimiento :lIdMovimiento";

		$params = [
			'lIdMovimiento' => $lIdMovimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizarIdMovimiento($rsMovimientos)
	{
		$query = "
			EXEC HistoriasSolicitadasActualizarIdMovimiento :idHistoriaSolicitada, :idEstadoRegistro, :seleccionar, :idMovimientoHistoria";

		$params = [
			'idHistoriaSolicitada' => $rsMovimientos!IdHistoriaSolicitada, 
			'idEstadoRegistro' => $rsMovimientos!IdEstadoRegistro, 
			'seleccionar' => $rsMovimientos!Seleccionar, 
			'idMovimientoHistoria' => $rsMovimientos!IdMovimientoHistoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function EliminarIdMovimiento($rsMovimientos)
	{
		$query = "
			EXEC HistoriasSolicitadasEliminarIdMovimiento :idHistoriaSolicitada";

		$params = [
			'idHistoriaSolicitada' => $rsMovimientos!IdHistoriaSolicitada, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function EliminarPorCita($oCita)
	{
		$query = "
			EXEC HistoriasSolicitadasEliminarPorCita :idPaciente, :fecha, :horaInicio";

		$params = [
			'idPaciente' => $oCita->idPaciente, 
			'fecha' => $oCita->fecha, 
			'horaInicio' => $oCita->horaInicio, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorArchivero($lIdEmpleado, $lIdMotivo)
	{
		$query = "
			EXEC HistoriasSolicitadasPorFiltro :lcFiltro, :lIdEmpleado, :lnIdArchivoClinico, :lcParametro231";

		$params = [
			'lcFiltro' => sSql, 
			'lIdEmpleado' => Trim(Str($lIdEmpleado)), 
			'lnIdArchivoClinico' => Trim(Str(lnIdArchivoClinico)), 
			'lcParametro231' => lcParametro231, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function HistoriasSolicitadasSeleccionarDetallePorIdPaciente($lIdPaciente)
	{
		$query = "
			EXEC HistoriasSolicitadasSeleccionarDetallePorIdPaciente :idPaciente";

		$params = [
			'idPaciente' => $lIdPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function HistoriasSolicitadasSeleccionarPorIdAtencion($lnIdAtencion)
	{
		$query = "
			EXEC HistoriasSolicitadasSeleccionarPorIdAtencion :idAtencion";

		$params = [
			'idAtencion' => $lnIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarIdMovimientoIdPaciente($rsMovimientos)
	{
		$query = "
			EXEC HistoriasSolicitadasEliminarIdMovimientoIdPaciente :idHistoriaSolicitada, :idPaciente";

		$params = [
			'idHistoriaSolicitada' => $rsMovimientos!IdHistoriaSolicitada, 
			'idPaciente' => $rsMovimientos!IdPaciente, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}