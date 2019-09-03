<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenInteValorPeso extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idValorPeso AS Int = :idValorPeso
			SET NOCOUNT ON 
			EXEC AtenInteValorPesoAgregar @idValorPeso OUTPUT, :idTipoSexo, :edadMeses, :nroDesviacion, :valorPeso, :idUsuarioAuditoria
			SELECT @idValorPeso AS idValorPeso";

		$params = [
			'idValorPeso' => 0, 
			'idTipoSexo' => ($oTabla->idTipoSexo == 0)? Null: $oTabla->idTipoSexo, 
			'edadMeses' => ($oTabla->edadMeses == 0)? Null: $oTabla->edadMeses, 
			'nroDesviacion' => ($oTabla->nroDesviacion == 0)? Null: $oTabla->nroDesviacion, 
			'valorPeso' => $oTabla->valorPeso, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtenInteValorPesoModificar :idValorPeso, :idTipoSexo, :edadMeses, :nroDesviacion, :valorPeso, :idUsuarioAuditoria";

		$params = [
			'idValorPeso' => ($oTabla->idValorPeso == 0)? Null: $oTabla->idValorPeso, 
			'idTipoSexo' => ($oTabla->idTipoSexo == 0)? Null: $oTabla->idTipoSexo, 
			'edadMeses' => ($oTabla->edadMeses == 0)? Null: $oTabla->edadMeses, 
			'nroDesviacion' => ($oTabla->nroDesviacion == 0)? Null: $oTabla->nroDesviacion, 
			'valorPeso' => $oTabla->valorPeso, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtenInteValorPesoEliminar :idValorPeso, :idUsuarioAuditoria";

		$params = [
			'idValorPeso' => $oTabla->idValorPeso, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtenInteValorPesoSeleccionarPorId :idValorPeso";

		$params = [
			'idValorPeso' => $oTabla->idValorPeso, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorSexoYDesviacion($oTabla)
	{
		$query = "
			EXEC AtenInteValorPesoPorSexoYDesviacion :inIdTipoSexo, :nroDesviacion";

		$params = [
			'inIdTipoSexo' => $oTabla->idTipoSexo, 
			'nroDesviacion' => $oTabla->nroDesviacion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}