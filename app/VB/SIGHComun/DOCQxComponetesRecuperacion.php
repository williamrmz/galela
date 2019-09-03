<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxComponetesRecuperacion extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idProgramacionSala', 
		'conexion', 
		'idUsuarioAuditoria', 
		'idComponentesRecPostAnestesica', 
		'mensajeError', 
		'valorIngreso', 
		'valorEgreso', 
		'idUsuario', 
		'estacion', 
	];
}