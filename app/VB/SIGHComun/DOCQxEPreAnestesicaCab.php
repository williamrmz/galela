<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxEPreAnestesicaCab extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idEvaluacionPreAnestesicaCab', 
		'idProgramacionSala', 
		'idOrdenOperatoriaMQ', 
		'idMedico', 
		'idAnestesiologo', 
		'fecha', 
		'hora', 
		'efectiva', 
		'emergencia', 
		'idServicio', 
		'ultimaIngestaAlimientos', 
		'idCama', 
		'indicaciones', 
		'planAnestesico', 
		'nroEvaluacionPreAnestesica', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
		'horaIngreso', 
	];
}