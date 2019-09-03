<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCajaDevoluciones extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idDevolucion', 
		'idComprobantePago', 
		'montoDevuelto', 
		'montoTotal', 
		'fechaDevolucion', 
		'idUsuario', 
		'mMotivo', 
	];
}