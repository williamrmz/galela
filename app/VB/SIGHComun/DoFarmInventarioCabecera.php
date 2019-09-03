<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFarmInventarioCabecera extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'cantidadSobrante', 
		'cantidadFaltante', 
		'cantidadSaldo', 
		'idUsuarioAuditoria', 
		'idInventario', 
		'idProducto', 
		'cantidad', 
		'precio', 
		'total', 
	];
}