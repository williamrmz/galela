<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOMARJustificacion extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idEstadoCita', 
		'idAtencion', 
		'idUsuarioAuditoria', 
		'idJustificacion', 
		'idCita', 
		'idMedico', 
		'fecha', 
		'hora', 
		'descripcion', 
		'estadoReg', 
		'idUsuario', 
		'fechaReg', 
		'idServicio', 
		'ultimaCta', 
		'nrocuenta', 
		'tipoFiliacion', 
		'estacion', 
		'idGravedad', 
		'idPaciente', 
		'primerNombres', 
		'apellidoPaterno', 
		'apellidoMaterno', 
		'edad', 
		'nroDocumento', 
		'sexo', 
		'nroHistoriaClinica', 
		'atencion', 
		'fechaNacimiento', 
	];
}