<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CuentasEpisodioAtencion extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idEpisodioAtencion AS Int = :idEpisodioAtencion
			SET NOCOUNT ON 
			EXEC CuentasEpisodioAtencionAgregar :fechaAlta, :fechaIngreso, @idEpisodioAtencion OUTPUT, :idUsuarioAuditoria
			SELECT @idEpisodioAtencion AS idEpisodioAtencion";

		$params = [
			'fechaAlta' => ($oTabla->fechaAlta == 0)? Null: $oTabla->fechaAlta, 
			'fechaIngreso' => ($oTabla->fechaIngreso == 0)? Null: $oTabla->fechaIngreso, 
			'idEpisodioAtencion' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CuentasEpisodioAtencionModificar :fechaAlta, :fechaIngreso, :idEpisodioAtencion, :idUsuarioAuditoria";

		$params = [
			'fechaAlta' => ($oTabla->fechaAlta == 0)? Null: $oTabla->fechaAlta, 
			'fechaIngreso' => ($oTabla->fechaIngreso == 0)? Null: $oTabla->fechaIngreso, 
			'idEpisodioAtencion' => ($oTabla->idEpisodioAtencion == 0)? Null: $oTabla->idEpisodioAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CuentasEpisodioAtencionEliminar :idEpisodioAtencion, :idUsuarioAuditoria";

		$params = [
			'idEpisodioAtencion' => ($oTabla->idEpisodioAtencion == 0)? Null: $oTabla->idEpisodioAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CuentasEpisodioAtencionSeleccionarPorId :idEpisodioAtencion";

		$params = [
			'idEpisodioAtencion' => $oTabla->idEpisodioAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarPorIdCuentaAtencion($lIdCuentaAtencion)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}