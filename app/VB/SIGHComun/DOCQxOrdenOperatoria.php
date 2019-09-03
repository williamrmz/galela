<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxOrdenOperatoria extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'nombreServicio', 
		'edadEnDias', 
		'idTipoSexo', 
		'descripcion', 
		'idCita', 
		'idServicio', 
		'ultimaCta', 
		'nrocuenta', 
		'idServicioIngreso', 
		'ultimaCita', 
		'observacion', 
		'tipoFiliacion', 
		'estacion', 
		'idUsuarioAuditoria', 
		'idMedico', 
		'idUsuario', 
		'idCliente', 
		'dNI', 
		'fechaEstimadaQx', 
		'apellidosynombres', 
		'salario', 
		'activo', 
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
		'tipoFinanciamiento', 
		'fechaNacimiento', 
		'idOrdenOperatoria', 
		'idOrdenOperatoriaCIE', 
		'idDiagnostico', 
		'nroOrdenOperatoria', 
		'estado', 
		'admitido', 
	];
}