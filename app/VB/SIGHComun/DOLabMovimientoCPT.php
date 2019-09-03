<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOLabMovimientoCPT extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'observaciones', 
		'idUsuarioAuditoria', 
		'idMovimiento', 
		'idProductoCpt', 
		'cantidad', 
		'precio', 
		'importe', 
		'fechaTomaMuestra', 
	];
}