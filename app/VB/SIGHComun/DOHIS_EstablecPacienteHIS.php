<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOHIS_EstablecPacienteHIS extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'conexion', 
		'idUsuarioAuditoria', 
		'mensajeError', 
		'idEstablecPacienteHIS', 
		'idEstablecimiento', 
		'idHisPaciente', 
		'nroHC_FF', 
	];
}