<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCajaCompDetalleServicios extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idFacturacionServicio', 
		'esPagoACuenta', 
		'idProducto', 
		'subTotalPagado', 
		'cantidad', 
		'precioUnitario', 
		'idComprobantePago', 
		'idComprobanteDetalleServicio', 
	];
}