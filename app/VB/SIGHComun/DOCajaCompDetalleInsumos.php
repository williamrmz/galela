<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCajaCompDetalleInsumos extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'subTotalPagado', 
		'cantidad', 
		'precioUnitario', 
		'idComprobanteDetalleBienes', 
		'idFacturacionBienes', 
		'esPagoACuenta', 
		'idComprobantePago', 
		'idProducto', 
	];
}