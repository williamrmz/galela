<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOListbarItem extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'keyIcon', 
		'indice', 
		'clave', 
		'texto', 
		'idListGrupo', 
		'idListItem', 
	];
}