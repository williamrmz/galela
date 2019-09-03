<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxReporteOperatorioCab extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'cama', 
		'piso', 
		'procedimientos', 
		'hallasgos', 
		'idProgramacionSala', 
		'idOrdenOperatoriaMQ', 
		'idUsuarioAuditoria', 
		'idRutaDet', 
		'idRuta', 
		'idOrdenOperatoria', 
		'idCuentaAtencion', 
		'horaIngreso', 
		'horaSalida', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
	];
}