<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FactReembolsosDocumentos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC FactReembolsosDocumentosAgregar :idFactReembolso, :idComprobantePago, :nroSerie, :nroDocumento, :motivoAnulacion, :idUsuarioAuditoria";

		$params = [
			'idFactReembolso' => ($oTabla->idFactReembolso == 0)? Null: $oTabla->idFactReembolso, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'nroSerie' => ($oTabla->nroSerie == "")? Null: $oTabla->nroSerie, 
			'nroDocumento' => ($oTabla->nroDocumento == "")? Null: $oTabla->nroDocumento, 
			'motivoAnulacion' => ($oTabla->motivoAnulacion == "")? Null: $oTabla->motivoAnulacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactReembolsosDocumentosModificar :idFactReembolso, :idComprobantePago, :nroSerie, :nroDocumento, :motivoAnulacion, :idUsuarioAuditoria";

		$params = [
			'idFactReembolso' => ($oTabla->idFactReembolso == 0)? Null: $oTabla->idFactReembolso, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'nroSerie' => ($oTabla->nroSerie == "")? Null: $oTabla->nroSerie, 
			'nroDocumento' => ($oTabla->nroDocumento == "")? Null: $oTabla->nroDocumento, 
			'motivoAnulacion' => ($oTabla->motivoAnulacion == "")? Null: $oTabla->motivoAnulacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactReembolsosDocumentosEliminar :idFactReembolso, :idUsuarioAuditoria";

		$params = [
			'idFactReembolso' => $oTabla->idFactReembolso, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FactReembolsosDocumentosSeleccionarPorId :idFactReembolso";

		$params = [
			'idFactReembolso' => $oTabla->idFactReembolso, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}