<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoProControlDato extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idPrograma', 
		'idProCabecera', 
		'idControl', 
		'idControlDato', 
		'controlDato', 
	];
}