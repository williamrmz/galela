<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class Class1 extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
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