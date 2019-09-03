<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOHIS_Lotes extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'conexion', 
		'idUsuarioAuditoria', 
		'mensajeError', 
		'idHisLote', 
		'idEstablecimiento', 
		'lote', 
		'nroHojas', 
		'mes', 
		'anio', 
		'idEstadoLote', 
		'dobleDigitacion', 
		'cerrado', 
	];
}