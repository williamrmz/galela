<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoRecetaCabecera extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'fechaVigencia', 
		'idMedicoReceta', 
		'idUsuarioAuditoria', 
		'idReceta', 
		'idPuntoCarga', 
		'fechaReceta', 
		'idCuentaAtencion', 
		'idServicioReceta', 
		'idEstado', 
		'idComprobantePago', 
	];
}