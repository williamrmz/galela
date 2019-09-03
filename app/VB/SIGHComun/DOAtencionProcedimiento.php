<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtencionProcedimiento extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'nroOrden', 
		'idMedicoRealiza', 
		'idServicioRealiza', 
		'idDetalleProducto', 
		'idCuentaAtencion', 
		'horaRealizacion', 
		'fechaRealizacion', 
		'idProcedimiento', 
		'idAtencionProcedimiento', 
	];
}