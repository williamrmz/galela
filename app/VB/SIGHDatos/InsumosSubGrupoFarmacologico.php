<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class InsumosSubGrupoFarmacologico extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idGrupoFarmacologico AS Int = :idGrupoFarmacologico
			DECLARE @idSubGrupoFarmacologico AS Int = :idSubGrupoFarmacologico
			SET NOCOUNT ON 
			EXEC FactInsumosSubGrupoFarmacologicoAgregar @idGrupoFarmacologico OUTPUT, :descripcion, @idSubGrupoFarmacologico OUTPUT, :idUsuarioAuditoria
			SELECT @idGrupoFarmacologico AS idGrupoFarmacologico, @idSubGrupoFarmacologico AS idSubGrupoFarmacologico";

		$params = [
			'idGrupoFarmacologico' => 0, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idSubGrupoFarmacologico' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactInsumosSubGrupoFarmacologicoModificar :idGrupoFarmacologico, :descripcion, :idSubGrupoFarmacologico, :idUsuarioAuditoria";

		$params = [
			'idGrupoFarmacologico' => ($oTabla->idGrupoFarmacologico == 0)? Null: $oTabla->idGrupoFarmacologico, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idSubGrupoFarmacologico' => ($oTabla->idSubGrupoFarmacologico == 0)? Null: $oTabla->idSubGrupoFarmacologico, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactInsumosSubGrupoFarmacologicoEliminar :idGrupoFarmacologico, :idSubGrupoFarmacologico, :idUsuarioAuditoria";

		$params = [
			'idGrupoFarmacologico' => ($oTabla->idGrupoFarmacologico == 0)? Null: $oTabla->idGrupoFarmacologico, 
			'idSubGrupoFarmacologico' => ($oTabla->idSubGrupoFarmacologico == 0)? Null: $oTabla->idSubGrupoFarmacologico, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FactInsumosSubGrupoFarmacologicoSeleccionarPorId :idGrupoFarmacologico, :idSubGrupoFarmacologico";

		$params = [
			'idGrupoFarmacologico' => $oTabla->idGrupoFarmacologico, 
			'idSubGrupoFarmacologico' => $oTabla->idSubGrupoFarmacologico, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorGrupo($lIdGrupoFarmacologico)
	{
		$query = "
			EXEC FactInsumosSubGrupoFarmacologicoXIdGrupoFarmacologico :lIdGrupoFarmacologico";

		$params = [
			'lIdGrupoFarmacologico' => $lIdGrupoFarmacologico, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}