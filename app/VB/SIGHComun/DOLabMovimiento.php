<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOLabMovimiento extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idMovimiento', 
		'movTipo', 
		'idTipoConcepto', 
		'idPuntoCarga', 
		'fecha', 
		'idUsuario', 
		'idLabEstado', 
	];
}