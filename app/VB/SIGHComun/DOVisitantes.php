<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOVisitantes extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idVisitante', 
		'idDocIdentidad', 
		'apellidoPaterno', 
		'apellidoMaterno', 
		'primerNombre', 
		'segundoNombre', 
		'nroDocumento', 
		'idTipoSexo', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
		'fechaIngreso', 
	];
}