<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtenInteGrupo extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idAtenInteGrupo', 
		'atencionIntegralGrupo', 
		'desdeAnio', 
		'desdeMes', 
		'desdeDia', 
		'hastaAnio', 
		'hastaMes', 
		'hastaDia', 
	];
}