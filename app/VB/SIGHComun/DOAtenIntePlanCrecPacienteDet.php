<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtenIntePlanCrecPacienteDet extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idPlanCrecimientoPaciente', 
		'idPlanIntegralPaciente', 
		'idTriajeVariable', 
		'variableValor', 
		'ordenItem', 
	];
}