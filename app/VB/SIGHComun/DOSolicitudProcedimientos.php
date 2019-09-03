<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOSolicitudProcedimientos extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idSolicitudProc', 
		'idCuenta', 
		'idProducto', 
		'cantidad', 
		'observaci�n', 
		'fechaRegistro', 
		'idUsuario', 
		'estado', 
	];
}