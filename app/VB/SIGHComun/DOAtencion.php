<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtencion extends Model
{

	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'fechaIngresoIndicador', 
		'fechaEgresoIndicador', 
		'recomendacionesyTratamiento', 
		'enfermedadActual', 
		'pronostico', 
		'idSunasaPacienteHistorico', 
		'esPacienteExterno', 
		'idEstadoAtencion', 
		'idFuenteFinanciamiento', 
		'idFormaPago', 
		'idUsuarioAuditoria', 
		'pisoDomicilio', 
		'horaIngreso', 
		'fechaIngreso', 
		'idTipoServicio', 
		'idPaciente', 
		'idAtencion', 
		'idTipoCondicionALEstab', 
		'fechaEgresoAdministrativo', 
		'idCamaEgreso', 
		'idCamaIngreso', 
		'idServicioEgreso', 
		'idTipoAlta', 
		'idCondicionAlta', 
		'idTipoEdad', 
		'idOrigenAtencion', 
		'idDestinoAtencion', 
		'horaEgresoAdministrativo', 
		'idTipoCondicionAlServicio', 
		'horaEgreso', 
		'fechaEgreso', 
		'idMedicoEgreso', 
		'edad', 
		'idEspecialidadMedico', 
		'idMedicoIngreso', 
		'idServicioIngreso', 
		'idTipoGravedad', 
		'idCuentaAtencion', 
		'idCondicionMaterna', 
		'nroActaDef', 
	];
}