<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOfarmAlmacen extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'regenerarEstado', 
		'regenerarHora', 
		'regenerarDias', 
		'codigoSISMED', 
		'idUsuarioAuditoria', 
		'idAlmacen', 
		'descripcion', 
		'idTipoLocales', 
		'idTipoSuministro', 
		'idEstado', 
	];
}