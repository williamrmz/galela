<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenIntePlanAtencion extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPlanAtencion AS Int = :idPlanAtencion
			SET NOCOUNT ON 
			EXEC AtenIntePlanAtencionAgregar @idPlanAtencion OUTPUT, :idAtenInteGrupo, :idPeriodoTiempo, :edadAnio, :edadMes, :edadDia, :descripcion, :idUsuarioAuditoria
			SELECT @idPlanAtencion AS idPlanAtencion";

		$params = [
			'idPlanAtencion' => 0, 
			'idAtenInteGrupo' => $oTabla->idAtenInteGrupo, 
			'idPeriodoTiempo' => $oTabla->idPeriodoTiempo, 
			'edadAnio' => ($oTabla->edadAnio == 0)? Null: $oTabla->edadAnio, 
			'edadMes' => $oTabla->edadMes, 
			'edadDia' => $oTabla->edadDia, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtenIntePlanAtencionModificar :idPlanAtencion, :idAtenInteGrupo, :idPeriodoTiempo, :edadAnio, :edadMes, :edadDia, :descripcion, :idUsuarioAuditoria";

		$params = [
			'idPlanAtencion' => ($oTabla->idPlanAtencion == 0)? Null: $oTabla->idPlanAtencion, 
			'idAtenInteGrupo' => $oTabla->idAtenInteGrupo, 
			'idPeriodoTiempo' => $oTabla->idPeriodoTiempo, 
			'edadAnio' => ($oTabla->edadAnio == 0)? Null: $oTabla->edadAnio, 
			'edadMes' => $oTabla->edadMes, 
			'edadDia' => $oTabla->edadDia, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtenIntePlanAtencionEliminar :idPlanAtencion, :idUsuarioAuditoria";

		$params = [
			'idPlanAtencion' => $oTabla->idPlanAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtenIntePlanAtencionSeleccionarPorId :idPlanAtencion";

		$params = [
			'idPlanAtencion' => $oTabla->idPlanAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}