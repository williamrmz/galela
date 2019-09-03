<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOcqxmantenimientoanestesia extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idMantenimientoAnestesia', 
		'idRegistroAnestesiologiaCab', 
		'satisfactorio', 
		'no_Satisfactorio', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
	];
}