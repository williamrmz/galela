<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class EstadosHistoriaClinica extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idEstadoHistoria AS Int = :idEstadoHistoria
			SET NOCOUNT ON 
			EXEC EstadosHistoriaClinicaAgregar :descripcion, @idEstadoHistoria OUTPUT, :idUsuarioAuditoria
			SELECT @idEstadoHistoria AS idEstadoHistoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idEstadoHistoria' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC EstadosHistoriaClinicaModificar :descripcion, :idEstadoHistoria, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idEstadoHistoria' => ($oTabla->idEstadoHistoria == 0)? Null: $oTabla->idEstadoHistoria, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC EstadosHistoriaClinicaEliminar :idEstadoHistoria, :idUsuarioAuditoria";

		$params = [
			'idEstadoHistoria' => ($oTabla->idEstadoHistoria == 0)? Null: $oTabla->idEstadoHistoria, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC EstadosHistoriaClinicaSeleccionarPorId :idEstadoHistoria";

		$params = [
			'idEstadoHistoria' => $oTabla->idEstadoHistoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC EstadosHistoriaClinicaSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}