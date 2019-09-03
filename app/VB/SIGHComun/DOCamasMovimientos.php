<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCamasMovimientos extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idMovimiento', 
		'idCama', 
		'idServicio', 
		'idFechaIngreso', 
		'idFechaSalida', 
	];
}