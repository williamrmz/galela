<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOFactOrdenServicio extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idFormaPago', 
		'idUsuarioAuditoria', 
		'fechaModificacion', 
		'fechaCreacion', 
		'idUsuarioModifica', 
		'idUsuarioCrea', 
		'idAtencion', 
		'fechaOrden', 
		'idPuntoCarga', 
		'idOrden', 
		'idEstadoOrden', 
		'idComprobantePago', 
	];
}