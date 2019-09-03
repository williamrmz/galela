<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOImagCatalgoServicioDuracion extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idProducto', 
		'duracionEnMin', 
		'esActivo', 
		'fechaCrea', 
		'fechaEdita', 
	];
}