<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DODiagInterconsulta extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idInterconsultaDiagnostico', 
		'idCuentaAtencion', 
		'idDiagnosticoIC', 
		'idDiagnostico', 
		'tipoInterconsulta', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
		'idSubclasificacionDx', 
		'estado', 
	];
}