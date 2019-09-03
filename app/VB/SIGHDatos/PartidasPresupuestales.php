<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class PartidasPresupuestales extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPartidaPresupuestal AS Int = :idPartidaPresupuestal
			SET NOCOUNT ON 
			EXEC FactPartidasPresupuestalesAgregar :descripcion, :codigo, @idPartidaPresupuestal OUTPUT, :idUsuarioAuditoria
			SELECT @idPartidaPresupuestal AS idPartidaPresupuestal";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idPartidaPresupuestal' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactPartidasPresupuestalesModificar :descripcion, :codigo, :idPartidaPresupuestal, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'idPartidaPresupuestal' => ($oTabla->idPartidaPresupuestal == 0)? Null: $oTabla->idPartidaPresupuestal, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactPartidasPresupuestalesEliminar :idPartidaPresupuestal, :idUsuarioAuditoria";

		$params = [
			'idPartidaPresupuestal' => ($oTabla->idPartidaPresupuestal == 0)? Null: $oTabla->idPartidaPresupuestal, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FactPartidasPresupuestalesSeleccionarPorId :idPartidaPresupuestal";

		$params = [
			'idPartidaPresupuestal' => $oTabla->idPartidaPresupuestal, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC FactPartidasPresupuestalesSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oTabla)
	{
		$query = "
			EXEC PartidasPresupuestalesFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}