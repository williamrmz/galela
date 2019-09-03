<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOEspecialidadCE extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idProductoInterconsulta', 
		'idProductoConsulta', 
		'tiempoPromedioAtencion', 
		'idEspecialidad', 
		'idEspecialidadCE', 
	];
}