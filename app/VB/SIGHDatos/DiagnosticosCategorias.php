<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class DiagnosticosCategorias extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idCategoria AS Int = :idCategoria
			SET NOCOUNT ON 
			EXEC DiagnosticosCategoriasAgregar :idGrupo, :descripcion, :codigo, @idCategoria OUTPUT, :idUsuarioAuditoria
			SELECT @idCategoria AS idCategoria";

		$params = [
			'idGrupo' => ($oTabla->idGrupo == 0)? Null: $oTabla->idGrupo, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idCategoria' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC DiagnosticosCategoriasModificar :idGrupo, :descripcion, :codigo, :idCategoria, :idUsuarioAuditoria";

		$params = [
			'idGrupo' => ($oTabla->idGrupo == 0)? Null: $oTabla->idGrupo, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idCategoria' => ($oTabla->idCategoria == 0)? Null: $oTabla->idCategoria, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC DiagnosticosCategoriasEliminar :idCategoria, :idUsuarioAuditoria";

		$params = [
			'idCategoria' => ($oTabla->idCategoria == 0)? Null: $oTabla->idCategoria, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC DiagnosticosCategoriasSeleccionarPorId :idCategoria";

		$params = [
			'idCategoria' => $oTabla->idCategoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorGrupo($idGrupo)
	{
		$query = "
			EXEC DiagnosticosCategoriasSeleccionarPorGrupo :idGrupo";

		$params = [
			'idGrupo' => IdGrupo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}