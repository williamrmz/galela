<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOfarmMovimientoNotaIngreso extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idFuenteFinanciamiento', 
		'idCuentaAtencion', 
		'idComprobantePago', 
		'idUsuarioAuditoria', 
		'movNumero', 
		'movTipo', 
		'documentoFechaRecepcion', 
		'origenIdTipo', 
		'origenNumero', 
		'origenFecha', 
		'idProveedor', 
		'idTipoCompra', 
		'idTipoProceso', 
		'numeroProceso', 
		'idPaciente', 
		'fechaModificacion', 
		'idUsuarioModifica', 
	];
}