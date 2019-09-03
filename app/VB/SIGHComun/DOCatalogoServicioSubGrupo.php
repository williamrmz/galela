<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCatalogoServicioSubGrupo extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'codigo', 
		'idServicioGrupo', 
		'descripcion', 
		'idServicioSubGrupo', 
	];
}