<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposDeBienesEInsumos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC FactClasificacionBienesInsumosAgregar :descripcion, :idClasificacionBienInsumo, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idClasificacionBienInsumo' => ($oTabla->idClasificacionBienInsumo == "")? Null: $oTabla->idClasificacionBienInsumo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactClasificacionBienesInsumosModificar :descripcion, :idClasificacionBienInsumo, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idClasificacionBienInsumo' => ($oTabla->idClasificacionBienInsumo == "")? Null: $oTabla->idClasificacionBienInsumo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactClasificacionBienesInsumosEliminar :idClasificacionBienInsumo, :idUsuarioAuditoria";

		$params = [
			'idClasificacionBienInsumo' => ($oTabla->idClasificacionBienInsumo == "")? Null: $oTabla->idClasificacionBienInsumo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FactClasificacionBienesInsumosSeleccionarPorId ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC Select * from FactInsumosSubGrupoFarmacologico ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}