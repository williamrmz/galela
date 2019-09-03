<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposCita extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC TiposCitaAgregar :descripcion, :idTipoCita, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoCita' => ($oTabla->idTipoCita == "")? Null: $oTabla->idTipoCita, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposCitaModificar :descripcion, :idTipoCita, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoCita' => ($oTabla->idTipoCita == "")? Null: $oTabla->idTipoCita, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposCitaEliminar :idTipoCita, :idUsuarioAuditoria";

		$params = [
			'idTipoCita' => ($oTabla->idTipoCita == "")? Null: $oTabla->idTipoCita, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposCitaSeleccionarPorId :idTipoCita";

		$params = [
			'idTipoCita' => $oTabla->idTipoCita, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposCitaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}