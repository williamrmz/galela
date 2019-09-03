<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CajaNroDocumento extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC CajaNroDocumentoAgregar :idTipoComprobante, :nroDocumento, :nroSerie, :nroDocumentoFinal, :idCaja, :nroDocumentoInicial, :idUsuarioAuditoria";

		$params = [
			'idTipoComprobante' => ($oTabla->idTipoComprobante == 0)? Null: $oTabla->idTipoComprobante, 
			'nroDocumento' => ($oTabla->nroDocumento == "")? Null: $oTabla->nroDocumento, 
			'nroSerie' => ($oTabla->nroSerie == "")? Null: $oTabla->nroSerie, 
			'nroDocumentoFinal' => ($oTabla->nroDocumentoFinal == "")? Null: $oTabla->nroDocumentoFinal, 
			'idCaja' => ($oTabla->idTipoComprobante == 0)? Null: $oTabla->idCaja, 
			'nroDocumentoInicial' => ($oTabla->nroDocumentoInicial == "")? Null: $oTabla->nroDocumentoInicial, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CajaNroDocumentoModificar :idTipoComprobante, :nroDocumento, :nroSerie, :nroDocumentoFinal, :idCaja, :nroDocumentoInicial, :idUsuarioAuditoria";

		$params = [
			'idTipoComprobante' => ($oTabla->idTipoComprobante == 0)? Null: $oTabla->idTipoComprobante, 
			'nroDocumento' => ($oTabla->nroDocumento == "")? Null: $oTabla->nroDocumento, 
			'nroSerie' => ($oTabla->nroSerie == "")? Null: $oTabla->nroSerie, 
			'nroDocumentoFinal' => ($oTabla->nroDocumentoFinal == "")? Null: $oTabla->nroDocumentoFinal, 
			'idCaja' => ($oTabla->idCaja == 0)? Null: $oTabla->idCaja, 
			'nroDocumentoInicial' => ($oTabla->nroDocumentoInicial == "")? Null: $oTabla->nroDocumentoInicial, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CajaNroDocumentoEliminar :idTipoComprobante, :idCaja, :idUsuarioAuditoria";

		$params = [
			'idTipoComprobante' => ($oTabla->idTipoComprobante == 0)? Null: $oTabla->idTipoComprobante, 
			'idCaja' => ($oTabla->idCaja == 0)? Null: $oTabla->idCaja, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CajaNroDocumentoSeleccionarPorId :idTipoComprobante, :idCaja";

		$params = [
			'idTipoComprobante' => $oTabla->idTipoComprobante, 
			'idCaja' => $oTabla->idCaja, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarPorCaja($lIdCaja)
	{
		$query = "
			EXEC CajaNroDocumentoEliminarXidCaja :lIdCaja";

		$params = [
			'lIdCaja' => $lIdCaja, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorIdCaja($lIdCaja)
	{
		$query = "
			EXEC CajaNroDocumentoSeleccionarPorIdCaja :lIdCaja";

		$params = [
			'lIdCaja' => $lIdCaja, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdCajaYTipoComprobante($lIdCaja, $tipoComprobante)
	{
		$query = "
			EXEC CajaNroDocumentoSeleccionarPorIdCajaYTipoComprobante :tipoComprobante, :lIdCaja";

		$params = [
			'tipoComprobante' => $tipoComprobante, 
			'lIdCaja' => $lIdCaja, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AumentarPorIdCajaYTipoComprobante($nuevoNroDocumento, $idTipoComprobante, $idCaja)
	{
		$query = "
			EXEC CommandText = sSq ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}