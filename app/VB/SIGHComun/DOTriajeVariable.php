<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOTriajeVariable extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idTriajeVariable', 
		'triajeVariable', 
		'esAntropometrica', 
		'tieneLimiteMedicion', 
		'edadDiaLimiteMinima', 
		'edadDiaLimiteMaxima', 
		'esDatoObligatorio', 
		'esActivo', 
	];
}