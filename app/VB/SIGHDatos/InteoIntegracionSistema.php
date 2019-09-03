<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class InteoIntegracionSistema extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idIntegracionSistema AS Int = :idIntegracionSistema
			SET NOCOUNT ON 
			EXEC InteoIntegracionSistemaAgregar @idIntegracionSistema OUTPUT, :idTipoSistema, :idProveedorSistema, :nombreUsuario, :claveUsuario, :esProveedorActual, :esActivo, :fechaCrea, :fechaEdita, :idUsuarioAuditoria
			SELECT @idIntegracionSistema AS idIntegracionSistema";

		$params = [
			'idIntegracionSistema' => 0, 
			'idTipoSistema' => ($oTabla->idTipoSistema == 0)? Null: $oTabla->idTipoSistema, 
			'idProveedorSistema' => ($oTabla->idProveedorSistema == 0)? Null: $oTabla->idProveedorSistema, 
			'nombreUsuario' => ($oTabla->nombreUsuario == "")? Null: $oTabla->nombreUsuario, 
			'claveUsuario' => ($oTabla->claveUsuario == "")? Null: $oTabla->claveUsuario, 
			'esProveedorActual' => $oTabla->esProveedorActual, 
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
			EXEC InteoIntegracionSistemaModificar :idIntegracionSistema, :idTipoSistema, :idProveedorSistema, :nombreUsuario, :claveUsuario, :esProveedorActual, :esActivo, :fechaCrea, :fechaEdita, :idUsuarioAuditoria";

		$params = [
			'idIntegracionSistema' => ($oTabla->idIntegracionSistema == 0)? Null: $oTabla->idIntegracionSistema, 
			'idTipoSistema' => ($oTabla->idTipoSistema == 0)? Null: $oTabla->idTipoSistema, 
			'idProveedorSistema' => ($oTabla->idProveedorSistema == 0)? Null: $oTabla->idProveedorSistema, 
			'nombreUsuario' => ($oTabla->nombreUsuario == "")? Null: $oTabla->nombreUsuario, 
			'claveUsuario' => ($oTabla->claveUsuario == "")? Null: $oTabla->claveUsuario, 
			'esProveedorActual' => $oTabla->esProveedorActual, 
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
			EXEC InteoIntegracionSistemaEliminar :idIntegracionSistema, :idUsuarioAuditoria";

		$params = [
			'idIntegracionSistema' => $oTabla->idIntegracionSistema, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC InteoIntegracionSistemaSeleccionarPorId :idIntegracionSistema";

		$params = [
			'idIntegracionSistema' => $oTabla->idIntegracionSistema, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function VerificarIntegracionSistema($oTabla)
	{
		$query = "
			EXEC InteoIntegracionSistemaVerifica :idIntegracionSistema, :idTipoSistema, :idProveedorSistema";

		$params = [
			'idIntegracionSistema' => $oTabla->idIntegracionSistema, 
			'idTipoSistema' => $oTabla->idTipoSistema, 
			'idProveedorSistema' => $oTabla->idProveedorSistema, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarTodos($oTabla)
	{
		$query = "
			EXEC InteoIntegracionSistemaFiltrarTodos :idTipoSistema";

		$params = [
			'idTipoSistema' => ($oTabla->idTipoSistema == 0)? Null: $oTabla->idTipoSistema, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarProveedorActual($oTabla)
	{
		$query = "
			EXEC InteoIntegracionSistemaProveedorActualPorTipo :idTipoSistema";

		$params = [
			'idTipoSistema' => $oTabla->idTipoSistema, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}