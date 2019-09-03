<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOFacturacionSeguros extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'nroPlaca', 
		'codigoAutorizacion', 
		'idTipoFinanciamiento', 
		'idFuenteFinanciamiento', 
		'idCuentaAtencion', 
		'idFacturacionSeguro', 
		'totalAsegurado', 
	];
}