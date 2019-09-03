<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOEnfermeria_Visitas extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idCuentaAtencion', 
		'idVisita', 
		'fechaHoraVisita', 
		'idServicio', 
		'observaciones', 
		'idCama', 
		'idEmpleadoEnfermera', 
		'ingresoValorizacion', 
	];
}