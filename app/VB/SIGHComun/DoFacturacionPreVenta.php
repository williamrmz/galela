<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFacturacionPreVenta extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idFactPreventa', 
		'idProducto', 
		'cantidad', 
		'precio', 
		'importe', 
	];
}