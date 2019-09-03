<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOFacturacionPAgosACuenta extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idAtencion', 
		'idPagosACuenta', 
		'totalPagado', 
		'fechaPago', 
		'idComprobantePago', 
		'idEmpleadoCajero', 
	];
}