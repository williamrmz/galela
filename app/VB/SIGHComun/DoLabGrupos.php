<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoLabGrupos extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idGrupo', 
		'nombreGrupo', 
		'siglasGrupo', 
		'idCargo', 
	];
}