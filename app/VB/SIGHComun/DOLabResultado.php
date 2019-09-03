<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class \DOLabResultado extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idAnalisis', 
		'idOrden', 
		'resultadoAnalisis', 
		'observacionResultado', 
		'idUsuario', 
	];
}