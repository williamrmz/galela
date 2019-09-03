<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtenIntePlanProcedPaciente extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idPlanProcedimientoPaciente', 
		'idPlanIntegralPaciente', 
		'idProducto', 
		'idPlanAtencion', 
		'idAtenInteItemPlan', 
		'fechaProgramada', 
		'fechaEjecucion', 
		'numeroDosis', 
		'codigoHIS', 
		'idAtencion', 
		'idEstablecimiento', 
	];
}