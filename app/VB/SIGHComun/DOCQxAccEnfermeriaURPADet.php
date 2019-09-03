<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxAccEnfermeriaURPADet extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idProgramacionSala', 
		'conexion', 
		'idUsuarioAuditoria', 
		'idAccionesEnfermeria', 
		'mensajeError', 
		'nroRegistroEnfermeriaURPA', 
		'valor', 
		'idUsuario', 
		'estacion', 
	];
}