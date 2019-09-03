<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FactPuntosCargaBienesInsumos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idPuntoCargaBienInsumo AS Int = :idPuntoCargaBienInsumo
			SET NOCOUNT ON 
			EXEC FactPuntosCargaBienesInsumosAgregar :idSubGrupoFarmacologico, :idPuntoCarga, @idPuntoCargaBienInsumo OUTPUT, :idUsuarioAuditoria
			SELECT @idPuntoCargaBienInsumo AS idPuntoCargaBienInsumo";

		$params = [
			'idSubGrupoFarmacologico' => ($oTabla->idSubGrupoFarmacologico == 0)? Null: $oTabla->idSubGrupoFarmacologico, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idPuntoCargaBienInsumo' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactPuntosCargaBienesInsumosModificar :idSubGrupoFarmacologico, :idPuntoCarga, :idPuntoCargaBienInsumo, :idUsuarioAuditoria";

		$params = [
			'idSubGrupoFarmacologico' => ($oTabla->idSubGrupoFarmacologico == 0)? Null: $oTabla->idSubGrupoFarmacologico, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'idPuntoCargaBienInsumo' => ($oTabla->idPuntoCargaBienInsumo == 0)? Null: $oTabla->idPuntoCargaBienInsumo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactPuntosCargaBienesInsumosEliminar :idPuntoCargaBienInsumo, :idUsuarioAuditoria";

		$params = [
			'idPuntoCargaBienInsumo' => ($oTabla->idPuntoCargaBienInsumo == 0)? Null: $oTabla->idPuntoCargaBienInsumo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FactPuntosCargaBienesInsumosSeleccionarPorId :idPuntoCargaBienInsumo";

		$params = [
			'idPuntoCargaBienInsumo' => $oTabla->idPuntoCargaBienInsumo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}