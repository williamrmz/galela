<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CajaTiposComprobante extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC CajaTiposComprobanteAgregar :descripcion, :idTipoComprobante, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoComprobante' => ($oTabla->idTipoComprobante == "")? Null: $oTabla->idTipoComprobante, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CajaTiposComprobanteModificar :descripcion, :idTipoComprobante, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoComprobante' => ($oTabla->idTipoComprobante == "")? Null: $oTabla->idTipoComprobante, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CajaTiposComprobanteEliminar :idUsuarioAuditoria";

		$params = [
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CajaTiposComprobanteSeleccionarPorId ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC CajaTiposComprobanteSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}