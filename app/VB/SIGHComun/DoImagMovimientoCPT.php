<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoImagMovimientoCPT extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idMovimiento', 
		'idProductoCpt', 
		'cantidad', 
		'precio', 
		'importe', 
	];
}