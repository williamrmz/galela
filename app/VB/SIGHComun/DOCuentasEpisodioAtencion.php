<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCuentasEpisodioAtencion extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'fechaAlta', 
		'fechaIngreso', 
		'idEpisodioAtencion', 
	];
}