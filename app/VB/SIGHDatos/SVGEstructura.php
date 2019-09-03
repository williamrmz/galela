<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class SVGEstructura extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC SVGEstructuraAgregar :codigo, :sVG, :tipo, :orden, :idUsuarioAuditoria";

		$params = [
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'sVG' => ($oTabla->sVG == "")? Null: $oTabla->sVG, 
			'tipo' => ($oTabla->tipo == "")? Null: $oTabla->tipo, 
			'orden' => ($oTabla->orden == 0)? Null: $oTabla->orden, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC SVGEstructuraModificar :codigo, :sVG, :tipo, :orden, :idUsuarioAuditoria";

		$params = [
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'sVG' => ($oTabla->sVG == "")? Null: $oTabla->sVG, 
			'tipo' => ($oTabla->tipo == "")? Null: $oTabla->tipo, 
			'orden' => ($oTabla->orden == 0)? Null: $oTabla->orden, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC SVGEstructuraEliminar :idUsuarioAuditoria";

		$params = [
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC SVGEstructuraSeleccionarPorId :tipo, :codigo";

		$params = [
			'tipo' => $oTabla->tipo, 
			'codigo' => $oTabla->codigo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}