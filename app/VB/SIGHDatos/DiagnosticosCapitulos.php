<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class DiagnosticosCapitulos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idCapitulo AS Int = :idCapitulo
			SET NOCOUNT ON 
			EXEC DiagnosticosCapitulosAgregar :descripcion, :codigo, @idCapitulo OUTPUT, :idUsuarioAuditoria
			SELECT @idCapitulo AS idCapitulo";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idCapitulo' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC DiagnosticosCapitulosModificar :descripcion, :codigo, :idCapitulo, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idCapitulo' => ($oTabla->idCapitulo == 0)? Null: $oTabla->idCapitulo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC DiagnosticosCapitulosEliminar :idCapitulo, :idUsuarioAuditoria";

		$params = [
			'idCapitulo' => ($oTabla->idCapitulo == 0)? Null: $oTabla->idCapitulo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC DiagnosticosCapitulosSeleccionarPorId :idCapitulo";

		$params = [
			'idCapitulo' => $oTabla->idCapitulo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC DiagnosticosCapitulosSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}