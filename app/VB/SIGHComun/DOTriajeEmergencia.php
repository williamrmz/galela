<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOTriajeEmergencia extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'prioridadDescripcion', 
		'idPrioridadEmergencia', 
		'motivoDescripcion', 
		'nombreMedicoTopico', 
		'nombreServicio', 
		'fechaNacimiento', 
		'nrocuenta', 
		'tipoFiliacion', 
		'edad', 
		'sexo', 
		'primerNombre', 
		'nroHistoriaClinica', 
		'nroDocumento', 
		'apellidoPaterno', 
		'apellidoMaterno', 
		'idUsuarioAuditoria', 
		'idTriajeEmergencia', 
		'idPaciente', 
		'idMotivoAtencionEmergencia', 
		'idMedicoTriaje', 
		'idMedicoTopico', 
		'idServicio', 
		'fecha', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
	];
}