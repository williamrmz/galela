<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoSisFiliaciones extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idSiasis', 
		'codigo', 
		'afiliacionDisa', 
		'afiliacionTipoFormato', 
		'afiliacionNroFormato', 
		'afiliacionNroIntegrante', 
		'documentoTipo', 
		'codigoEstablAdscripcion', 
		'afiliacionFecha', 
		'paterno', 
		'materno', 
		'pnombre', 
		'onombres', 
		'genero', 
		'fnacimiento', 
		'idDistritoDomicilio', 
		'estado', 
		'fbaja', 
		'documentoNumero', 
		'motivoBaja', 
	];
}