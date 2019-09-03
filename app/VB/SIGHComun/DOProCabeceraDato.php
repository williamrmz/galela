<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOProCabeceraDato extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idPrograma', 
		'idProCabecera', 
		'idCabDato', 
		'cabDato', 
	];
}