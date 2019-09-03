<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOcqxrecuperacionanestesia extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idRecuperacionAnestesia', 
		'idRegistroAnestesiologiaCab', 
		'satisfactorio', 
		'no_Satisfactorio', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
	];
}