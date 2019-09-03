<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TipoFinanciador extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idTipoFinanciador AS Int = :idTipoFinanciador
			SET NOCOUNT ON 
			EXEC TipoFinanciadorAgregar @idTipoFinanciador OUTPUT, :nombre, :denominacion, :codigo, :idUsuarioAuditoria
			SELECT @idTipoFinanciador AS idTipoFinanciador";

		$params = [
			'idTipoFinanciador' => 0, 
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'denominacion' => ($oTabla->denominacion == "")? Null: $oTabla->denominacion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TipoFinanciadorModificar :idTipoFinanciador, :nombre, :denominacion, :codigo, :idUsuarioAuditoria";

		$params = [
			'idTipoFinanciador' => ($oTabla->idTipoFinanciador == 0)? Null: $oTabla->idTipoFinanciador, 
			'nombre' => ($oTabla->nombre == "")? Null: $oTabla->nombre, 
			'denominacion' => ($oTabla->denominacion == "")? Null: $oTabla->denominacion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TipoFinanciadorEliminar :idTipoFinanciador, :idUsuarioAuditoria";

		$params = [
			'idTipoFinanciador' => $oTabla->idTipoFinanciador, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TipoFinanciadorSeleccionarPorId :idTipoFinanciador";

		$params = [
			'idTipoFinanciador' => $oTabla->idTipoFinanciador, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TipoFinanciadorSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}