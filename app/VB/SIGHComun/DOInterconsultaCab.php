<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOInterconsultaCab extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idInterconsultaCab', 
		'idAtencion', 
		'idInterconsulta', 
		'idServicioS', 
		'idEspecialidad', 
		'idMedicoS', 
		'idMedicoR', 
		'idPaciente', 
		'idCama', 
		'estadoReg', 
		'estacion', 
		'fechaReg', 
	];
}