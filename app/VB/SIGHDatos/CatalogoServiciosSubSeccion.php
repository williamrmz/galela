<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CatalogoServiciosSubSeccion extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idServicioSubSeccion AS Int = :idServicioSubSeccion
			SET NOCOUNT ON 
			EXEC FactCatalogoServiciosSubSeccionAgregar :codigo, :idServicioSeccion, :descripcion, @idServicioSubSeccion OUTPUT, :idUsuarioAuditoria
			SELECT @idServicioSubSeccion AS idServicioSubSeccion";

		$params = [
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idServicioSeccion' => ($oTabla->idServicioSeccion == 0)? Null: $oTabla->idServicioSeccion, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idServicioSubSeccion' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactCatalogoServiciosSubSeccionModificar :codigo, :idServicioSeccion, :descripcion, :idServicioSubSeccion, :idUsuarioAuditoria";

		$params = [
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idServicioSeccion' => ($oTabla->idServicioSeccion == 0)? Null: $oTabla->idServicioSeccion, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idServicioSubSeccion' => ($oTabla->idServicioSubSeccion == 0)? Null: $oTabla->idServicioSubSeccion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactCatalogoServiciosSubSeccionEliminar :idServicioSubSeccion, :idUsuarioAuditoria";

		$params = [
			'idServicioSubSeccion' => ($oTabla->idServicioSubSeccion == 0)? Null: $oTabla->idServicioSubSeccion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FactCatalogoServiciosSubSeccionSeleccionarPorId :idServicioSubSeccion";

		$params = [
			'idServicioSubSeccion' => $oTabla->idServicioSubSeccion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorSeccion($lIdSeccion)
	{
		$query = "
			EXEC FactCatalogoServiciosSubSeccionXidSeccion :lIdSeccion";

		$params = [
			'lIdSeccion' => $lIdSeccion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}