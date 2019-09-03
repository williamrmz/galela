<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFacturacionServicioPagos extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idOrdenPago', 
		'idProducto', 
		'cantidad', 
		'precio', 
		'total', 
	];
}