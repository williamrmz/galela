<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtenIntePlanDesPaciente extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idPlanDesarrolloPaciente', 
		'idPlanIntegralPaciente', 
		'evaluacion', 
		'idPlanAtencion', 
		'idAtenInteItemPlan', 
		'fechaProgramada', 
		'fechaEjecucion', 
		'numeroSesion', 
		'idAtencion', 
		'idEstablecimiento', 
		'edadAnio', 
		'edadMes', 
		'edadDia', 
		'descripcion', 
		'evaluacionDesc', 
		'establecimiento', 
	];
}