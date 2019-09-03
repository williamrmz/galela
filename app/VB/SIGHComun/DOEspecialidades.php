<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOEspecialidades extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idAtencion', 
		'idSolicitudEspecialidades', 
		'idUsuarioAuditoria', 
		'tiempoPromedioConsulta', 
		'idDepartamento', 
		'nombre', 
		'idEspecialidad', 
		'estadoReg', 
		'fechaReg', 
	];
}