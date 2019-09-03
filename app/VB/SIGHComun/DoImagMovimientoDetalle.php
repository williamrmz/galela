<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoImagMovimientoDetalle extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idProductoCpt', 
		'idUsuarioAuditoria', 
		'idMovimiento', 
		'idProducto', 
		'cantidad', 
		'cantidadFallada', 
	];
}