<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DORAnestesiologiaCab extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idRegistroAnestesiologiaCab', 
		'idProgramacionSala', 
		'idOrdenOperatoriaMQ', 
		'idMedico', 
		'fecha', 
		'hora', 
		'nroRegistroAnestesiologia', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
	];
}