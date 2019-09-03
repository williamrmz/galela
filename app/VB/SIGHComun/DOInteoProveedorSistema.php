<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOInteoProveedorSistema extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idProveedorSistema', 
		'proveedorSistema', 
		'esActivo', 
		'fechaCrea', 
		'fechaEdita', 
	];
}