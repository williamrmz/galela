<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtencionesProcedimientos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idAtencionProcedimiento AS Int = :idAtencionProcedimiento
			SET NOCOUNT ON 
			EXEC AtencionesProcedimientosAgregar :nroOrden, :idMedicoRealiza, :idServicioRealiza, :idDetalleProducto, :idCuentaAtencion, :horaRealizacion, :fechaRealizacion, :idProcedimiento, @idAtencionProcedimiento OUTPUT, :idUsuarioAuditoria
			SELECT @idAtencionProcedimiento AS idAtencionProcedimiento";

		$params = [
			'nroOrden' => ($oTabla->nroOrden == "")? Null: $oTabla->nroOrden, 
			'idMedicoRealiza' => ($oTabla->idMedicoRealiza == 0)? Null: $oTabla->idMedicoRealiza, 
			'idServicioRealiza' => ($oTabla->idServicioRealiza == 0)? Null: $oTabla->idServicioRealiza, 
			'idDetalleProducto' => ($oTabla->idDetalleProducto == 0)? Null: $oTabla->idDetalleProducto, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'horaRealizacion' => ($oTabla->horaRealizacion == "")? Null: $oTabla->horaRealizacion, 
			'fechaRealizacion' => ($oTabla->fechaRealizacion == 0)? Null: $oTabla->fechaRealizacion, 
			'idProcedimiento' => ($oTabla->idProcedimiento == 0)? Null: $oTabla->idProcedimiento, 
			'idAtencionProcedimiento' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtencionesProcedimientosModificar :nroOrden, :idMedicoRealiza, :idServicioRealiza, :idDetalleProducto, :idCuentaAtencion, :horaRealizacion, :fechaRealizacion, :idProcedimiento, :idAtencionProcedimiento, :idUsuarioAuditoria";

		$params = [
			'nroOrden' => ($oTabla->nroOrden == "")? Null: $oTabla->nroOrden, 
			'idMedicoRealiza' => ($oTabla->idMedicoRealiza == 0)? Null: $oTabla->idMedicoRealiza, 
			'idServicioRealiza' => ($oTabla->idServicioRealiza == 0)? Null: $oTabla->idServicioRealiza, 
			'idDetalleProducto' => ($oTabla->idDetalleProducto == 0)? Null: $oTabla->idDetalleProducto, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'horaRealizacion' => ($oTabla->horaRealizacion == "")? Null: $oTabla->horaRealizacion, 
			'fechaRealizacion' => ($oTabla->fechaRealizacion == 0)? Null: $oTabla->fechaRealizacion, 
			'idProcedimiento' => ($oTabla->idProcedimiento == 0)? Null: $oTabla->idProcedimiento, 
			'idAtencionProcedimiento' => ($oTabla->idAtencionProcedimiento == 0)? Null: $oTabla->idAtencionProcedimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtencionesProcedimientosEliminar :idAtencionProcedimiento, :idUsuarioAuditoria";

		$params = [
			'idAtencionProcedimiento' => ($oTabla->idAtencionProcedimiento == 0)? Null: $oTabla->idAtencionProcedimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtencionesProcedimientosSeleccionarPorId :idAtencionProcedimiento";

		$params = [
			'idAtencionProcedimiento' => $oTabla->idAtencionProcedimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCuentaAtencionSinIterconsultas($lIdCuentaAtencion)
	{
		$query = "
			EXEC AtencionesProcedimientosSeleccionarPorCuentaAtencionSinInterconsulta :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $lIdCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCuentaAtencionEIterconsulta($lIdCuentaAtencion, $lIdInterconsulta)
	{
		$query = "
			EXEC AtencionesProcedimientosSeleccionarPorCuentaAtencionEInterconsulta :idCuentaAtencion, :idInterconsulta";

		$params = [
			'idCuentaAtencion' => $lIdCuentaAtencion, 
			'idInterconsulta' => $lIdInterconsulta, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizarProcedimientosAtencion($oProcedimientos, $lIdCuentaAtencion)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizarProcedimientosInterconsultas($oProcedimientos, $lIdCuentaAtencion, $lIdInterconsulta)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarProcedimientosPorCuentaAtencion($lIdCuentaAtencion)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}