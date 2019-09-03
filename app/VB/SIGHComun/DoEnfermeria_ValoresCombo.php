<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoEnfermeria_ValoresCombo extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idCuentaAtencion', 
		'idVisita', 
		'idVariable', 
		'idValorCombo', 
	];
}