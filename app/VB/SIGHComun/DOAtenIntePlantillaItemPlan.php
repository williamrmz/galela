<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtenIntePlantillaItemPlan extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idPlantillaItemPlan', 
		'idAtenInteGrupo', 
		'idAtenInteItemPlan', 
	];
}