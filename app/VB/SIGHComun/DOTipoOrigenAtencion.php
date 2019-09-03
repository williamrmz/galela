<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOTipoOrigenAtencion extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idTipoServicio', 
		'descripcion', 
		'codigo', 
		'idOrigenAtencion', 
	];
}