<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxProgramacionSala extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'nombreSala', 
		'idUsuarioAuditoria', 
		'idProgramacionSala', 
		'fecha', 
		'horaIngreso', 
		'horaSalida', 
		'idOrdenOperatoriaMQ', 
		'idPaciente', 
		'idEstadoSalaOperacion', 
		'idServicio', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
	];
}