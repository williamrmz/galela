<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtencionApoyoDiagDetalle extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idAtencionApoyoDetalle AS Int = :idAtencionApoyoDetalle
			SET NOCOUNT ON 
			EXEC AtencionApoyoDiagDetalleAgregar :idFacturacionServicio, :horaResultado, :fechaResultado, :idServicioRealiza, :idProcedimiento, :idAtencionApoyoDx, @idAtencionApoyoDetalle OUTPUT, :idUsuarioAuditoria
			SELECT @idAtencionApoyoDetalle AS idAtencionApoyoDetalle";

		$params = [
			'idFacturacionServicio' => ($oTabla->idFacturacionServicio == 0)? Null: $oTabla->idFacturacionServicio, 
			'horaResultado' => ($oTabla->horaResultado == "")? Null: $oTabla->horaResultado, 
			'fechaResultado' => ($oTabla->fechaResultado == 0)? Null: $oTabla->fechaResultado, 
			'idServicioRealiza' => ($oTabla->idServicioRealiza == 0)? Null: $oTabla->idServicioRealiza, 
			'idProcedimiento' => ($oTabla->idProcedimiento == 0)? Null: $oTabla->idProcedimiento, 
			'idAtencionApoyoDx' => ($oTabla->idAtencionApoyoDx == 0)? Null: $oTabla->idAtencionApoyoDx, 
			'idAtencionApoyoDetalle' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtencionApoyoDiagDetalleModificar :idFacturacionServicio, :horaResultado, :fechaResultado, :idServicioRealiza, :idProcedimiento, :idAtencionApoyoDx, :idAtencionApoyoDetalle, :idUsuarioAuditoria";

		$params = [
			'idFacturacionServicio' => ($oTabla->idFacturacionServicio == 0)? Null: $oTabla->idFacturacionServicio, 
			'horaResultado' => ($oTabla->horaResultado == "")? Null: $oTabla->horaResultado, 
			'fechaResultado' => ($oTabla->fechaResultado == 0)? Null: $oTabla->fechaResultado, 
			'idServicioRealiza' => ($oTabla->idServicioRealiza == 0)? Null: $oTabla->idServicioRealiza, 
			'idProcedimiento' => ($oTabla->idProcedimiento == 0)? Null: $oTabla->idProcedimiento, 
			'idAtencionApoyoDx' => ($oTabla->idAtencionApoyoDx == 0)? Null: $oTabla->idAtencionApoyoDx, 
			'idAtencionApoyoDetalle' => ($oTabla->idAtencionApoyoDetalle == 0)? Null: $oTabla->idAtencionApoyoDetalle, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtencionApoyoDiagDetalleEliminar :idAtencionApoyoDetalle, :idUsuarioAuditoria";

		$params = [
			'idAtencionApoyoDetalle' => ($oTabla->idAtencionApoyoDetalle == 0)? Null: $oTabla->idAtencionApoyoDetalle, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtencionApoyoDiagDetalleSeleccionarPorId :idAtencionApoyoDetalle";

		$params = [
			'idAtencionApoyoDetalle' => $oTabla->idAtencionApoyoDetalle, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdAtencionApoyoDx($idPreFacturacionApoyo)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarPorIdPreFacturacionApoyoDiagnostico($lIdPreFacturacionApoyo)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}