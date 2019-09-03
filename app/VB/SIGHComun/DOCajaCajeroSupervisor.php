<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCajaCajeroSupervisor extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idSupervisor', 
		'idTurno', 
		'idCajero', 
		'idCajeroSupervisor', 
	];
}