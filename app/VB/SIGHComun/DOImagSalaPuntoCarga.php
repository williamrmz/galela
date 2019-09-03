<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOImagSalaPuntoCarga extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idSala', 
		'idPuntoCarga', 
		'esActivo', 
		'fechsCrea', 
		'fechaEdita', 
	];
}