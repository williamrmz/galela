<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CajaComprobantesPago extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idComprobantePago AS Int = :idComprobantePago
			SET NOCOUNT ON 
			EXEC CajaComprobantesPagoAgregar :tipoCambio, :nroSerie, :nroDocumento, :razonSocial, :rUC, :subTotal, :iGV, @idComprobantePago OUTPUT, :fechaCobranza, :idTipoOrden, :observaciones, :idTipoComprobante, :idCuentaAtencion, :idEstadoComprobante, :idGestionCaja, :idTipoPago, :total, :idUsuarioAuditoria, :idPaciente, :idFormaPago, :idFarmacia, :idCaja, :idTurno, :idCajero, :exoneraciones, :dctos, :adelantos, :idTipoFinanciamiento
			SELECT @idComprobantePago AS idComprobantePago";

		$params = [
			'tipoCambio' => ($oTabla->tipoCambio == 0)? Null: $oTabla->tipoCambio, 
			'nroSerie' => ($oTabla->nroSerie == "")? Null: $oTabla->nroSerie, 
			'nroDocumento' => ($oTabla->nroDocumento == "")? Null: $oTabla->nroDocumento, 
			'razonSocial' => ($oTabla->razonSocial == "")? Null: Left($oTabla->razonSocial, 
			'rUC' => ($oTabla->rUC == "")? Null: $oTabla->rUC, 
			'subTotal' => $oTabla->subTotal, 
			'iGV' => $oTabla->iGV, 
			'idComprobantePago' => 0, 
			'fechaCobranza' => ($oTabla->fechaCobranza == 0)? Null: $oTabla->fechaCobranza, 
			'idTipoOrden' => ($oTabla->idTipoOrden == 0)? Null: $oTabla->idTipoOrden, 
			'observaciones' => ($oTabla->observaciones == "")? Null: $oTabla->observaciones, 
			'idTipoComprobante' => ($oTabla->idTipoComprobante == 0)? Null: $oTabla->idTipoComprobante, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idEstadoComprobante' => ($oTabla->idEstadoComprobante == 0)? Null: $oTabla->idEstadoComprobante, 
			'idGestionCaja' => ($oTabla->idGestionCaja == 0)? Null: $oTabla->idGestionCaja, 
			'idTipoPago' => ($oTabla->idTipoPago == 0)? Null: $oTabla->idTipoPago, 
			'total' => $oTabla->total, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idFormaPago' => ($oTabla->idFormaPago == 0)? Null: $oTabla->idFormaPago, 
			'idFarmacia' => ($oTabla->idFarmacia == 0)? Null: $oTabla->idFarmacia, 
			'idCaja' => ($oTabla->idCaja == 0)? Null: $oTabla->idCaja, 
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'idCajero' => ($oTabla->idCajero == 0)? Null: $oTabla->idCajero, 
			'exoneraciones' => $oTabla->exoneraciones, 
			'dctos' => $oTabla->dctos, 
			'adelantos' => $oTabla->adelantos, 
			'idTipoFinanciamiento' => ($oTabla->idTipoFinanciamiento == 0)? Null: $oTabla->idTipoFinanciamiento, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CajaComprobantesPagoModificar :tipoCambio, :nroSerie, :nroDocumento, :razonSocial, :rUC, :subTotal, :iGV, :idComprobantePago, :fechaCobranza, :idTipoOrden, :observaciones, :idTipoComprobante, :idCuentaAtencion, :idEstadoComprobante, :idGestionCaja, :idTipoPago, :total, :idUsuarioAuditoria, :idPaciente, :idFormaPago, :idFarmacia, :idCaja, :idTurno, :idCajero";

		$params = [
			'tipoCambio' => ($oTabla->tipoCambio == 0)? Null: $oTabla->tipoCambio, 
			'nroSerie' => ($oTabla->nroSerie == "")? Null: $oTabla->nroSerie, 
			'nroDocumento' => ($oTabla->nroDocumento == "")? Null: $oTabla->nroDocumento, 
			'razonSocial' => ($oTabla->razonSocial == "")? Null: Left($oTabla->razonSocial, 
			'rUC' => ($oTabla->rUC == "")? Null: $oTabla->rUC, 
			'subTotal' => ($oTabla->subTotal == 0)? Null: $oTabla->subTotal, 
			'iGV' => $oTabla->iGV, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'fechaCobranza' => ($oTabla->fechaCobranza == 0)? Null: $oTabla->fechaCobranza, 
			'idTipoOrden' => ($oTabla->idTipoOrden == 0)? Null: $oTabla->idTipoOrden, 
			'observaciones' => ($oTabla->observaciones == "")? Null: $oTabla->observaciones, 
			'idTipoComprobante' => ($oTabla->idTipoComprobante == 0)? Null: $oTabla->idTipoComprobante, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idEstadoComprobante' => ($oTabla->idEstadoComprobante == 0)? Null: $oTabla->idEstadoComprobante, 
			'idGestionCaja' => ($oTabla->idGestionCaja == 0)? Null: $oTabla->idGestionCaja, 
			'idTipoPago' => ($oTabla->idTipoPago == 0)? Null: $oTabla->idTipoPago, 
			'total' => $oTabla->total, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idFormaPago' => ($oTabla->idFormaPago == 0)? Null: $oTabla->idFormaPago, 
			'idFarmacia' => ($oTabla->idFarmacia == 0)? Null: $oTabla->idFarmacia, 
			'idCaja' => ($oTabla->idCaja == 0)? Null: $oTabla->idCaja, 
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'idCajero' => ($oTabla->idCajero == 0)? Null: $oTabla->idCajero, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CajaComprobantesPagoEliminar :idComprobantePago, :idUsuarioAuditoria";

		$params = [
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CajaComprobantesPagoSeleccionarPorId :idComprobantePago";

		$params = [
			'idComprobantePago' => $oTabla->idComprobantePago, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCuentaAtencion($oTabla)
	{
		$query = "
			EXEC CajaComprobantesPagoXidCuentaAtencion :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $oTabla->idCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AnularComprobanteYOrdenServicio($lIdComprobantePago, $lIdUsuario)
	{
		$query = "
			EXEC CajaComprobantesAnularComprobanteYOrdenServicio :idComprobantePago, :idUsuarioAuditoria";

		$params = [
			'idComprobantePago' => $lIdComprobantePago, 
			'idUsuarioAuditoria' => $lIdUsuario, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AnularComprobanteYOrdenBienInsumo($lIdComprobantePago, $lIdUsuario)
	{
		$query = "
			EXEC CajaComprobantesAnularComprobanteYOrdenBienInsumo :idComprobantePago, :idUsuarioAuditoria";

		$params = [
			'idComprobantePago' => $lIdComprobantePago, 
			'idUsuarioAuditoria' => $lIdUsuario, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function DevolverComprobanteYOrdenServicio($lIdComprobantePago, $lIdComprobanteDeDevolucion, $lIdUsuario)
	{
		$query = "
			EXEC CajaComprobantesDevolverComprobanteYOrdenServicio :idComprobantePago, :idComprobantePagoDevolucion, :idUsuarioAuditoria";

		$params = [
			'idComprobantePago' => $lIdComprobantePago, 
			'idComprobantePagoDevolucion' => $lIdComprobanteDeDevolucion, 
			'idUsuarioAuditoria' => $lIdUsuario, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function DevolverComprobanteYOrdenBienInsumo($lIdComprobantePago, $lIdComprobanteDeDevolucion, $lIdUsuario)
	{
		$query = "
			EXEC CajaComprobantesDevolverComprobanteYOrdenBienInsumo :idComprobantePago, :idComprobantePagoDevolucion, :idUsuarioAuditoria";

		$params = [
			'idComprobantePago' => $lIdComprobantePago, 
			'idComprobantePagoDevolucion' => $lIdComprobanteDeDevolucion, 
			'idUsuarioAuditoria' => $lIdUsuario, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}