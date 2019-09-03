<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOTriajeExcepciones extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idTriajeExcepciones', 
		'idTriajeVariable', 
		'edadInicialEnDia', 
		'edadFinalEnDia', 
		'esDatoObligatorio', 
	];
}