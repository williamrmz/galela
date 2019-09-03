<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FarmaciaRecetas extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idReceta AS Int = :idReceta
			SET NOCOUNT ON 
			EXEC FarmaciaRecetasAgregar :idMedicoOrdena, :idServicioOrdena, :fechaReceta, :nroReceta, :idCuentaAtencion, @idReceta OUTPUT, :idUsuarioAuditoria
			SELECT @idReceta AS idReceta";

		$params = [
			'idMedicoOrdena' => ($oTabla->idMedicoOrdena == 0)? Null: $oTabla->idMedicoOrdena, 
			'idServicioOrdena' => ($oTabla->idServicioOrdena == 0)? Null: $oTabla->idServicioOrdena, 
			'fechaReceta' => ($oTabla->fechaReceta == "")? Null: $oTabla->fechaReceta, 
			'nroReceta' => ($oTabla->nroReceta == "")? Null: $oTabla->nroReceta, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idReceta' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FarmaciaRecetasModificar :idMedicoOrdena, :idServicioOrdena, :fechaReceta, :nroReceta, :idCuentaAtencion, :idReceta, :idUsuarioAuditoria";

		$params = [
			'idMedicoOrdena' => ($oTabla->idMedicoOrdena == 0)? Null: $oTabla->idMedicoOrdena, 
			'idServicioOrdena' => ($oTabla->idServicioOrdena == 0)? Null: $oTabla->idServicioOrdena, 
			'fechaReceta' => ($oTabla->fechaReceta == "")? Null: $oTabla->fechaReceta, 
			'nroReceta' => ($oTabla->nroReceta == "")? Null: $oTabla->nroReceta, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idReceta' => ($oTabla->idReceta == 0)? Null: $oTabla->idReceta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FarmaciaRecetasEliminar :idReceta, :idUsuarioAuditoria";

		$params = [
			'idReceta' => ($oTabla->idReceta == 0)? Null: $oTabla->idReceta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FarmaciaRecetasSeleccionarPorId :idReceta";

		$params = [
			'idReceta' => $oTabla->idReceta, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oTabla, $oDOPaciente)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}