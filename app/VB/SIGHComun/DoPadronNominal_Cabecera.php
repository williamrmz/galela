<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoPadronNominal_Cabecera extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'conexion', 
		'idUsuarioAuditoria', 
		'mensajeError', 
		'idPaNomCabecera', 
		'idResponsableAtencion', 
		'idCodigoRenaes', 
		'mes', 
		'año', 
	];
}