<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOLabREsulBaciloscopia extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idLabResultadoBaciloscopia', 
		'fecha', 
		'idCuentaAtencion', 
		'idSolicitudBaciloscopia', 
		'procedimiento', 
		'nroRegistroLab', 
		'aspectoMacro', 
		'negativoAnotar', 
		'nBAARColonias', 
		'positivoAnotar', 
		'fechaEntrega', 
		'observacion', 
		'usuarioRegistraPrueba', 
		'idUsuario', 
		'fechaRegistro', 
	];
}