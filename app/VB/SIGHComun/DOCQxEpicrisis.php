<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxEpicrisis extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idEpicrisis', 
		'idProgramacionSala', 
		'idOrdenOperatoriaMQ', 
		'idMedico', 
		'observaciones', 
		'fecha', 
		'nroEpicrisis', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
	];
}