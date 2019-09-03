<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtencionApoyoDiagDetalle extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idFacturacionServicio', 
		'horaResultado', 
		'fechaResultado', 
		'idServicioRealiza', 
		'idProcedimiento', 
		'idAtencionApoyoDx', 
		'idAtencionApoyoDetalle', 
		'estadoRegistro', 
	];
}