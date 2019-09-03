<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFactOrdenServPagos extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioExonera', 
		'importeExonerado', 
		'idUsuarioAuditoria', 
		'idOrdenPago', 
		'idComprobantePago', 
		'idOrden', 
		'fechaCreacion', 
		'idUsuario', 
		'idEstadoFacturacion', 
	];
}