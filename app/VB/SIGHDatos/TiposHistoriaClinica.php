<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposHistoriaClinica extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idTipoHistoria AS Int = :idTipoHistoria
			SET NOCOUNT ON 
			EXEC TiposHistoriaClinicaAgregar :descripcion, @idTipoHistoria OUTPUT, :idUsuarioAuditoria
			SELECT @idTipoHistoria AS idTipoHistoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoHistoria' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposHistoriaClinicaModificar :descripcion, :idTipoHistoria, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoHistoria' => ($oTabla->idTipoHistoria == 0)? Null: $oTabla->idTipoHistoria, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposHistoriaClinicaEliminar :idTipoHistoria, :idUsuarioAuditoria";

		$params = [
			'idTipoHistoria' => ($oTabla->idTipoHistoria == 0)? Null: $oTabla->idTipoHistoria, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposHistoriaClinicaSeleccionarPorId :idTipoHistoria";

		$params = [
			'idTipoHistoria' => $oTabla->idTipoHistoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposHistoriaClinicaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}