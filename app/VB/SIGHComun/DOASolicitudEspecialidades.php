<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOASolicitudEspecialidades extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idSolicitudEspecialidad', 
		'idAtencion', 
		'idEspecialidad', 
		'idDiagnostico', 
		'idUsuario', 
		'fechaSolicitud', 
		'idEstado', 
		'motivo', 
	];
}