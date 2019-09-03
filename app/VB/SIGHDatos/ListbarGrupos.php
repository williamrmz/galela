<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ListbarGrupos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idListGrupo AS Int = :idListGrupo
			SET NOCOUNT ON 
			EXEC ListbarGruposAgregar :indice, :clave, :texto, @idListGrupo OUTPUT, :idUsuarioAuditoria
			SELECT @idListGrupo AS idListGrupo";

		$params = [
			'indice' => ($oTabla->indice == 0)? Null: $oTabla->indice, 
			'clave' => ($oTabla->clave == "")? Null: $oTabla->clave, 
			'texto' => ($oTabla->texto == "")? Null: $oTabla->texto, 
			'idListGrupo' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC ListbarGruposModificar :indice, :clave, :texto, :idListGrupo, :idUsuarioAuditoria";

		$params = [
			'indice' => ($oTabla->indice == 0)? Null: $oTabla->indice, 
			'clave' => ($oTabla->clave == "")? Null: $oTabla->clave, 
			'texto' => ($oTabla->texto == "")? Null: $oTabla->texto, 
			'idListGrupo' => ($oTabla->idListGrupo == 0)? Null: $oTabla->idListGrupo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC ListbarGruposEliminar :idListGrupo, :idUsuarioAuditoria";

		$params = [
			'idListGrupo' => ($oTabla->idListGrupo == 0)? Null: $oTabla->idListGrupo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC ListbarGruposSeleccionarPorId :idListGrupo";

		$params = [
			'idListGrupo' => $oTabla->idListGrupo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC ListbarGruposSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}