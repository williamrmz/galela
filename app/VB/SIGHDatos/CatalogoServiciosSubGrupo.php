<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CatalogoServiciosSubGrupo extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idServicioSubGrupo AS Int = :idServicioSubGrupo
			SET NOCOUNT ON 
			EXEC FactCatalogoServiciosSubGrupoAgregar :codigo, :idServicioGrupo, :descripcion, @idServicioSubGrupo OUTPUT, :idUsuarioAuditoria
			SELECT @idServicioSubGrupo AS idServicioSubGrupo";

		$params = [
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idServicioGrupo' => ($oTabla->idServicioGrupo == 0)? Null: $oTabla->idServicioGrupo, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idServicioSubGrupo' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactCatalogoServiciosSubGrupoModificar :codigo, :idServicioGrupo, :descripcion, :idServicioSubGrupo, :idUsuarioAuditoria";

		$params = [
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idServicioGrupo' => ($oTabla->idServicioGrupo == 0)? Null: $oTabla->idServicioGrupo, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idServicioSubGrupo' => ($oTabla->idServicioSubGrupo == 0)? Null: $oTabla->idServicioSubGrupo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactCatalogoServiciosSubGrupoEliminar :idServicioSubGrupo, :idUsuarioAuditoria";

		$params = [
			'idServicioSubGrupo' => ($oTabla->idServicioSubGrupo == 0)? Null: $oTabla->idServicioSubGrupo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FactCatalogoServiciosSubGrupoSeleccionarPorId :idServicioSubGrupo";

		$params = [
			'idServicioSubGrupo' => $oTabla->idServicioSubGrupo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC FactCatalogoServiciosSubGrupoSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorGrupo($lIdGrupo)
	{
		$query = "
			EXEC FactCatalogoServiciosSubGrupoXidGrupo :lIdGrupo";

		$params = [
			'lIdGrupo' => $lIdGrupo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}