<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOHistoriaSolicitada extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idAtencion', 
		'idUsuarioAuditoria', 
		'idMotivo', 
		'horaRequerida', 
		'fechaRequerida', 
		'horaSolicitud', 
		'fechaSolicitud', 
		'idPaciente', 
		'idHistoriaSolicitada', 
		'idEmpleadoSolicita', 
		'idMovimiento', 
		'observacion', 
		'idServicio', 
	];
}