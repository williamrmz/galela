<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxRegVerificacionCCab extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idProgramacionSala', 
		'idOrdenOperatoriaMQ', 
		'idUsuarioAuditoria', 
		'idRutaDet', 
		'idRuta', 
		'idOrdenOperatoria', 
		'idCuentaAtencion', 
		'fecha', 
		'hora', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
	];
}