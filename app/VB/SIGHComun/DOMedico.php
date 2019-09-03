<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOMedico extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'egresado', 
		'rne', 
		'idColegioHis', 
		'loteHis', 
		'idUsuarioAuditoria', 
		'idEmpleado', 
		'colegiatura', 
		'idMedico', 
	];
}