<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOHIS_DatosEstablecimiento extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'conexion', 
		'idUsuarioAuditoria', 
		'mensajeError', 
		'idDatoEstablec', 
		'idEstablecimiento', 
		'color', 
		'turnos', 
		'ultimoNroFormatoHIS', 
	];
}