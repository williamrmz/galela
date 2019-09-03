<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOLabMovimientoIngresos extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idMovimiento', 
		'nroDocumento', 
		'idPersonaRecepciona', 
	];
}