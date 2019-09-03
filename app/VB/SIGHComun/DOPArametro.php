<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOPArametro extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'grupo', 
		'idUsuarioAuditoria', 
		'descripcion', 
		'codigo', 
		'tipo', 
		'idParametro', 
		'valorFloat', 
		'valorInt', 
		'valorTexto', 
	];
}