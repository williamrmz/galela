<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOInterconsultaDiagnostico extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idInterconsultaDiagnostico', 
		'idSubClasificacionDX', 
		'idClasificacionDx', 
		'idDiagnostico', 
		'idInterconsulta', 
	];
}