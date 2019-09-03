<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCita extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'esCitaAdicional', 
		'idUsuarioAuditoria', 
		'idPaciente', 
		'idAtencion', 
		'idEspecialidad', 
		'idMedico', 
		'idEstadoCita', 
		'fecha', 
		'idCita', 
		'horaSolicitud', 
		'fechaSolicitud', 
		'idProducto', 
		'idProgramacion', 
		'idServicio', 
		'horaFin', 
		'horaInicio', 
		'fechaReferencia', 
		'nroReferencia', 
		'motivoFechaReferecia', 
		'diasExtension', 
		'estadoImpresionReferencia', 
		'esReferencia', 
	];
}