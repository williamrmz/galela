<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Planes extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPlan AS Int = :idPlan
			SET NOCOUNT ON 
			EXEC PlanesAgregar :deducible, :coaseguro, :descripcion, @idPlan OUTPUT, :idUsuarioAuditoria
			SELECT @idPlan AS idPlan";

		$params = [
			'deducible' => ($oTabla->deducible == 0)? Null: $oTabla->deducible, 
			'coaseguro' => ($oTabla->coaseguro == 0)? Null: $oTabla->coaseguro, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idPlan' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC PlanesModificar :deducible, :coaseguro, :descripcion, :idPlan, :idUsuarioAuditoria";

		$params = [
			'deducible' => ($oTabla->deducible == 0)? Null: $oTabla->deducible, 
			'coaseguro' => ($oTabla->coaseguro == 0)? Null: $oTabla->coaseguro, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idPlan' => ($oTabla->idPlan == 0)? Null: $oTabla->idPlan, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC PlanesEliminar :idPlan, :idUsuarioAuditoria";

		$params = [
			'idPlan' => ($oTabla->idPlan == 0)? Null: $oTabla->idPlan, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC PlanesSeleccionarPorId :idPlan";

		$params = [
			'idPlan' => $oTabla->idPlan, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC PlanesSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}