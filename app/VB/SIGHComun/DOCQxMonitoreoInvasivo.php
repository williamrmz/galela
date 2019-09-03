<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxMonitoreoInvasivo extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idProgramacionSala', 
		'conexion', 
		'idUsuarioAuditoria', 
		'idMonitoreoInvasivo', 
		'mensajeError', 
		'valor', 
		'idUsuario', 
		'estacion', 
	];
}