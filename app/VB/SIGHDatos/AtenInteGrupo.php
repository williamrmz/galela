<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenInteGrupo extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idAtenInteGrupo AS Int = :idAtenInteGrupo
			SET NOCOUNT ON 
			EXEC AtenInteGrupoAgregar @idAtenInteGrupo OUTPUT, :atencionIntegralGrupo, :desdeAnio, :desdeMes, :desdeDia, :hastaAnio, :hastaMes, :hastaDia, :idUsuarioAuditoria
			SELECT @idAtenInteGrupo AS idAtenInteGrupo";

		$params = [
			'idAtenInteGrupo' => 0, 
			'atencionIntegralGrupo' => ($oTabla->atencionIntegralGrupo == "")? Null: $oTabla->atencionIntegralGrupo, 
			'desdeAnio' => ($oTabla->desdeAnio == 0)? Null: $oTabla->desdeAnio, 
			'desdeMes' => $oTabla->desdeMes, 
			'desdeDia' => $oTabla->desdeDia, 
			'hastaAnio' => ($oTabla->hastaAnio == 0)? Null: $oTabla->hastaAnio, 
			'hastaMes' => $oTabla->hastaMes, 
			'hastaDia' => $oTabla->hastaDia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtenInteGrupoModificar :idAtenInteGrupo, :atencionIntegralGrupo, :desdeAnio, :desdeMes, :desdeDia, :hastaAnio, :hastaMes, :hastaDia, :idUsuarioAuditoria";

		$params = [
			'idAtenInteGrupo' => $oTabla->idAtenInteGrupo, 
			'atencionIntegralGrupo' => ($oTabla->atencionIntegralGrupo == "")? Null: $oTabla->atencionIntegralGrupo, 
			'desdeAnio' => ($oTabla->desdeAnio == 0)? Null: $oTabla->desdeAnio, 
			'desdeMes' => $oTabla->desdeMes, 
			'desdeDia' => $oTabla->desdeDia, 
			'hastaAnio' => ($oTabla->hastaAnio == 0)? Null: $oTabla->hastaAnio, 
			'hastaMes' => $oTabla->hastaMes, 
			'hastaDia' => $oTabla->hastaDia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtenInteGrupoEliminar :idAtenInteGrupo, :idUsuarioAuditoria";

		$params = [
			'idAtenInteGrupo' => $oTabla->idAtenInteGrupo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtenInteGrupoSeleccionarPorId :idAtenInteGrupo";

		$params = [
			'idAtenInteGrupo' => $oTabla->idAtenInteGrupo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}