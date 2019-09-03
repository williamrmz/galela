<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FarmMovimientoNotaIngreso extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC farmMovimientoNotaIngresoAgregar :movNumero, :movTipo, :documentoFechaRecepcion, :origenIdTipo, :origenNumero, :origenFecha, :idProveedor, :idTipoCompra, :idTipoProceso, :numeroProceso, :idPaciente, :idCuentaAtencion, :idFuenteFinanciamiento, :idComprobantePago, :fechaModificacion, :idUsuarioModifica, :idUsuarioAuditoria";

		$params = [
			'movNumero' => ($oTabla->movNumero == "")? Null: $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'documentoFechaRecepcion' => ($oTabla->documentoFechaRecepcion == 0)? Null: $oTabla->documentoFechaRecepcion, 
			'origenIdTipo' => ($oTabla->origenIdTipo == 0)? Null: $oTabla->origenIdTipo, 
			'origenNumero' => ($oTabla->origenNumero == "")? Null: $oTabla->origenNumero, 
			'origenFecha' => ($oTabla->origenFecha == 0)? Null: $oTabla->origenFecha, 
			'idProveedor' => ($oTabla->idProveedor == 0)? Null: $oTabla->idProveedor, 
			'idTipoCompra' => ($oTabla->idTipoCompra == 0)? Null: $oTabla->idTipoCompra, 
			'idTipoProceso' => ($oTabla->idTipoProceso == 0)? Null: $oTabla->idTipoProceso, 
			'numeroProceso' => ($oTabla->numeroProceso == "")? Null: $oTabla->numeroProceso, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCuentaAtencion' => ($oTabla->idPaciente == 0)? Null: $oTabla->idCuentaAtencion, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'fechaModificacion' => ($oTabla->fechaModificacion == 0)? Null: $oTabla->fechaModificacion, 
			'idUsuarioModifica' => ($oTabla->idUsuarioModifica == 0)? Null: $oTabla->idUsuarioModifica, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC farmMovimientoNotaIngresoModificar :movNumero, :movTipo, :documentoFechaRecepcion, :origenIdTipo, :origenNumero, :origenFecha, :idProveedor, :idTipoCompra, :idTipoProceso, :numeroProceso, :idPaciente, :idCuentaAtencion, :idComprobantePago, :idFuenteFinanciamiento, :fechaModificacion, :idUsuarioModifica, :idUsuarioAuditoria";

		$params = [
			'movNumero' => ($oTabla->movNumero == "")? Null: $oTabla->movNumero, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'documentoFechaRecepcion' => ($oTabla->documentoFechaRecepcion == 0)? Null: $oTabla->documentoFechaRecepcion, 
			'origenIdTipo' => ($oTabla->origenIdTipo == 0)? Null: $oTabla->origenIdTipo, 
			'origenNumero' => ($oTabla->origenNumero == "")? Null: $oTabla->origenNumero, 
			'origenFecha' => ($oTabla->origenFecha == 0)? Null: $oTabla->origenFecha, 
			'idProveedor' => ($oTabla->idProveedor == 0)? Null: $oTabla->idProveedor, 
			'idTipoCompra' => ($oTabla->idTipoCompra == 0)? Null: $oTabla->idTipoCompra, 
			'idTipoProceso' => ($oTabla->idTipoProceso == 0)? Null: $oTabla->idTipoProceso, 
			'numeroProceso' => ($oTabla->numeroProceso == "")? Null: $oTabla->numeroProceso, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idCuentaAtencion' => ($oTabla->idPaciente == 0)? Null: $oTabla->idCuentaAtencion, 
			'idComprobantePago' => ($oTabla->idComprobantePago == 0)? Null: $oTabla->idComprobantePago, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'fechaModificacion' => ($oTabla->fechaModificacion == 0)? Null: $oTabla->fechaModificacion, 
			'idUsuarioModifica' => ($oTabla->idUsuarioModifica == 0)? Null: $oTabla->idUsuarioModifica, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC farmMovimientoNotaIngresoEliminar :movNumero, :movTipo, :idUsuarioAuditoria";

		$params = [
			'movNumero' => $oTabla->movNumero, 
			'movTipo' => $oTabla->movTipo, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC farmMovimientoNotaIngresoSeleccionarPorId :movNumero, :movTipo";

		$params = [
			'movNumero' => $oTabla->movNumero, 
			'movTipo' => $oTabla->movTipo, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}