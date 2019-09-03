<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoSisFuaResumen extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idResumen', 
		'anio', 
		'mes', 
		'nroEnvio', 
		'nomPaquete', 
		'versionGTI', 
		'cantFilATE', 
		'cantFilSMI', 
		'cantFilDIA', 
		'cantFilMED', 
		'cantFilINS', 
		'cantFilPRO', 
		'cantFilUSU', 
		'cantFilSER', 
		'cantFilRN', 
		'nombreAplicativo', 
		'versionAplicativo', 
		'versionEnvio', 
		'tipoDoc', 
		'nroDoc', 
	];
}