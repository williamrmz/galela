<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FactPuntosCargaServicio extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPuntoCargaServicio AS Int = :idPuntoCargaServicio
			SET NOCOUNT ON 
			EXEC FactPuntosCargaServicioAgregar :idServicioSubGrupo, :idPuntoCarga, @idPuntoCargaServicio OUTPUT, :idUsuarioAuditoria
			SELECT @idPuntoCargaServicio AS idPuntoCargaServicio";

		$params = [
			'idServicioSubGrupo' => ($oTabla->idServicioSubGrupo == 0)? Null: $oTabla->idServicioSubGrupo, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idPuntoCargaServicio' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactPuntosCargaServicioModificar :idServicioSubGrupo, :idPuntoCarga, :idPuntoCargaServicio, :idUsuarioAuditoria";

		$params = [
			'idServicioSubGrupo' => ($oTabla->idServicioSubGrupo == 0)? Null: $oTabla->idServicioSubGrupo, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idPuntoCargaServicio' => ($oTabla->idPuntoCargaServicio == 0)? Null: $oTabla->idPuntoCargaServicio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactPuntosCargaServicioEliminar :idPuntoCargaServicio, :idUsuarioAuditoria";

		$params = [
			'idPuntoCargaServicio' => ($oTabla->idPuntoCargaServicio == 0)? Null: $oTabla->idPuntoCargaServicio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FactPuntosCargaServicioSeleccionarPorId :idPuntoCargaServicio";

		$params = [
			'idPuntoCargaServicio' => $oTabla->idPuntoCargaServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}