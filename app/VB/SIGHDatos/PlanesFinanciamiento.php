<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class PlanesFinanciamiento extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPlanFinanciamiento AS Int = :idPlanFinanciamiento
			SET NOCOUNT ON 
			EXEC PlanesFinanciamientoAgregar :idPlan, :idFuenteFinanciamiento, :idTipoFinanciamiento, @idPlanFinanciamiento OUTPUT, :idUsuarioAuditoria
			SELECT @idPlanFinanciamiento AS idPlanFinanciamiento";

		$params = [
			'idPlan' => ($oTabla->idPlan == 0)? Null: $oTabla->idPlan, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idPlanFinanciamiento' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC PlanesFinanciamientoModificar :idPlan, :idFuenteFinanciamiento, :idTipoFinanciamiento, :idPlanFinanciamiento, :idUsuarioAuditoria";

		$params = [
			'idPlan' => ($oTabla->idPlan == 0)? Null: $oTabla->idPlan, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
			'idPlanFinanciamiento' => ($oTabla->idPlanFinanciamiento == 0)? Null: $oTabla->idPlanFinanciamiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC PlanesFinanciamientoEliminar :idPlanFinanciamiento, :idUsuarioAuditoria";

		$params = [
			'idPlanFinanciamiento' => ($oTabla->idPlanFinanciamiento == 0)? Null: $oTabla->idPlanFinanciamiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC PlanesFinanciamientoSeleccionarPorId :idPlanFinanciamiento";

		$params = [
			'idPlanFinanciamiento' => $oTabla->idPlanFinanciamiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarPorIdPlan($lIdPlan)
	{
		$query = "
			EXEC PlanesFinanciamientoEliminarPorIdPlan :idPlan";

		$params = [
			'idPlan' => $lIdPlan, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorIdPlan($lIdPlan)
	{
		$query = "
			EXEC PlanesFinanciamientoSeleccionarPorIdPlan :idPlan";

		$params = [
			'idPlan' => $lIdPlan, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorTipoFinanciamiento($lIdTipoFinanciamiento)
	{
		$query = "
			EXEC PlanesFinanciamientoSeleccionarPorTipoFinanciamiento :lIdTipoFinanciamiento";

		$params = [
			'lIdTipoFinanciamiento' => ($lIdTipoFinanciamiento == 0)? Null: $lIdTipoFinanciamiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorTipoYFuenteFinanciamiento($lIdTipoFinanciamiento, $lIdFuenteFinanciamiento)
	{
		$query = "
			EXEC PlanesFinanciamientoSeleccionarPorTipoYFuenteFinan :lIdTipoFinanciamiento, :lIdFuenteFinanciamiento";

		$params = [
			'lIdTipoFinanciamiento' => ($lIdTipoFinanciamiento == 0)? Null: $lIdTipoFinanciamiento, 
			'lIdFuenteFinanciamiento' => ($lIdFuenteFinanciamiento == 0)? Null: $lIdFuenteFinanciamiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}