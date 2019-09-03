<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFacturacionServicioFin extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idEstadoFacturacion', 
		'idFuenteFinanciamiento', 
		'idUsuarioAuditoria', 
		'idOrden', 
		'idProducto', 
		'idTipoFinanciamiento', 
		'cantidadFinanciada', 
		'precioFinanciado', 
		'totalFinanciado', 
		'fechaAutoriza', 
		'idUsuarioAutoriza', 
	];
}