<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOEstablecimiento extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idTipo', 
		'idDistrito', 
		'nombre', 
		'codigo', 
		'idEstablecimiento', 
	];
}