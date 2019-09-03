<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DORolItem extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'consultar', 
		'eliminar', 
		'modificar', 
		'agregar', 
		'idRol', 
		'idListItem', 
		'idRolItem', 
	];
	
}