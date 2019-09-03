<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtenIntePlanAtencion extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idPlanAtencion', 
		'idAtenInteGrupo', 
		'idPeriodoTiempo', 
		'edadAnio', 
		'edadMes', 
		'edadDia', 
		'descripcion', 
	];
}