<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtencionDiagnostico2 extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idAtencionDiagnostico2', 
		'idAtencion', 
		'idClasificacionDx', 
		'idDiagnostico', 
		'idSubclasificacionDx', 
		'labConfHIS', 
		'grupoHIS', 
		'subGrupoHIS', 
		'idUsuario', 
		'estado', 
	];
}