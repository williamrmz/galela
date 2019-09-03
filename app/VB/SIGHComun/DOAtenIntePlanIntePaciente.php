<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtenIntePlanIntePaciente extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idPlanIntegralPaciente', 
		'idAtenInteGrupo', 
		'idPaciente', 
		'fechaElaboracion', 
		'idAtenInteItemPlan', 
		'idAtencion', 
	];
}