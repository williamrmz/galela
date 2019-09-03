<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOFactPuntoCarga extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idServicio', 
		'idUPS', 
		'idUsuarioAuditoria', 
		'tipoPunto', 
		'descripcion', 
		'idPuntoCarga', 
	];
}