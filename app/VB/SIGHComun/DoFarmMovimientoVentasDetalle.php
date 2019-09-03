<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFarmMovimientoVentasDetalle extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'movNumero', 
		'movTipo', 
		'idProducto', 
		'cantidad', 
		'precio', 
		'total', 
	];
}