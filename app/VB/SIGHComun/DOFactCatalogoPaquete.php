<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOFactCatalogoPaquete extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'ptoCarga', 
		'idUsuarioAuditoria', 
		'idFactPaquete', 
		'codigo', 
		'descripcion', 
		'idTipoFinanciamiento', 
		'fechaCreacion', 
		'idUsuario', 
		'idEstado', 
		'tipoPaquete', 
	];
}