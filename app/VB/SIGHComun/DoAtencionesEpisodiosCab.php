<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoAtencionesEpisodiosCab extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idPaciente', 
		'idEpisodio', 
		'fechaApertura', 
		'fechaCierre', 
	];
}