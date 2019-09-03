<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtencionDiagnostico extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idAtencionDiagnostico', 
		'idAtencion', 
		'idClasificacionDx', 
		'idDiagnostico', 
		'idSubclasificacionDx', 
		'labConfHIS', 
		'grupoHIS', 
		'subGrupoHIS', 
		'idordenDx', 
	];
}