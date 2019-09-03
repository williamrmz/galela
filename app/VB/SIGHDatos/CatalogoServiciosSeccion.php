<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CatalogoServiciosSeccion extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idServicioSeccion AS Int = :idServicioSeccion
			SET NOCOUNT ON 
			EXEC FactCatalogoServiciosSeccionAgregar :codigo, :idServicioGrupo, :descripcion, @idServicioSeccion OUTPUT, :idUsuarioAuditoria
			SELECT @idServicioSeccion AS idServicioSeccion";

		$params = [
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idServicioGrupo' => ($oTabla->idServicioGrupo == 0)? Null: $oTabla->idServicioGrupo, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idServicioSeccion' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactCatalogoServiciosSeccionModificar :codigo, :idServicioGrupo, :descripcion, :idServicioSeccion, :idUsuarioAuditoria";

		$params = [
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idServicioGrupo' => ($oTabla->idServicioGrupo == 0)? Null: $oTabla->idServicioGrupo, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idServicioSeccion' => ($oTabla->idServicioSeccion == 0)? Null: $oTabla->idServicioSeccion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactCatalogoServiciosSeccionEliminar :idServicioSeccion, :idUsuarioAuditoria";

		$params = [
			'idServicioSeccion' => ($oTabla->idServicioSeccion == 0)? Null: $oTabla->idServicioSeccion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FactCatalogoServiciosSeccionSeleccionarPorId :idServicioSeccion";

		$params = [
			'idServicioSeccion' => $oTabla->idServicioSeccion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorSubGrupo($lIdSubGrupo)
	{
		$query = "
			EXEC FactCatalogoServiciosSeccionXidSubGrupo :lIdSubGrupo";

		$params = [
			'lIdSubGrupo' => $lIdSubGrupo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}