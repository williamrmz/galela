<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoNotaCreditoDebito extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idNota', 
		'idComprobantePago', 
		'idTipoNota', 
		'nroSerie', 
		'nroDocumento', 
		'razonSocial', 
		'rUC', 
		'subTotal', 
		'iGV', 
		'total', 
		'idUsuarioAutoriza', 
		'fechaAprueba', 
		'tipoCambio', 
		'observaciones', 
		'idEstadoNota', 
		'fechaPagado', 
		'idGestionCaja', 
		'idPaciente', 
		'idCajero', 
		'idTurno', 
		'idCaja', 
		'idFarmacia', 
		'idMotivo', 
		'direccion', 
		'tipoAnulacion', 
	];
}