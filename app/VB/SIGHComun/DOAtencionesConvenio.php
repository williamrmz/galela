<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtencionesConvenio extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'codProducto', 
		'nroHistoria', 
		'idProducto', 
		'nombreProducto', 
		'nombrePaciente', 
		'fechaSesion', 
		'importeSesion', 
		'idUsuarioAuditoria', 
		'nroOficio', 
		'idPaciente', 
		'idAtencionesConvenio', 
	];
}