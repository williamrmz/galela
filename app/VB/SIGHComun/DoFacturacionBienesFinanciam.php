<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFacturacionBienesFinanciam extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idEstadoFacturacion', 
		'idFuenteFinanciamiento', 
		'idUsuarioAuditoria', 
		'movNumero', 
		'movTipo', 
		'idProducto', 
		'idTipoFinanciamiento', 
		'cantidadFinanciada', 
		'precioFinanciado', 
		'totalFinanciado', 
		'fechaAutoriza', 
		'idUsuarioAutoriza', 
	];
}