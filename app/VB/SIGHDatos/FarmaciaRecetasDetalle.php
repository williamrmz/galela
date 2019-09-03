<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FarmaciaRecetasDetalle extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idRecetaDetalle AS Int = :idRecetaDetalle
			SET NOCOUNT ON 
			EXEC FarmaciaRecetasDetalleAgregar :cantidad, :idFacturacionBienes, :idAtencionReceta, @idRecetaDetalle OUTPUT, :idUsuarioAuditoria
			SELECT @idRecetaDetalle AS idRecetaDetalle";

		$params = [
			'cantidad' => ($oTabla->cantidad == "")? Null: $oTabla->cantidad, 
			'idFacturacionBienes' => ($oTabla->idFacturacionBienes == "")? Null: $oTabla->idFacturacionBienes, 
			'idAtencionReceta' => ($oTabla->idAtencionReceta == "")? Null: $oTabla->idAtencionReceta, 
			'idRecetaDetalle' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FarmaciaRecetasDetalleModificar :cantidad, :idFacturacionBienes, :idAtencionReceta, :idRecetaDetalle, :idUsuarioAuditoria";

		$params = [
			'cantidad' => ($oTabla->cantidad == "")? Null: $oTabla->cantidad, 
			'idFacturacionBienes' => ($oTabla->idFacturacionBienes == "")? Null: $oTabla->idFacturacionBienes, 
			'idAtencionReceta' => ($oTabla->idAtencionReceta == "")? Null: $oTabla->idAtencionReceta, 
			'idRecetaDetalle' => ($oTabla->idRecetaDetalle == "")? Null: $oTabla->idRecetaDetalle, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FarmaciaRecetasDetalleEliminar :idRecetaDetalle, :idUsuarioAuditoria";

		$params = [
			'idRecetaDetalle' => ($oTabla->idRecetaDetalle == "")? Null: $oTabla->idRecetaDetalle, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FarmaciaRecetasDetalleSeleccionarPorId :idRecetaDetalle";

		$params = [
			'idRecetaDetalle' => $oTabla->idRecetaDetalle, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdReceta($lIdReceta)
	{
		$query = "
			EXEC CommandText = sSQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}