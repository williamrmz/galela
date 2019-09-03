<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOConsentimientoInformadoDet extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'descripcion', 
		'idDiagnostico', 
		'idS', 
		'conexion', 
		'idCorrelativo', 
		'idUsuarioAuditoria', 
		'mensajeError', 
		'idConsentimientoInformadoDet', 
		'idConsentimientoInformadoCab', 
		'observacion', 
		'idOrdenOperatoria', 
		'idOrdenOperatoriaMQ', 
		'idMedico', 
		'fecha', 
		'hora', 
		'nroConsentimientoInformadoDet', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
	];
}