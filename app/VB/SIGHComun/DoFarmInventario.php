<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFarmInventario extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idTipoInventario', 
		'idUsuarioAuditoria', 
		'idInventario', 
		'idAlmacen', 
		'numeroInventario', 
		'fechaCierre', 
		'fechaCreacion', 
		'fechaModificacion', 
		'idEstadoInventario', 
		'idUsuario', 
	];
}