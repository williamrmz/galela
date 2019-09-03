<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtenIntePlanDesPacienteDet extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idPlanDesarrolloPaciente', 
		'idPlanIntegralPaciente', 
		'idItemDesarrollo', 
		'ordenItem', 
		'ejecutaAccion', 
		'respondioEjecutaAccion', 
	];
}