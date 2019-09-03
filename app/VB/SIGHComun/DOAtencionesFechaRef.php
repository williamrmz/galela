<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtencionesFechaRef extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idAtencion', 
		'motivoReferencia', 
		'nroReferencia', 
		'fechaReferencia', 
		'diasExtension', 
		'idUsuarioAuditoria', 
		'idAtencioesFechaReferencia', 
		'idcuentaAtencion', 
		'idUsuario', 
		'motivoFechaReferecia', 
		'fechaRegistro', 
		'idUsuarioElimina', 
		'fechaElimina', 
		'estado', 
	];
}