<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOTiposAnestesia extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idAnestesia', 
		'descripcion', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
	];
}