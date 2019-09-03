<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFarmPreVentaDetalle extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idPreventa', 
		'idProducto', 
		'item', 
		'cantidad', 
		'precio', 
		'importe', 
	];
}