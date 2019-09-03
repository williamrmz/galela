<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOhis_historicoAten extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idPaciente', 
		'fecha', 
		'diagnost', 
		'cpt', 
		'ups', 
	];
}