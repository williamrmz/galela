<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ListbarItems extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idListItem AS Int = :idListItem
			SET NOCOUNT ON 
			EXEC ListbarItemsAgregar :keyIcon, :indice, :clave, :texto, :idListGrupo, @idListItem OUTPUT, :idUsuarioAuditoria
			SELECT @idListItem AS idListItem";

		$params = [
			'keyIcon' => ($oTabla->keyIcon == "")? Null: $oTabla->keyIcon, 
			'indice' => ($oTabla->indice == 0)? Null: $oTabla->indice, 
			'clave' => ($oTabla->clave == "")? Null: $oTabla->clave, 
			'texto' => ($oTabla->texto == "")? Null: $oTabla->texto, 
			'idListGrupo' => ($oTabla->idListGrupo == 0)? Null: $oTabla->idListGrupo, 
			'idListItem' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC ListbarItemsModificar :keyIcon, :indice, :clave, :texto, :idListGrupo, :idListItem, :idUsuarioAuditoria";

		$params = [
			'keyIcon' => ($oTabla->keyIcon == "")? Null: $oTabla->keyIcon, 
			'indice' => ($oTabla->indice == 0)? Null: $oTabla->indice, 
			'clave' => ($oTabla->clave == "")? Null: $oTabla->clave, 
			'texto' => ($oTabla->texto == "")? Null: $oTabla->texto, 
			'idListGrupo' => ($oTabla->idListGrupo == 0)? Null: $oTabla->idListGrupo, 
			'idListItem' => ($oTabla->idListItem == 0)? Null: $oTabla->idListItem, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC ListbarItemsEliminar :idListItem, :idUsuarioAuditoria";

		$params = [
			'idListItem' => ($oTabla->idListItem == 0)? Null: $oTabla->idListItem, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC ListbarItemsSeleccionarPorId :idListItem";

		$params = [
			'idListItem' => $oTabla->idListItem, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC ListbarItemsSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}