<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtenInteItemPlanProced extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idItemPlanProcedimiento', 
		'idPlanAtencion', 
		'idProducto', 
		'numeroDosis', 
		'idAtenInteItemPlan', 
	];
}