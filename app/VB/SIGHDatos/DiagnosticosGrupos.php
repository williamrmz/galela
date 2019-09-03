<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class DiagnosticosGrupos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idGrupo AS Int = :idGrupo
			SET NOCOUNT ON 
			EXEC DiagnosticosGruposAgregar :idCapitulo, :descripcion, @idGrupo OUTPUT, :idUsuarioAuditoria
			SELECT @idGrupo AS idGrupo";

		$params = [
			'idCapitulo' => ($oTabla->idCapitulo == "")? Null: $oTabla->idCapitulo, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idGrupo' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC DiagnosticosGruposModificar :idCapitulo, :descripcion, :idGrupo, :idUsuarioAuditoria";

		$params = [
			'idCapitulo' => ($oTabla->idCapitulo == "")? Null: $oTabla->idCapitulo, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idGrupo' => ($oTabla->idGrupo == 0)? Null: $oTabla->idGrupo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC DiagnosticosGruposEliminar :idGrupo, :idUsuarioAuditoria";

		$params = [
			'idGrupo' => ($oTabla->idGrupo == 0)? Null: $oTabla->idGrupo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC DiagnosticosGruposSeleccionarPorId :idGrupo";

		$params = [
			'idGrupo' => $oTabla->idGrupo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCapitulo($idCapitulo)
	{
		$query = "
			EXEC DiagnosticosGruposSeleccionarPorCapitulo :idCapitulo";

		$params = [
			'idCapitulo' => IdCapitulo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}