<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCatalogoServicio extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'codigoSIS', 
		'idEstado', 
		'nombreMINSA', 
		'esCpt', 
		'idUsuarioAuditoria', 
		'idServicioSubGrupo', 
		'idPartida', 
		'idCentroCosto', 
		'idServicioSubSeccion', 
		'idServicioSeccion', 
		'idServicioGrupo', 
		'nombre', 
		'codigo', 
		'idProducto', 
	];
}