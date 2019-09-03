<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCajaComprobantesDetalle extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'subTotalPagado', 
		'cantidad', 
		'precioUnitario', 
		'idComprobanteDetalle', 
		'idComprobantePago', 
		'idProducto', 
		'nombreProducto', 
		'tipoDetalle', 
		'codigoProducto', 
		'idFacturacionDetalle', 
		'idEstadoFacturacion', 
		'subTotalExonerado', 
		'subTotalPagadoACuenta', 
		'esPagoACuenta', 
	];
}