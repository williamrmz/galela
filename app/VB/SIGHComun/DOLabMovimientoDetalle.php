<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOLabMovimientoDetalle extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idMovimiento', 
		'idProductoCpt', 
		'idProducto', 
		'cantidadFallada', 
		'cantidad', 
	];
}