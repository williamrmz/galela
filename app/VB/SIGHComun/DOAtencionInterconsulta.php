<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtencionInterconsulta extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idDetalleProducto', 
		'idAtencion', 
		'horaSolicitud', 
		'horaRealizacion', 
		'fechaSolicitud', 
		'fechaRealizacion', 
		'idMedicoRealiza', 
		'idMedicoSolicita', 
		'idInterconsulta', 
	];
}