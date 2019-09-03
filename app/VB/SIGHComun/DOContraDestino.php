<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOContraDestino extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idCuentaAtencion', 
		'idDestino', 
		'tratamiento', 
		'recomendaciones', 
	];
}