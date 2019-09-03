<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOFactOrdenBienInsumo extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idFarmacia', 
		'idFormaPago', 
		'idPaciente', 
		'idUsuarioAuditoria', 
		'fechaModificacion', 
		'fechaCreacion', 
		'idUsuarioModifica', 
		'idUsuarioCrea', 
		'idAtencion', 
		'fechaOrden', 
		'idOrden', 
		'idEstadoOrden', 
		'idComprobantePago', 
		'idPuntoCarga', 
	];
}