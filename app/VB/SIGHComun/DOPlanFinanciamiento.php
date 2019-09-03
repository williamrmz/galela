<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOPlanFinanciamiento extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idPlan', 
		'idFuenteFinanciamiento', 
		'idTipoFinanciamiento', 
		'idPlanFinanciamiento', 
	];
}