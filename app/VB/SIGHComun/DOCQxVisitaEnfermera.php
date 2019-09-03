<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxVisitaEnfermera extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idVisitaEnfermera', 
		'idProgramacionSala', 
		'idOrdenOperatoriaMQ', 
		'idVisita', 
		'idMedico', 
		'idCQxEtapas', 
		'fechaHoraVisita', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
		'desMedico', 
	];
}