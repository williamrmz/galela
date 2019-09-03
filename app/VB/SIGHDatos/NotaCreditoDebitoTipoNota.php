<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class NotaCreditoDebitoTipoNota extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC NotaCreditoDebitoTipoNotaAgregar :idTipoNota, :tipoNota, :nroSerie, :nroDocumento, :nroDocumentoInicial, :nroDocumentoFinal, :idUsuarioAuditoria";

		$params = [
			'idTipoNota' => $oTabla->idTipoNota, 
			'tipoNota' => ($oTabla->nroSerie == "")? Null: $oTabla->tipoNota, 
			'nroSerie' => ($oTabla->nroSerie == "")? Null: $oTabla->nroSerie, 
			'nroDocumento' => ($oTabla->nroDocumento == "")? Null: $oTabla->nroDocumento, 
			'nroDocumentoInicial' => ($oTabla->nroDocumentoInicial == "")? Null: $oTabla->nroDocumentoInicial, 
			'nroDocumentoFinal' => ($oTabla->nroDocumentoFinal == "")? Null: $oTabla->nroDocumentoFinal, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC NotaCreditoDebitoTipoNotaModificar :idTipoNota, :tipoNota, :nroSerie, :nroDocumento, :nroDocumentoInicial, :nroDocumentoFinal, :idUsuarioAuditoria";

		$params = [
			'idTipoNota' => $oTabla->idTipoNota, 
			'tipoNota' => ($oTabla->nroSerie == "")? Null: $oTabla->tipoNota, 
			'nroSerie' => ($oTabla->nroSerie == "")? Null: $oTabla->nroSerie, 
			'nroDocumento' => ($oTabla->nroDocumento == "")? Null: $oTabla->nroDocumento, 
			'nroDocumentoInicial' => ($oTabla->nroDocumentoInicial == "")? Null: $oTabla->nroDocumentoInicial, 
			'nroDocumentoFinal' => ($oTabla->nroDocumentoFinal == "")? Null: $oTabla->nroDocumentoFinal, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC NotaCreditoDebitoTipoNotaEliminar :idTipoNota, :idUsuarioAuditoria";

		$params = [
			'idTipoNota' => $oTabla->idTipoNota, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorIdTipoNota($oTabla)
	{
		$query = "
			EXEC NotaCreditoDebitoTipoNotaSeleccionarPorId :idTipoNota";

		$params = [
			'idTipoNota' => $oTabla->idTipoNota, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}