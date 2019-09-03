<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOProgramacionMedica extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'tiempoPromedioAtencion', 
		'fechaReg', 
		'idUsuarioAuditoria', 
		'idTipoProgramacion', 
		'descripcion', 
		'horaFin', 
		'horaInicio', 
		'fecha', 
		'idTipoServicio', 
		'idDepartamento', 
		'idMedico', 
		'idProgramacion', 
		'idEspecialidad', 
		'idTurno', 
		'color', 
		'idServicio', 
	];
}