<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtenIntePlanItemElaborado extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idAtenInteItemPlan', 
		'idPlanIntegralPaciente', 
		'esElaborado', 
	];
}