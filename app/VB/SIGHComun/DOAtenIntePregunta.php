<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtenIntePregunta extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idPregunta', 
		'pregunta', 
		'tipoRespuesta', 
		'tipoValorRespuesta', 
	];
}