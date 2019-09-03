<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOMovimientoFormatoHC extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idAtencion', 
		'idUsuarioAuditoria', 
		'nroFolios', 
		'idServicioDestino', 
		'idServicioOrigen', 
		'observacion', 
		'idMotivo', 
		'fechaMovimiento', 
		'idPaciente', 
		'idMovimiento', 
		'idEmpleadoRecepcion', 
		'idEmpleadoTransporte', 
		'idEmpleadoArchivo', 
		'idGrupoMovimiento', 
		'idHistoriaSolicitada', 
	];
}