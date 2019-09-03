<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCitaBloqueada extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idCitaBloqueada', 
		'horaBloqueo', 
		'fechaBloqueo', 
		'idMedico', 
		'horaFin', 
		'horaInicio', 
		'fecha', 
		'idUsuario', 
	];
}