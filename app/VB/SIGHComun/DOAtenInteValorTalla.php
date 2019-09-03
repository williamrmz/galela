<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtenInteValorTalla extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idValorTalla', 
		'idTipoSexo', 
		'edadMeses', 
		'nroDesviacion', 
		'valorTalla', 
	];
}