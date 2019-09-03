<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoRecetaDetalle extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'observaciones', 
		'motivoAnulacionMedico', 
		'idDosisRecetada', 
		'idEstadoDetalle', 
		'idUsuarioAuditoria', 
		'idReceta', 
		'idItem', 
		'cantidadPedida', 
		'precio', 
		'total', 
		'saldoEnRegistroReceta', 
		'saldoEnDespachoReceta', 
		'cantidadDespachada', 
		'idViaAdministracion', 
		'idDiagnostico', 
	];
}