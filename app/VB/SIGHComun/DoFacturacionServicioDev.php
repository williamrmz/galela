<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFacturacionServicioDev extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idOrden', 
		'idProducto', 
		'cantidadAdevolver', 
		'idComprobantePago', 
		'idEstadoDevolucion', 
		'fechaAutoriza', 
		'idUsuarioAutoriza', 
	];
}