<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class InteoTipoSistema extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idTipoSistema AS Int = :idTipoSistema
			SET NOCOUNT ON 
			EXEC InteoTipoSistemaAgregar @idTipoSistema OUTPUT, :tipoSistema, :esActivo, :fechaCrea, :fechaEdita, :idUsuarioAuditoria
			SELECT @idTipoSistema AS idTipoSistema";

		$params = [
			'idTipoSistema' => 0, 
			'tipoSistema' => ($oTabla->tipoSistema == "")? Null: $oTabla->tipoSistema, 
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
			EXEC InteoTipoSistemaModificar :idTipoSistema, :tipoSistema, :esActivo, :fechaCrea, :fechaEdita, :idUsuarioAuditoria";

		$params = [
			'idTipoSistema' => ($oTabla->idTipoSistema == 0)? Null: $oTabla->idTipoSistema, 
			'tipoSistema' => ($oTabla->tipoSistema == "")? Null: $oTabla->tipoSistema, 
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
			EXEC InteoTipoSistemaEliminar :idTipoSistema, :idUsuarioAuditoria";

		$params = [
			'idTipoSistema' => $oTabla->idTipoSistema, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC InteoTipoSistemaSeleccionarPorId :idTipoSistema";

		$params = [
			'idTipoSistema' => $oTabla->idTipoSistema, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC InteoTipoSistemaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function VerificarPorNombre($oTabla)
	{
		$query = "
			EXEC InteoTipoSistemaVerificaNombre :idTipoSistema, :tipoSistema";

		$params = [
			'idTipoSistema' => $oTabla->idTipoSistema, 
			'tipoSistema' => ($oTabla->tipoSistema == "")? Null: $oTabla->tipoSistema, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}