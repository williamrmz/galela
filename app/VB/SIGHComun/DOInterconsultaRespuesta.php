<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOInterconsultaRespuesta extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idInterconsultaRespuesta', 
		'idInterconsultaCab', 
		'horaR', 
		'fechaR', 
		'resumenHC', 
		'motivo', 
		'idUsuario', 
		'estadoReg', 
		'estacion', 
		'fechaReg', 
	];
}