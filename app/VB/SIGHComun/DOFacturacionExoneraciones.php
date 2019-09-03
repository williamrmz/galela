<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOFacturacionExoneraciones extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idAtencion', 
		'idExoneracion', 
		'fechaExoneracion', 
		'idEmpleadoExonera', 
		'totalExonerado', 
	];
}