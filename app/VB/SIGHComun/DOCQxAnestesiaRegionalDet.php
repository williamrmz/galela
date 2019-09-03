<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxAnestesiaRegionalDet extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idAnestesiaRegionalDet', 
		'idRegistroAnestesiologiaCab', 
		'idTecnicaAnestesiaRegional', 
		'valor', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
	];
}