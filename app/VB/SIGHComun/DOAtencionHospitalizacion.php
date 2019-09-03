<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtencionHospitalizacion extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idCamaEgreso', 
		'idCamaIngreso', 
		'tieneNecropsia', 
		'huboInfeccionIntraHospitalaria', 
		'idServicioEgreso', 
		'idTipoAlta', 
		'idCondicionAlta', 
		'idAtencion', 
		'idAtencionHospitalizacion', 
		'horaEgresoAdministrativo', 
		'fechaEgresoAdministrativo', 
	];
}