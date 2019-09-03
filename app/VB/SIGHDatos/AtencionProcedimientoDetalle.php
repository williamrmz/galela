<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtencionProcedimientoDetalle extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idAtencionProcDetalle AS Int = :idAtencionProcDetalle
			SET NOCOUNT ON 
			EXEC AtencionProcedimientoDetalleAgregar :idAtencionProcedimiento, :idFacturacionServicio, :idMedicoRealiza, :idServicioRealiza, :idProcedimiento, :horaRealizacion, :fechaRealizacion, @idAtencionProcDetalle OUTPUT, :idUsuarioAuditoria
			SELECT @idAtencionProcDetalle AS idAtencionProcDetalle";

		$params = [
			'idAtencionProcedimiento' => ($oTabla->idAtencionProcedimiento == 0)? Null: $oTabla->idAtencionProcedimiento, 
			'idFacturacionServicio' => ($oTabla->idFacturacionServicio == 0)? Null: $oTabla->idFacturacionServicio, 
			'idMedicoRealiza' => ($oTabla->idMedicoRealiza == 0)? Null: $oTabla->idMedicoRealiza, 
			'idServicioRealiza' => ($oTabla->idServicioRealiza == 0)? Null: $oTabla->idServicioRealiza, 
			'idProcedimiento' => ($oTabla->idProcedimiento == 0)? Null: $oTabla->idProcedimiento, 
			'horaRealizacion' => ($oTabla->horaRealizacion == "")? Null: $oTabla->horaRealizacion, 
			'fechaRealizacion' => ($oTabla->fechaRealizacion == 0)? Null: $oTabla->fechaRealizacion, 
			'idAtencionProcDetalle' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtencionProcedimientoDetalleModificar :idAtencionProcedimiento, :idFacturacionServicio, :idMedicoRealiza, :idServicioRealiza, :idProcedimiento, :horaRealizacion, :fechaRealizacion, :idAtencionProcDetalle, :idUsuarioAuditoria";

		$params = [
			'idAtencionProcedimiento' => ($oTabla->idAtencionProcedimiento == 0)? Null: $oTabla->idAtencionProcedimiento, 
			'idFacturacionServicio' => ($oTabla->idFacturacionServicio == 0)? Null: $oTabla->idFacturacionServicio, 
			'idMedicoRealiza' => ($oTabla->idMedicoRealiza == 0)? Null: $oTabla->idMedicoRealiza, 
			'idServicioRealiza' => ($oTabla->idServicioRealiza == 0)? Null: $oTabla->idServicioRealiza, 
			'idProcedimiento' => ($oTabla->idProcedimiento == 0)? Null: $oTabla->idProcedimiento, 
			'horaRealizacion' => ($oTabla->horaRealizacion == "")? Null: $oTabla->horaRealizacion, 
			'fechaRealizacion' => ($oTabla->fechaRealizacion == 0)? Null: $oTabla->fechaRealizacion, 
			'idAtencionProcDetalle' => ($oTabla->idAtencionProcDetalle == 0)? Null: $oTabla->idAtencionProcDetalle, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtencionProcedimientoDetalleEliminar :idAtencionProcDetalle, :idUsuarioAuditoria";

		$params = [
			'idAtencionProcDetalle' => ($oTabla->idAtencionProcDetalle == 0)? Null: $oTabla->idAtencionProcDetalle, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtencionProcedimientoDetalleSeleccionarPorId :idAtencionProcDetalle";

		$params = [
			'idAtencionProcDetalle' => $oTabla->idAtencionProcDetalle, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdAtencionProcedimiento($lIdAtencionProcedimiento)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oTabla)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarPorIdAtencionProcedimiento($lIdAtencionProcedimiento)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}