<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class HIS_DetalleDx_Verifica extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC HIS_DetalleDx_VerificaAgregar :idHisDetalle, :idCIE, :idSubClasificacionDX, :codLAB, :idUsuarioAuditoria";

		$params = [
			'idHisDetalle' => ($oTabla->idHisDetalle == 0)? Null: $oTabla->idHisDetalle, 
			'idCIE' => ($oTabla->idCIE == 0)? Null: $oTabla->idCIE, 
			'idSubClasificacionDX' => ($oTabla->idSubClasificacionDX == 0)? Null: $oTabla->idSubClasificacionDX, 
			'codLAB' => ($oTabla->codLAB == "")? Null: $oTabla->codLAB, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC HIS_DetalleDx_VerificaModificar :idHisDetalle, :idCIE, :idSubClasificacionDX, :codLAB, :idUsuarioAuditoria";

		$params = [
			'idHisDetalle' => ($oTabla->idHisDetalle == 0)? Null: $oTabla->idHisDetalle, 
			'idCIE' => ($oTabla->idCIE == 0)? Null: $oTabla->idCIE, 
			'idSubClasificacionDX' => ($oTabla->idSubClasificacionDX == 0)? Null: $oTabla->idSubClasificacionDX, 
			'codLAB' => ($oTabla->codLAB == "")? Null: $oTabla->codLAB, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($lnIdHisDetalle)
	{
		$query = "
			EXEC HIS_DetalleDx_VerificaEliminar :idHisDetalle, :idUsuarioAuditoria";

		$params = [
			'idHisDetalle' => $lnIdHisDetalle, 
			'idUsuarioAuditoria' => 0, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC HIS_DetalleDx_VerificaSeleccionarPorId :idHisDetalle";

		$params = [
			'idHisDetalle' => $oTabla->idHisDetalle, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function His_ConsultaDxHisDetalleVerif($ml_IdDetalleHIS)
	{
		$query = "
			EXEC His_ConsultaDxHisDetalleVerif :ml_IdDetalleHIS";

		$params = [
			'ml_IdDetalleHIS' => $ml_IdDetalleHIS, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}