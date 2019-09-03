<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxIndicacionAltaCab extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idIndicacionAltaCab', 
		'idProgramacionSala', 
		'idOrdenOperatoriaMQ', 
		'idMedico', 
		'fecha', 
		'hora', 
		'nroIndicacionAlta', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
	];
}