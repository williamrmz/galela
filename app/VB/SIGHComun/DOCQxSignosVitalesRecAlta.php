<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxSignosVitalesRecAlta extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idProgramacionSala', 
		'conexion', 
		'idUsuarioAuditoria', 
		'idSignosVitales', 
		'mensajeError', 
		'variableDato', 
		'idUsuario', 
		'estacion', 
	];
}