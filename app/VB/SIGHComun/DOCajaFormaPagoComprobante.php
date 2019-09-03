<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCajaFormaPagoComprobante extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'tipoCambio', 
		'totalSoles', 
		'importe', 
		'idComprobantePago', 
		'idTipoMoneda', 
		'idTipoFormaPago', 
		'idFormaPago', 
	];
}