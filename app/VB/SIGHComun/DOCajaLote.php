<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCajaLote extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idCajero', 
		'saldoInicialDolares', 
		'saldoInicialSoles', 
		'estadoLote', 
		'fecha', 
		'idLote', 
		'idCaja', 
		'idTurno', 
	];
}