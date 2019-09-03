<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class HIS_colegios extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @cod_col AS Char = :cod_col
			SET NOCOUNT ON 
			EXEC HIS_colegiosAgregar @cod_col OUTPUT, :des_col, :idUsuarioAuditoria
			SELECT @cod_col AS cod_col";

		$params = [
			'cod_col' => 0, 
			'des_col' => ($oTabla->des_col == "")? Null: $oTabla->des_col, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC HIS_colegiosModificar :cod_col, :des_col, :idUsuarioAuditoria";

		$params = [
			'cod_col' => ($oTabla->cod_col == "")? Null: $oTabla->cod_col, 
			'des_col' => ($oTabla->des_col == "")? Null: $oTabla->des_col, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC HIS_colegiosEliminar :cod_col, :idUsuarioAuditoria";

		$params = [
			'cod_col' => $oTabla->cod_col, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC HIS_colegiosSeleccionarPorId :cod_col";

		$params = [
			'cod_col' => $oTabla->cod_col, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}