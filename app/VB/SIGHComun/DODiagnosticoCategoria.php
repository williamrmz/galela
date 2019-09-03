<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DODiagnosticoCategoria extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idGrupo', 
		'descripcion', 
		'codigo', 
		'idCategoria', 
	];
}