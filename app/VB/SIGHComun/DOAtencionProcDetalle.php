<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtencionProcDetalle extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idAtencionProcedimiento', 
		'idFacturacionServicio', 
		'idMedicoRealiza', 
		'idServicioRealiza', 
		'idProcedimiento', 
		'horaRealizacion', 
		'fechaRealizacion', 
		'idAtencionProcDetalle', 
		'estadoRegistro', 
	];
}