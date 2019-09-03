<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOInterconsultaSolicitud extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idInterconsultaSolicitud', 
		'idInterconsultaCab', 
		'horaS', 
		'fechaS', 
		'resumenHC', 
		'motivo', 
		'idUsuario', 
		'estadoReg', 
		'estacion', 
		'fechaReg', 
	];
}