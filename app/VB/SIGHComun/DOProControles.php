<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOProControles extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idPrograma', 
		'idProCabecera', 
		'idControl', 
		'idAtencion', 
		'fechaControl', 
		'controlOtroEESS', 
		'idEstablecimiento', 
	];
}