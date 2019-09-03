<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CatalogoServiciosGrupo extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idServicioGrupo AS Int = :idServicioGrupo
			SET NOCOUNT ON 
			EXEC FactCatalogoServiciosGrupoAgregar :descripcion, @idServicioGrupo OUTPUT, :idUsuarioAuditoria
			SELECT @idServicioGrupo AS idServicioGrupo";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idServicioGrupo' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactCatalogoServiciosGrupoModificar :descripcion, :idServicioGrupo, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idServicioGrupo' => ($oTabla->idServicioGrupo == 0)? Null: $oTabla->idServicioGrupo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactCatalogoServiciosGrupoEliminar :idServicioGrupo, :idUsuarioAuditoria";

		$params = [
			'idServicioGrupo' => ($oTabla->idServicioGrupo == 0)? Null: $oTabla->idServicioGrupo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FactCatalogoServiciosGrupoSeleccionarPorId :idServicioGrupo";

		$params = [
			'idServicioGrupo' => $oTabla->idServicioGrupo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC FactCatalogoServiciosGrupoSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}