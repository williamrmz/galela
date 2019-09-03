<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOTriajeValorNormal extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idTriajeValorNormal', 
		'edadInicialEnDia', 
		'edadFinalEnDia', 
		'valorNormalMinimo', 
		'valorNormalMaximo', 
		'valorCoherenteMinimo', 
		'valorCoherenteMaximo', 
		'idTriajeVariable', 
		'estadoPaciente', 
		'sexoPaciente', 
		'fechaVigencia', 
	];
}