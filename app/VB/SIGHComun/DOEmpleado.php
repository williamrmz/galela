<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOEmpleado extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		// 'telefono', 
		// 'correo', 
		// 'accedeVWeb', 
		// 'claveVWeb', 
		'idSupervisor', 
		'idTipoDocumento', 
		'reniecAutorizado', 
		'idEstablecimientoExterno', 
		'hisCodigoDigitador', 
		'idTipoDestacado', 
		'fechaNacimiento', 
		'loginPc', 
		'loginEstado', 
		'idUsuarioAuditoria', 
		'clave', 
		'usuario', 
		'fechaAlta', 
		'fechaIngreso', 
		'codigoPlanilla', 
		'dNI', 
		'idTipoEmpleado', 
		'idCondicionTrabajo', 
		'nombres', 
		'apellidoMaterno', 
		'apellidoPaterno', 
		'idEmpleado', 
		// 'esActivo', 
		// 'sexo', 
	];
}