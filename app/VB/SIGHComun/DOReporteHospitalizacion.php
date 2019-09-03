<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOReporteHospitalizacion extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idPaciente', 
		'conexion', 
		'idUsuarioAuditoria', 
		'mensajeError', 
		'apellidoPaterno', 
		'fechaNacimiento', 
		'apellidoMaterno', 
		'primerNombre', 
		'nroDocumento', 
		'sexo', 
		'edad', 
		'nroHistoriaClinica', 
	];
}