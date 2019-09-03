<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtencionReceta extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idMedico', 
		'idServicio', 
		'fechaReceta', 
		'nroReceta', 
		'idCuentaAtencion', 
		'idAtencionReceta', 
	];
}