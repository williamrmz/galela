<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOHIS_Cabecera extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'conexion', 
		'idUsuarioAuditoria', 
		'mensajeError', 
		'idHisCabecera', 
		'idHisLote', 
		'nroHojaHis', 
		'nroFormato', 
		'idTurno', 
		'idUsuario', 
		'idEstadoHis', 
		'idMedico', 
		'idEstablecimiento', 
		'idServicio', 
		'fechaCreacion', 
	];
}