<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCajaComprobantesPago extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idTipoFinanciamiento', 
		'adelantos', 
		'exoneraciones', 
		'idCajero', 
		'idCaja', 
		'idTurno', 
		'idFarmacia', 
		'idFormaPago', 
		'idPaciente', 
		'idUsuarioAuditoria', 
		'tipoCambio', 
		'nroSerie', 
		'nroDocumento', 
		'razonSocial', 
		'ruc', 
		'subTotal', 
		'iGV', 
		'idComprobantePago', 
		'fechaCobranza', 
		'idTipoOrden', 
		'observaciones', 
		'idTipoComprobante', 
		'idCuentaAtencion', 
		'idEstadoComprobante', 
		'idGestionCaja', 
		'idTipoPago', 
		'total', 
		'dctos', 
	];
}