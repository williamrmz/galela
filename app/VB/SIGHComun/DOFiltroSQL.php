<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOFiltroSQL extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idUsuario', 
		'filtroSQL', 
		'descripcion', 
		'codigo', 
		'idFiltro', 
	];
}