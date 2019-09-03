<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoAtencionHospCenso extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idRangoCensoHosp', 
		'rangoInicial', 
		'rangoFinal', 
		'rGBRojo', 
		'rGBVerde', 
		'rGBAzul', 
	];
}