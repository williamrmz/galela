<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class InteoProveedorSistema extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idProveedorSistema AS Int = :idProveedorSistema
			SET NOCOUNT ON 
			EXEC InteoProveedorSistemaAgregar @idProveedorSistema OUTPUT, :proveedorSistema, :esActivo, :fechaCrea, :fechaEdita, :idUsuarioAuditoria
			SELECT @idProveedorSistema AS idProveedorSistema";

		$params = [
			'idProveedorSistema' => 0, 
			'proveedorSistema' => ($oTabla->proveedorSistema == "")? Null: $oTabla->proveedorSistema, 
			'esActivo' => ($oTabla->esActivo == 0)? Null: $oTabla->esActivo, 
			'fechaCrea' => ($oTabla->fechaCrea == 0)? Null: $oTabla->fechaCrea, 
			'fechaEdita' => ($oTabla->fechaEdita == 0)? Null: $oTabla->fechaEdita, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC InteoProveedorSistemaModificar :idProveedorSistema, :proveedorSistema, :esActivo, :fechaCrea, :fechaEdita, :idUsuarioAuditoria";

		$params = [
			'idProveedorSistema' => ($oTabla->idProveedorSistema == 0)? Null: $oTabla->idProveedorSistema, 
			'proveedorSistema' => ($oTabla->proveedorSistema == "")? Null: $oTabla->proveedorSistema, 
			'esActivo' => ($oTabla->esActivo == 0)? Null: $oTabla->esActivo, 
			'fechaCrea' => ($oTabla->fechaCrea == 0)? Null: $oTabla->fechaCrea, 
			'fechaEdita' => ($oTabla->fechaEdita == 0)? Null: $oTabla->fechaEdita, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC InteoProveedorSistemaEliminar :idProveedorSistema, :idUsuarioAuditoria";

		$params = [
			'idProveedorSistema' => $oTabla->idProveedorSistema, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC InteoProveedorSistemaSeleccionarPorId :idProveedorSistema";

		$params = [
			'idProveedorSistema' => $oTabla->idProveedorSistema, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function VarificarPorNombre($oTabla)
	{
		$query = "
			EXEC InteoProveedorSistemaVerificaNombre :idProveedorSistema, :proveedorSistema";

		$params = [
			'idProveedorSistema' => $oTabla->idProveedorSistema, 
			'proveedorSistema' => ($oTabla->proveedorSistema == "")? Null: $oTabla->proveedorSistema, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC InteoProveedorSistemaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}