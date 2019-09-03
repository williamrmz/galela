<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class HIS_TipoAtencion extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idHisTipoAtencion AS Int = :idHisTipoAtencion
			SET NOCOUNT ON 
			EXEC HIS_TipoAtencionAgregar @idHisTipoAtencion OUTPUT, :codigo, :descripcion, :idUsuarioAuditoria
			SELECT @idHisTipoAtencion AS idHisTipoAtencion";

		$params = [
			'idHisTipoAtencion' => 0, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC HIS_TipoAtencionModificar :idHisTipoAtencion, :codigo, :descripcion, :idUsuarioAuditoria";

		$params = [
			'idHisTipoAtencion' => ($oTabla->idHisTipoAtencion == 0)? Null: $oTabla->idHisTipoAtencion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC HIS_TipoAtencionEliminar :idHisTipoAtencion, :idUsuarioAuditoria";

		$params = [
			'idHisTipoAtencion' => $oTabla->idHisTipoAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC HIS_TipoAtencionSeleccionarPorId :idHisTipoAtencion";

		$params = [
			'idHisTipoAtencion' => $oTabla->idHisTipoAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}