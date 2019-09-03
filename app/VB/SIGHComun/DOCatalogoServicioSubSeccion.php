<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCatalogoServicioSubSeccion extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'codigo', 
		'idServicioSeccion', 
		'descripcion', 
		'idServicioSubSeccion', 
	];
}