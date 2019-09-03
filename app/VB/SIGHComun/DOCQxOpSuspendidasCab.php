<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxOpSuspendidasCab extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idProgramacion', 
		'idUsuarioAuditoria', 
		'idSuspensionOperacionCab', 
		'idOrdenOperatoriaMQ', 
		'idMedico', 
		'idAnestesiologo', 
		'idEnfermera', 
		'idServicio', 
		'horaProg', 
		'horaSusp', 
		'nroOperacionSuspendida', 
		'estadoReg', 
		'fechaReg', 
		'idUsuario', 
		'estacion', 
	];
}