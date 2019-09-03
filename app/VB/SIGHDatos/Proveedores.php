<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Proveedores extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idProveedor AS Int = :idProveedor
			SET NOCOUNT ON 
			EXEC ProveedoresAgregar @idProveedor OUTPUT, :ruc, :razonSocial, :idUsuarioAuditoria
			SELECT @idProveedor AS idProveedor";

		$params = [
			'idProveedor' => 0, 
			'ruc' => ($oTabla->ruc == "")? Null: $oTabla->ruc, 
			'razonSocial' => ($oTabla->razonSocial == "")? Null: $oTabla->razonSocial, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC ProveedoresModificar :idProveedor, :ruc, :razonSocial, :idUsuarioAuditoria";

		$params = [
			'idProveedor' => ($oTabla->idProveedor == 0)? Null: $oTabla->idProveedor, 
			'ruc' => ($oTabla->ruc == "")? Null: $oTabla->ruc, 
			'razonSocial' => ($oTabla->razonSocial == "")? Null: $oTabla->razonSocial, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC ProveedoresEliminar :idProveedor, :idUsuarioAuditoria";

		$params = [
			'idProveedor' => $oTabla->idProveedor, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC ProveedoresSeleccionarPorId :idProveedor";

		$params = [
			'idProveedor' => $oTabla->idProveedor, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarSegunFiltro($lcFiltro)
	{
		$query = "
			EXEC FarmProveedorFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => $lcFiltro, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}