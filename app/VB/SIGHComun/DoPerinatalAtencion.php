<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoPerinatalAtencion extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'fechaAtencion', 
		'idUsuarioAuditoria', 
		'idPerinatalAtencion', 
		'idPaciente', 
		'idModulo', 
		'grafXedadEnMeses', 
		'grafYpercentilTE', 
		'grafYpercentilPT', 
		'grafYpercentilPE', 
		'grafYimc', 
	];
}