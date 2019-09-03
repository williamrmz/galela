<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOServicioUtilizado extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idServicio', 
		'duracionDias', 
	];
}