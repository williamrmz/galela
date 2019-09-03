<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxProgramacionRoles extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idProgramacionRoles', 
		'idMedico', 
		'idRolesCQx', 
		'idProgramacionSala', 
		'fecha', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
	];
}