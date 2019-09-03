<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOHIS_CodigosActividades extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'conexion', 
		'idUsuarioAuditoria', 
		'mensajeError', 
		'idHisCodActvidad', 
		'idTipoAtencion', 
		'codigoActividad', 
		'descripcion', 
	];
}