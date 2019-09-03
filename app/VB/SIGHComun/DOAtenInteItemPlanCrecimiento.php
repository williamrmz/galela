<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtenInteItemPlanCrecimiento extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idItemPlanCrecimiento', 
		'idPlanAtencion', 
		'numeroSesion', 
	];
}