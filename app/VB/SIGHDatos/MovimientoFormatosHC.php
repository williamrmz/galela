<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class MovimientoFormatosHC extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idMovimiento AS Int = :idMovimiento
			SET NOCOUNT ON 
			EXEC MovimientosFormatosHistoriaClinicaAgregar @idMovimiento OUTPUT, :idPaciente, :fechaMovimiento, :idMotivo, :observacion, :idServicioOrigen, :idServicioDestino, :nroFolios, :idEmpleadoArchivo, :idEmpleadoTransporte, :idEmpleadoRecepcion, :idGrupoMovimiento, :idAtencion, :idUsuarioAuditoria
			SELECT @idMovimiento AS idMovimiento";

		$params = [
			'idMovimiento' => 0, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'fechaMovimiento' => ($oTabla->fechaMovimiento == 0)? Null: $oTabla->fechaMovimiento, 
			'idMotivo' => ($oTabla->idMotivo == 0)? Null: $oTabla->idMotivo, 
			'observacion' => ($oTabla->observacion == "")? Null: $oTabla->observacion, 
			'idServicioOrigen' => ($oTabla->idServicioOrigen == 0)? Null: $oTabla->idServicioOrigen, 
			'idServicioDestino' => ($oTabla->idServicioDestino == 0)? Null: $oTabla->idServicioDestino, 
			'nroFolios' => ($oTabla->nroFolios == 0)? Null: $oTabla->nroFolios, 
			'idEmpleadoArchivo' => ($oTabla->idEmpleadoArchivo == 0)? Null: $oTabla->idEmpleadoArchivo, 
			'idEmpleadoTransporte' => ($oTabla->idEmpleadoTransporte == 0)? Null: $oTabla->idEmpleadoTransporte, 
			'idEmpleadoRecepcion' => ($oTabla->idEmpleadoRecepcion == 0)? Null: $oTabla->idEmpleadoRecepcion, 
			'idGrupoMovimiento' => ($oTabla->idGrupoMovimiento == 0)? Null: $oTabla->idGrupoMovimiento, 
			'idAtencion' => ($oTabla->idatencion == 0)? Null: $oTabla->idatencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC MovimientosFormatosHistoriaClinicaModificar :idMovimiento, :idPaciente, :fechaMovimiento, :idMotivo, :observacion, :idServicioOrigen, :idServicioDestino, :nroFolios, :idEmpleadoArchivo, :idEmpleadoTransporte, :idEmpleadoRecepcion, :idGrupoMovimiento, :idAtencion, :idUsuarioAuditoria";

		$params = [
			'idMovimiento' => ($oTabla->idMovimiento == 0)? Null: $oTabla->idMovimiento, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'fechaMovimiento' => ($oTabla->fechaMovimiento == 0)? Null: $oTabla->fechaMovimiento, 
			'idMotivo' => ($oTabla->idMotivo == 0)? Null: $oTabla->idMotivo, 
			'observacion' => ($oTabla->observacion == "")? Null: $oTabla->observacion, 
			'idServicioOrigen' => ($oTabla->idServicioOrigen == 0)? Null: $oTabla->idServicioOrigen, 
			'idServicioDestino' => ($oTabla->idServicioDestino == 0)? Null: $oTabla->idServicioDestino, 
			'nroFolios' => ($oTabla->nroFolios == 0)? Null: $oTabla->nroFolios, 
			'idEmpleadoArchivo' => ($oTabla->idEmpleadoArchivo == 0)? Null: $oTabla->idEmpleadoArchivo, 
			'idEmpleadoTransporte' => ($oTabla->idEmpleadoTransporte == 0)? Null: $oTabla->idEmpleadoTransporte, 
			'idEmpleadoRecepcion' => ($oTabla->idEmpleadoRecepcion == 0)? Null: $oTabla->idEmpleadoRecepcion, 
			'idGrupoMovimiento' => ($oTabla->idGrupoMovimiento == 0)? Null: $oTabla->idGrupoMovimiento, 
			'idAtencion' => ($oTabla->idatencion == 0)? Null: $oTabla->idatencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC MovimientosFormatosHistoriaClinicaEliminar :idMovimiento, :idUsuarioAuditoria";

		$params = [
			'idMovimiento' => $oTabla->idMovimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC MovimientosFormatosHistoriaClinicaSeleccionarPorId :idMovimiento";

		$params = [
			'idMovimiento' => $oTabla->idMovimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AgregarVarios($oMovimiento, $rsMovimientos)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ModificarVarios($oMovimiento, $rsMovimientos)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarVarios($rsMovimientos)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oDOPaciente, $oDOHistoria)
	{
		$query = "
			EXEC MovimientosFormatosHistoriaClinicaFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function MovimientosFormatosHCPorIdGrupo($lIdGrupo)
	{
		$query = "
			EXEC MovimientosFormatosHCPorIdGrupo :idGrupo";

		$params = [
			'idGrupo' => $lIdGrupo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}