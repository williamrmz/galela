<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FactReembolsos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idFactReembolso AS Int = :idFactReembolso
			SET NOCOUNT ON 
			EXEC FactReembolsosAgregar @idFactReembolso OUTPUT, :anio, :mes, :idAreaTramitaSeguro, :idFuenteFinanciamiento, :descripcion, :saldoInicial, :consumoPorReembolsar, :reembolsoPagado, :reembolsoPorPagar, :saldoFinal, :documentos, :idEstadoReembolso, :idTipoConsumo, :idTipoComprobante, :grabaDefinitivamente, :idUsuarioAuditoria
			SELECT @idFactReembolso AS idFactReembolso";

		$params = [
			'idFactReembolso' => 0, 
			'anio' => ($oTabla->anio == 0)? Null: $oTabla->anio, 
			'mes' => ($oTabla->mes == 0)? Null: $oTabla->mes, 
			'idAreaTramitaSeguro' => ($oTabla->idAreaTramitaSeguro == 0)? Null: $oTabla->idAreaTramitaSeguro, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'saldoInicial' => $oTabla->saldoInicial, 
			'consumoPorReembolsar' => $oTabla->consumoPorReembolsar, 
			'reembolsoPagado' => $oTabla->reembolsoPagado, 
			'reembolsoPorPagar' => $oTabla->reembolsoPorPagar, 
			'saldoFinal' => $oTabla->saldoFinal, 
			'documentos' => ($oTabla->documentos == "")? Null: $oTabla->documentos, 
			'idEstadoReembolso' => ($oTabla->idEstadoReembolso == 0)? Null: $oTabla->idEstadoReembolso, 
			'idTipoConsumo' => $oTabla->idTipoConsumo, 
			'idTipoComprobante' => ($oTabla->idTipoComprobante == 0)? Null: $oTabla->idTipoComprobante, 
			'grabaDefinitivamente' => $oTabla->grabaDefinitivamente = True, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FactReembolsosModificar :idFactReembolso, :anio, :mes, :idAreaTramitaSeguro, :idFuenteFinanciamiento, :descripcion, :saldoInicial, :consumoPorReembolsar, :reembolsoPagado, :reembolsoPorPagar, :saldoFinal, :documentos, :idEstadoReembolso, :idTipoConsumo, :idTipoComprobante, :grabaDefinitivamente, :idUsuarioAuditoria";

		$params = [
			'idFactReembolso' => ($oTabla->idFactReembolso == 0)? Null: $oTabla->idFactReembolso, 
			'anio' => ($oTabla->anio == 0)? Null: $oTabla->anio, 
			'mes' => ($oTabla->mes == 0)? Null: $oTabla->mes, 
			'idAreaTramitaSeguro' => ($oTabla->idAreaTramitaSeguro == 0)? Null: $oTabla->idAreaTramitaSeguro, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'saldoInicial' => $oTabla->saldoInicial, 
			'consumoPorReembolsar' => $oTabla->consumoPorReembolsar, 
			'reembolsoPagado' => $oTabla->reembolsoPagado, 
			'reembolsoPorPagar' => $oTabla->reembolsoPorPagar, 
			'saldoFinal' => $oTabla->saldoFinal, 
			'documentos' => ($oTabla->documentos == "")? Null: $oTabla->documentos, 
			'idEstadoReembolso' => $oTabla->idEstadoReembolso, 
			'idTipoConsumo' => $oTabla->idTipoConsumo, 
			'idTipoComprobante' => ($oTabla->idTipoComprobante == 0)? Null: $oTabla->idTipoComprobante, 
			'grabaDefinitivamente' => $oTabla->grabaDefinitivamente = True, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FactReembolsosEliminar :idFactReembolso, :idUsuarioAuditoria";

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
			EXEC FactReembolsosSeleccionarPorId :idFactReembolso";

		$params = [
			'idFactReembolso' => $oTabla->idFactReembolso, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}