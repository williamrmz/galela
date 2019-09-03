<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCitasWebCupos extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idWeb', 
		'fecha', 
		'idServicio', 
		'idMedico', 
		'horaInicio', 
		'horaFinal', 
		'idEstadoCitaWeb', 
		'idCitaBloqueada', 
		'dNI', 
		'apellidoPaterno', 
		'apellidoMaterno', 
		'primerNombre', 
		'segundoNombre', 
		'idTipoSexo', 
		'fechaNacimiento', 
		'ubigeo', 
		'fechaConfirmacion', 
		'horaConfirmacion', 
		'idFuenteFinanciamiento', 
		'idTurno', 
		'idPaciente', 
		'email', 
		'telefono', 
		'idProgramacion', 
	];
}