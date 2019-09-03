<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOInteoTipoSistema extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idTipoSistema', 
		'tipoSistema', 
		'esActivo', 
		'fechaCrea', 
		'fechaEdita', 
	];
}