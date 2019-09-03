<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtenIntePlanCrecDetalle extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idItemPlanCrecimiento', 
		'idTriajeVariable', 
		'ordenItem', 
	];
}