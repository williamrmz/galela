<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtencionExamen extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idDetalleProducto', 
		'horaOrden', 
		'idServicioOrdena', 
		'idExamen', 
		'fechaOrden', 
		'ordenNro', 
		'idMedicoOrdena', 
		'idCuentaAtencion', 
		'horaResultado', 
		'fechaResultado', 
		'idAtencionExamen', 
	];
}