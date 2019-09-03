<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOTiposFinanciamiento extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'tipoVenta', 
		'idTipoConcepto', 
		'idCajaTiposComprobante', 
		'generaPago', 
		'esFuenteFinanciamiento', 
		'seImprimeComprobante', 
		'esFarmacia', 
		'seIngresPrecios', 
		'esSalida', 
		'esOficina', 
		'idUsuarioAuditoria', 
		'descripcion', 
		'idTipoFinanciamiento', 
	];
}