<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoPerinatalAtencionDx extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idAtencion', 
		'idUsuarioAuditoria', 
		'idPerinatalAtencion', 
		'idModulo', 
		'idLista', 
		'idDiagnostico', 
		'codigoHIS', 
		'labConfHIS', 
		'itemDiagnostico', 
		'idClasificacionDx', 
		'idSubClasificacionDX', 
	];
}