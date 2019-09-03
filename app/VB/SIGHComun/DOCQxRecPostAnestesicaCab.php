<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxRecPostAnestesicaCab extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idRecuperacionPostAnestesicaCab', 
		'idProgramacionSala', 
		'idOrdenOperatoriaMQ', 
		'idAnestesiologo', 
		'idAnestesiologoURPA', 
		'idServicioIngreso', 
		'fechaIngreso', 
		'horaIngreso', 
		'idServicioEgreso', 
		'fechaEgreso', 
		'horaEgreso', 
		'idCama', 
		'observacionIndicacionMedica', 
		'pendientes', 
		'nroRecuperacionPostAnestesica', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
		'idUsuarioAuditoria', 
	];
}