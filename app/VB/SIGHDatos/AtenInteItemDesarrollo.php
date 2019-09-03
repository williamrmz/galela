<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtenInteItemDesarrollo extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idItemDesarrollo AS Int = :idItemDesarrollo
			SET NOCOUNT ON 
			EXEC AtenInteItemDesarrolloAgregar @idItemDesarrollo OUTPUT, :itemDesarrollo, :idUsuarioAuditoria
			SELECT @idItemDesarrollo AS idItemDesarrollo";

		$params = [
			'idItemDesarrollo' => 0, 
			'itemDesarrollo' => ($oTabla->itemDesarrollo == "")? Null: $oTabla->itemDesarrollo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtenInteItemDesarrolloModificar :idItemDesarrollo, :itemDesarrollo, :idUsuarioAuditoria";

		$params = [
			'idItemDesarrollo' => ($oTabla->idItemDesarrollo == 0)? Null: $oTabla->idItemDesarrollo, 
			'itemDesarrollo' => ($oTabla->itemDesarrollo == "")? Null: $oTabla->itemDesarrollo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtenInteItemDesarrolloEliminar :idItemDesarrollo, :idUsuarioAuditoria";

		$params = [
			'idItemDesarrollo' => $oTabla->idItemDesarrollo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtenInteItemDesarrolloSeleccionarPorId :idItemDesarrollo";

		$params = [
			'idItemDesarrollo' => $oTabla->idItemDesarrollo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}