<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOHistoriaClinica extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idPaciente', 
		'idEstadoHistoria', 
		'idTipoHistoria', 
		'fechaPasoAPasivo', 
		'fechaCreacion', 
		'idTipoNumeracionAnterior', 
		'idTipoNumeracion', 
		'nroHistoriaClinicaAnterior', 
		'nroHistoriaClinica', 
	];
}