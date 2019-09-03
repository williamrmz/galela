<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxEtapas extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idCQxEtapas AS Int = :idCQxEtapas
			SET NOCOUNT ON 
			EXEC CQxEtapasAgregar @idCQxEtapas OUTPUT, :descripcion, :idUsuarioAuditoria
			SELECT @idCQxEtapas AS idCQxEtapas";

		$params = [
			'idCQxEtapas' => 0, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CQxEtapasModificar :idCQxEtapas, :descripcion, :idUsuarioAuditoria";

		$params = [
			'idCQxEtapas' => ($oTabla->idCQxEtapas == 0)? Null: $oTabla->idCQxEtapas, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CQxEtapasEliminar :idCQxEtapas, :idUsuarioAuditoria";

		$params = [
			'idCQxEtapas' => $oTabla->idCQxEtapas, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxEtapasSeleccionarPorId :idCQxEtapas";

		$params = [
			'idCQxEtapas' => $oTabla->idCQxEtapas, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC CQxEtapasSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}