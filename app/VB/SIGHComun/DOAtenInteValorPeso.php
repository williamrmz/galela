<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtenInteValorPeso extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idValorPeso', 
		'idTipoSexo', 
		'edadMeses', 
		'nroDesviacion', 
		'valorPeso', 
	];
}