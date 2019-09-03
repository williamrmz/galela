<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOTiposRolesCQx extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idRolesCQx', 
		'descripcion', 
		'bit', 
		'orden', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
	];
}