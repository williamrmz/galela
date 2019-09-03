<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class InsumosGrupoFarmacologico extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idGrupoFarmacologico AS Int = :idGrupoFarmacologico
			SET NOCOUNT ON 
			EXEC FactInsumosGrupoFarmacologicoAgregar :descripcion, @idGrupoFarmacologico OUTPUT, :idUsuarioAuditoria
			SELECT @idGrupoFarmacologico AS idGrupoFarmacologico";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idGrupoFarmacologico' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactInsumosGrupoFarmacologicoModificar :descripcion, :idGrupoFarmacologico, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idGrupoFarmacologico' => ($oTabla->idGrupoFarmacologico == 0)? Null: $oTabla->idGrupoFarmacologico, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactInsumosGrupoFarmacologicoEliminar :idGrupoFarmacologico, :idUsuarioAuditoria";

		$params = [
			'idGrupoFarmacologico' => ($oTabla->idGrupoFarmacologico == 0)? Null: $oTabla->idGrupoFarmacologico, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FactInsumosGrupoFarmacologicoSeleccionarPorId :idGrupoFarmacologico";

		$params = [
			'idGrupoFarmacologico' => $oTabla->idGrupoFarmacologico, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC FactInsumosGrupoFarmacologicoSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}