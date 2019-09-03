<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxAntecedenteEnfermedades extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idAntecedenteEnfermedades', 
		'descripcion', 
		'abreviatura', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
	];
}