<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOEnfermeria_Variables extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idCuentaAtencion', 
		'idVisita', 
		'idVariable', 
		'variableDato', 
	];
}