<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class LabItemsGrupos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC LabItemsGruposAgregar :idItemGrupo, :grupo, :idUsuarioAuditoria";

		$params = [
			'idItemGrupo' => ($oTabla->idItemGrupo == 0)? Null: $oTabla->idItemGrupo, 
			'grupo' => ($oTabla->grupo == "")? Null: $oTabla->grupo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC LabItemsGruposModificar :idItemGrupo, :grupo, :idUsuarioAuditoria";

		$params = [
			'idItemGrupo' => ($oTabla->idItemGrupo == 0)? Null: $oTabla->idItemGrupo, 
			'grupo' => ($oTabla->grupo == "")? Null: $oTabla->grupo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC LabItemsGruposEliminar :idItemGrupo, :idUsuarioAuditoria";

		$params = [
			'idItemGrupo' => $oTabla->idItemGrupo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC LabItemsGruposSeleccionarPorId :idItemGrupo";

		$params = [
			'idItemGrupo' => $oTabla->idItemGrupo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos($wcriterio)
	{
		$query = "
			EXEC LabItemsGruposSeleccionarTodos :filtro";

		$params = [
			'filtro' => $wcriterio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}