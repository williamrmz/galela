<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtenIntePlanSuplemPaciente extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idPlanSuplementoPaciente', 
		'idPlanIntegralPaciente', 
		'idPlanAtencion', 
		'idProducto', 
		'idAtenInteItemPlan', 
		'fechaProgramada', 
		'fechaEjecucion', 
		'numeroDosis', 
		'idAtencion', 
		'idEstablecimiento', 
	];
}