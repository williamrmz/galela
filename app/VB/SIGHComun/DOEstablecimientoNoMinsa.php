<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOEstablecimientoNoMinsa extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'codigo', 
		'idUsuarioAuditoria', 
		'idDistrito', 
		'idTipoSubsector', 
		'nombre', 
		'idEstablecimientoNoMinsa', 
	];
}