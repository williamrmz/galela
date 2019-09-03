<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FarmInventario extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idInventario AS Int = :idInventario
			SET NOCOUNT ON 
			EXEC farmInventarioAgregar @idInventario OUTPUT, :idAlmacen, :numeroInventario, :fechaCierre, :fechaCreacion, :fechaModificacion, :idEstadoInventario, :idUsuario, :idTipoInventario, :idUsuarioAuditoria
			SELECT @idInventario AS idInventario";

		$params = [
			'idInventario' => 0, 
			'idAlmacen' => ($oTabla->idAlmacen == 0)? Null: $oTabla->idAlmacen, 
			'numeroInventario' => ($oTabla->numeroInventario == "")? Null: $oTabla->numeroInventario, 
			'fechaCierre' => ($oTabla->fechaCierre == 0)? Null: $oTabla->fechaCierre, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'fechaModificacion' => ($oTabla->fechaModificacion == 0)? Null: $oTabla->fechaModificacion, 
			'idEstadoInventario' => $oTabla->idEstadoInventario, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idTipoInventario' => $oTabla->idTipoInventario, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC farmInventarioModificar :idInventario, :idAlmacen, :numeroInventario, :fechaCierre, :fechaCreacion, :fechaModificacion, :idEstadoInventario, :idUsuario, :idTipoInventario, :idUsuarioAuditoria";

		$params = [
			'idInventario' => ($oTabla->idInventario == 0)? Null: $oTabla->idInventario, 
			'idAlmacen' => ($oTabla->idAlmacen == 0)? Null: $oTabla->idAlmacen, 
			'numeroInventario' => ($oTabla->numeroInventario == "")? Null: $oTabla->numeroInventario, 
			'fechaCierre' => ($oTabla->fechaCierre == 0)? Null: $oTabla->fechaCierre, 
			'fechaCreacion' => ($oTabla->fechaCreacion == 0)? Null: $oTabla->fechaCreacion, 
			'fechaModificacion' => ($oTabla->fechaModificacion == 0)? Null: $oTabla->fechaModificacion, 
			'idEstadoInventario' => $oTabla->idEstadoInventario, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idTipoInventario' => $oTabla->idTipoInventario, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC farmInventarioEliminar :idInventario, :idUsuarioAuditoria";

		$params = [
			'idInventario' => $oTabla->idInventario, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC farmInventarioSeleccionarPorId :idInventario";

		$params = [
			'idInventario' => $oTabla->idInventario, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function DevuelveListaInventarios()
	{
		$query = "
			EXEC farmInventarioDevuelveListaInventarios ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}