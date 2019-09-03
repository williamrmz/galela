<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOPrestamoHistoriaClinica extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idMotivo', 
		'fechaPrestamoRequerida', 
		'horaPrestamoRequerida', 
		'fechaPrestamoReal', 
		'idPrestamo', 
		'fechaSolicitud', 
		'horaSolicitud', 
		'idEstadoPrestamo', 
		'idPaciente', 
		'idEnvio', 
		'observacion', 
		'idServicio', 
		'horaPrestamoReal', 
		'horaDevolucion', 
		'nroFolios', 
		'fechaDevolucion', 
	];
}