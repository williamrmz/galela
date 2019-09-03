<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOEnfermeria_TratamientoDosis extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idCuentaAtencion', 
		'idVisita', 
		'idDiaVisita', 
		'idReceta', 
		'idItem', 
		'dosis', 
		'datoProrenata', 
	];
}