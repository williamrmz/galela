<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOInteoIntegracionSistema extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idIntegracionSistema', 
		'idTipoSistema', 
		'idProveedorSistema', 
		'nombreUsuario', 
		'claveUsuario', 
		'esProveedorActual', 
		'esActivo', 
		'fechaCrea', 
		'fechaEdita', 
	];
}