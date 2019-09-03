<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtencionApoyoDiagnostico extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idServicioOrdena', 
		'horaOrden', 
		'fechaOrden', 
		'ordenNro', 
		'idMedicoOrdena', 
		'idCuentaAtencion', 
		'idAtencionApoyoDx', 
	];
}