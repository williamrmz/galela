<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxAdmisionMQPacientes extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'admitido', 
		'conexion', 
		'idUsuarioAuditoria', 
		'mensajeError', 
		'idOrdenOperatoria', 
		'idMedico', 
		'idUsuario', 
		'estacion', 
	];
}