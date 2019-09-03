<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCajaGestion extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'totalCobrado', 
		'fechaCierre', 
		'idTurno', 
		'idCaja', 
		'idCajero', 
		'estadoLote', 
		'fechaApertura', 
		'idGestionCaja', 
	];
}