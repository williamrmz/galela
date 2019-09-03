<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoSisFuaUsuario extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idUsuario', 
		'dNI', 
		'tipoDoc', 
		'apellidoPat', 
		'apellidoMat', 
		'primerNombre', 
		'segundoNombre', 
		'nroEnvio', 
		'periodo', 
		'mes', 
		'codigoEstablecimiento', 
	];
}