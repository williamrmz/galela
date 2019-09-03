<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOEnvioHistoriaClinica extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'horaPrestamoReal', 
		'fechaPrestamoReal', 
		'idResponsableRecepcion', 
		'idResponsableEnvio', 
		'idEnvio', 
	];
}