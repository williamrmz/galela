<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOHIS_Paciente extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'conexion', 
		'idUsuarioAuditoria', 
		'mensajeError', 
		'idHisPaciente', 
		'nroHC_FF', 
		'sexo', 
		'idNacionalidad', 
		'nroDocIdentidad', 
		'nroHijo', 
		'idEtnia', 
		'idPacienteGalenHos', 
		'idTipoDocumento', 
	];
}