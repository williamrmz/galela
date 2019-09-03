<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOHIS_ProgMedEstMR extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idHisProgMedEstMR', 
		'idMedico', 
		'idServicio', 
		'idEstablecimiento', 
		'fechaProgramada', 
		'idTurno', 
	];
}