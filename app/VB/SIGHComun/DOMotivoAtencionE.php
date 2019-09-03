<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOMotivoAtencionE extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idPrioridadEmergencia', 
		'idUsuarioAuditoria', 
		'idTriajeEmergencia', 
		'idMotivoAtencionEmergencia', 
		'motivoDescripcion', 
		'descripcion', 
		'prioridadDescripcion', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
	];
}