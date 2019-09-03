<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFactPreventa extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idOrden', 
		'idAtencion', 
		'idTipoFinanciamiento', 
		'idUsuarioAuditoria', 
		'idFactPreventa', 
		'idServicio', 
		'total', 
		'fechaCreacion', 
		'idUsuario', 
		'idEstadoPreventa', 
	];
}