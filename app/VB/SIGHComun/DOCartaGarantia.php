<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCartaGarantia extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idCuentaAtencion', 
		'fechaVigencia', 
		'nroCarta', 
		'observacion', 
		'valorCobertura', 
		'idCartaGarantia', 
	];
}