<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class PeriodoTiempo extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPeriodoTiempo AS TinyInt = :idPeriodoTiempo
			SET NOCOUNT ON 
			EXEC PeriodoTiempoAgregar @idPeriodoTiempo OUTPUT, :periodoTiempo, :idUsuarioAuditoria
			SELECT @idPeriodoTiempo AS idPeriodoTiempo";

		$params = [
			'idPeriodoTiempo' => 0, 
			'periodoTiempo' => ($oTabla->periodoTiempo == "")? Null: $oTabla->periodoTiempo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC PeriodoTiempoModificar :idPeriodoTiempo, :periodoTiempo, :idUsuarioAuditoria";

		$params = [
			'idPeriodoTiempo' => $oTabla->idPeriodoTiempo, 
			'periodoTiempo' => ($oTabla->periodoTiempo == "")? Null: $oTabla->periodoTiempo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC PeriodoTiempoEliminar :idPeriodoTiempo, :idUsuarioAuditoria";

		$params = [
			'idPeriodoTiempo' => $oTabla->idPeriodoTiempo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC PeriodoTiempoSeleccionarPorId :idPeriodoTiempo";

		$params = [
			'idPeriodoTiempo' => $oTabla->idPeriodoTiempo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}