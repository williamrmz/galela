<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOInterconsultaAtencion extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'horaSolicitud', 
		'fechaSolicitud', 
		'horaRealizacion', 
		'idDetalleProducto', 
		'idDiagnostico', 
		'fechaRealizacion', 
		'idCuentaAtencion', 
		'idMedicoRealiza', 
		'idMedicoSolicita', 
		'idInterconsulta', 
	];
}