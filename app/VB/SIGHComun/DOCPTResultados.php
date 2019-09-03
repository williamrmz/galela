<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCPTResultados extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idCPTdResultado', 
		'idOrden', 
		'idProducto', 
		'idCuentaAtencion', 
		'resultados', 
		'observaciones', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
	];
}