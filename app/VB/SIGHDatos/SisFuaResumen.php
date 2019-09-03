<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class SisFuaResumen extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idResumen AS Int = :idResumen
			SET NOCOUNT ON 
			EXEC SisFuaResumenAgregar @idResumen OUTPUT, :anio, :mes, :nroEnvio, :nomPaquete, :versionGTI, :cantFilATE, :cantFilSMI, :cantFilDIA, :cantFilMED, :cantFilINS, :cantFilPRO, :cantFilUSU, :idUsuarioAuditoria
			SELECT @idResumen AS idResumen";

		$params = [
			'idResumen' => 0, 
			'anio' => ($oTabla->anio == "")? Null: $oTabla->anio, 
			'mes' => ($oTabla->mes == "")? Null: $oTabla->mes, 
			'nroEnvio' => ($oTabla->nroEnvio == "")? Null: $oTabla->nroEnvio, 
			'nomPaquete' => ($oTabla->nomPaquete == "")? Null: $oTabla->nomPaquete, 
			'versionGTI' => ($oTabla->versionGTI == "")? Null: $oTabla->versionGTI, 
			'cantFilATE' => ($oTabla->cantFilATE == 0)? Null: $oTabla->cantFilATE, 
			'cantFilSMI' => ($oTabla->cantFilSMI == 0)? Null: $oTabla->cantFilSMI, 
			'cantFilDIA' => ($oTabla->cantFilDIA == 0)? Null: $oTabla->cantFilDIA, 
			'cantFilMED' => ($oTabla->cantFilMED == 0)? Null: $oTabla->cantFilMED, 
			'cantFilINS' => ($oTabla->cantFilINS == 0)? Null: $oTabla->cantFilINS, 
			'cantFilPRO' => ($oTabla->cantFilPRO == 0)? Null: $oTabla->cantFilPRO, 
			'cantFilUSU' => ($oTabla->cantFilUSU == 0)? Null: $oTabla->cantFilUSU, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC SisFuaResumenModificar :idResumen, :anio, :mes, :nroEnvio, :nomPaquete, :versionGTI, :cantFilATE, :cantFilSMI, :cantFilDIA, :cantFilMED, :cantFilINS, :cantFilPRO, :cantFilUSU, :idUsuarioAuditoria";

		$params = [
			'idResumen' => ($oTabla->idResumen == 0)? Null: $oTabla->idResumen, 
			'anio' => ($oTabla->anio == "")? Null: $oTabla->anio, 
			'mes' => ($oTabla->mes == "")? Null: $oTabla->mes, 
			'nroEnvio' => ($oTabla->nroEnvio == "")? Null: $oTabla->nroEnvio, 
			'nomPaquete' => ($oTabla->nomPaquete == "")? Null: $oTabla->nomPaquete, 
			'versionGTI' => ($oTabla->versionGTI == "")? Null: $oTabla->versionGTI, 
			'cantFilATE' => ($oTabla->cantFilATE == 0)? Null: $oTabla->cantFilATE, 
			'cantFilSMI' => ($oTabla->cantFilSMI == 0)? Null: $oTabla->cantFilSMI, 
			'cantFilDIA' => ($oTabla->cantFilDIA == 0)? Null: $oTabla->cantFilDIA, 
			'cantFilMED' => ($oTabla->cantFilMED == 0)? Null: $oTabla->cantFilMED, 
			'cantFilINS' => ($oTabla->cantFilINS == 0)? Null: $oTabla->cantFilINS, 
			'cantFilPRO' => ($oTabla->cantFilPRO == 0)? Null: $oTabla->cantFilPRO, 
			'cantFilUSU' => ($oTabla->cantFilUSU == 0)? Null: $oTabla->cantFilUSU, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC SisFuaResumenEliminar :idResumen, :idUsuarioAuditoria";

		$params = [
			'idResumen' => $oTabla->idResumen, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC SisFuaResumenSeleccionarPorId :idResumen";

		$params = [
			'idResumen' => $oTabla->idResumen, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}