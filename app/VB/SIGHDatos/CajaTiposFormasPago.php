<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CajaTiposFormasPago extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC CajaTiposFormasPagoAgregar :descripcion, :idTipoFormaPago, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoFormaPago' => ($oTabla->idTipoFormaPago == "")? Null: $oTabla->idTipoFormaPago, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CajaTiposFormasPagoModificar :descripcion, :idTipoFormaPago, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoFormaPago' => ($oTabla->idTipoFormaPago == "")? Null: $oTabla->idTipoFormaPago, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CajaTiposFormasPagoEliminar :idUsuarioAuditoria";

		$params = [
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CajaTiposFormasPagoSeleccionarPorId ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC Select * from CajaTiposFormasPago ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}