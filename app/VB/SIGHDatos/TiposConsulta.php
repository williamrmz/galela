<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposConsulta extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC TiposConsultaAgregar :descripcion, :idTipoConsulta, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoConsulta' => ($oTabla->idTipoConsulta == "")? Null: $oTabla->idTipoConsulta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposConsultaModificar :descripcion, :idTipoConsulta, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoConsulta' => ($oTabla->idTipoConsulta == "")? Null: $oTabla->idTipoConsulta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposConsultaEliminar :idTipoConsulta, :idUsuarioAuditoria";

		$params = [
			'idTipoConsulta' => ($oTabla->idTipoConsulta == "")? Null: $oTabla->idTipoConsulta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposConsultaSeleccionarPorId :idTipoConsulta";

		$params = [
			'idTipoConsulta' => $oTabla->idTipoConsulta, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposConsultaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}