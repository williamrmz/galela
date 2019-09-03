<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FiltrosSQL extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC FiltrosSQLAgregar :idUsuario, :filtroSQL, :descripcion, :codigo, :idFiltro, :idUsuarioAuditoria";

		$params = [
			'idUsuario' => ($oTabla->idUsuario == "")? Null: $oTabla->idUsuario, 
			'filtroSQL' => ($oTabla->filtroSQL == "")? Null: $oTabla->filtroSQL, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idFiltro' => ($oTabla->idFiltro == "")? Null: $oTabla->idFiltro, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FiltrosSQLModificar :idUsuario, :filtroSQL, :descripcion, :codigo, :idFiltro, :idUsuarioAuditoria";

		$params = [
			'idUsuario' => ($oTabla->idUsuario == "")? Null: $oTabla->idUsuario, 
			'filtroSQL' => ($oTabla->filtroSQL == "")? Null: $oTabla->filtroSQL, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idFiltro' => ($oTabla->idFiltro == "")? Null: $oTabla->idFiltro, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FiltrosSQLEliminar :idUsuarioAuditoria";

		$params = [
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FiltrosSQLSeleccionarPorId ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCodigoYUsuario($oTabla)
	{
		$query = "
			EXEC FiltrosSQLSeleccionarPorCodigoYUsuario ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}