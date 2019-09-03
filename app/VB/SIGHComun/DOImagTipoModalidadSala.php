<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOImagTipoModalidadSala extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idTipoModalidadSala', 
		'tipoModalidadSala', 
		'codigo', 
		'esActivo', 
		'fechaCrea', 
		'fechaEdita', 
	];
}