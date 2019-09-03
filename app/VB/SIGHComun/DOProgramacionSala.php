<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOProgramacionSala extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'nedad', 
		'idCliente', 
		'dNI', 
		'apellidosynombres', 
		'salario', 
		'activo', 
		'idUsuarioAuditoria', 
		'idPaciente', 
		'nombres', 
		'apellidoPaterno', 
		'tipoFiliacion', 
		'cadena', 
		'apellidoMaterno', 
		'edad', 
		'nroDocumento', 
		'ultimaCta', 
		'sexo', 
		'fechaNacimiento', 
		'fecha', 
		'fechaIni', 
		'fechaFin', 
		'nroHistoriaClinica', 
		'idSala', 
		'sala', 
		'atencion', 
	];
}