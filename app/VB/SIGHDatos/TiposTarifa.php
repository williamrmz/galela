<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposTarifa extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idTipoTarifa AS Int = :idTipoTarifa
			SET NOCOUNT ON 
			EXEC TiposTarifaAgregar @idTipoTarifa OUTPUT, :codigo, :tipoTarifa, :esFarmacia, :idUsuarioAuditoria
			SELECT @idTipoTarifa AS idTipoTarifa";

		$params = [
			'idTipoTarifa' => 0, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'tipoTarifa' => ($oTabla->tipoTarifa == "")? Null: $oTabla->tipoTarifa, 
			'esFarmacia' => $oTabla->esFArmacia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposTarifaModificar :idTipoTarifa, :codigo, :tipoTarifa, :esFarmacia, :idUsuarioAuditoria";

		$params = [
			'idTipoTarifa' => ($oTabla->idTipoTarifa == 0)? Null: $oTabla->idTipoTarifa, 
			'codigo' => ($oTabla->codigo == "")? Null: $oTabla->codigo, 
			'tipoTarifa' => ($oTabla->tipoTarifa == "")? Null: $oTabla->tipoTarifa, 
			'esFarmacia' => $oTabla->esFArmacia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposTarifaEliminar :idTipoTarifa, :idUsuarioAuditoria";

		$params = [
			'idTipoTarifa' => $oTabla->idTipoTarifa, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposTarifaSeleccionarPorId :idTipoTarifa";

		$params = [
			'idTipoTarifa' => $oTabla->idTipoTarifa, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oTabla)
	{
		$query = "
			EXEC TiposTarifaFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}