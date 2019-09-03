<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxRegVerificacionCDet extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idProgramacionSala', 
		'idOrdenOperatoriaMQ', 
		'idPreguntasVerificacionCirugiaCQx', 
		'si', 
		'no', 
		'fecha', 
		'hora', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
	];
}