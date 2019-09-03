<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOSubclasificacionDiagnostico extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idTipoServicio', 
		'idClasificacionDx', 
		'descripcion', 
		'codigo', 
		'idSubClasificacionDX', 
	];
}