<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFacturacionBienesDevol extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'movNumeroE', 
		'movTipoE', 
		'idUsuarioAuditoria', 
		'movNumero', 
		'movTipo', 
		'idProducto', 
		'cantidadAdevolver', 
		'idComprobantePago', 
		'idEstadoDevolucion', 
		'fechaAutoriza', 
		'idUsuarioAutoriza', 
	];
}