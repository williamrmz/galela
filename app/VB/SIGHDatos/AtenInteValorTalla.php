<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenInteValorTalla extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idValorTalla AS Int = :idValorTalla
			SET NOCOUNT ON 
			EXEC AtenInteValorTallaAgregar @idValorTalla OUTPUT, :idTipoSexo, :edadMeses, :nroDesviacion, :valorTalla, :idUsuarioAuditoria
			SELECT @idValorTalla AS idValorTalla";

		$params = [
			'idValorTalla' => 0, 
			'idTipoSexo' => ($oTabla->idTipoSexo == 0)? Null: $oTabla->idTipoSexo, 
			'edadMeses' => ($oTabla->edadMeses == 0)? Null: $oTabla->edadMeses, 
			'nroDesviacion' => ($oTabla->nroDesviacion == 0)? Null: $oTabla->nroDesviacion, 
			'valorTalla' => $oTabla->valorTalla, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtenInteValorTallaModificar :idValorTalla, :idTipoSexo, :edadMeses, :nroDesviacion, :valorTalla, :idUsuarioAuditoria";

		$params = [
			'idValorTalla' => ($oTabla->idValorTalla == 0)? Null: $oTabla->idValorTalla, 
			'idTipoSexo' => ($oTabla->idTipoSexo == 0)? Null: $oTabla->idTipoSexo, 
			'edadMeses' => ($oTabla->edadMeses == 0)? Null: $oTabla->edadMeses, 
			'nroDesviacion' => ($oTabla->nroDesviacion == 0)? Null: $oTabla->nroDesviacion, 
			'valorTalla' => $oTabla->valorTalla, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtenInteValorTallaEliminar :idValorTalla, :idUsuarioAuditoria";

		$params = [
			'idValorTalla' => $oTabla->idValorTalla, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtenInteValorTallaSeleccionarPorId :idValorTalla";

		$params = [
			'idValorTalla' => $oTabla->idValorTalla, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorSexoYDesviacion($oTabla)
	{
		$query = "
			EXEC AtenInteValorTallaPorSexoYDesviacion :inIdTipoSexo, :nroDesviacion";

		$params = [
			'inIdTipoSexo' => $oTabla->idTipoSexo, 
			'nroDesviacion' => $oTabla->nroDesviacion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}