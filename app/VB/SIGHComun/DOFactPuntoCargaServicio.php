<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOFactPuntoCargaServicio extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idServicioSubGrupo', 
		'idPuntoCarga', 
		'idPuntoCargaServicio', 
	];
}