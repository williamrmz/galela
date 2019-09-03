<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOImagSala extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idSala', 
		'idTipoModalidadSala', 
		'sala', 
		'codigo', 
		'esActivo', 
		'fechaCrea', 
		'fechaEdita', 
	];
}