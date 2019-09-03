<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxOrdenOperatoriaMQ extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'nombreServicio', 
		'edadEnDias', 
		'idOrden', 
		'idpuntocarga', 
		'idMovimiento', 
		'idTipoSexo', 
		'descripcion', 
		'nombre', 
		'idRegistroAnestesiologiaCab', 
		'idMedico', 
		'idAnestesiologo', 
		'idEnfermera', 
		'medico', 
		'anestesiologo', 
		'enfermera', 
		'idGravedad', 
		'horaIngreso', 
		'horaSalida', 
		'sala', 
		'fecha', 
		'fechaProgramada', 
		'mFechaEstimadaQX', 
		'fechaNacimiento', 
		'edad', 
		'sexo', 
		'apellidoPaterno', 
		'apellidoMaterno', 
		'primerNombre', 
		'segundoNombre', 
		'idServicioIngreso', 
		'nroHistoriaClinica', 
		'nrocuenta', 
		'tipoFiliacion', 
		'nroDocumento', 
		'nroOrdenOperatoriaMQ', 
		'idUsuarioAuditoria', 
		'idOrdenOperatoriaMQ', 
		'idOrdenOperatoria', 
		'idPaciente', 
		'idServicio', 
		'hora', 
		'idCama', 
		'programado', 
		'fechaEstimadaQx', 
		'observacion', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
		'idProgramacionSala', 
	];
}