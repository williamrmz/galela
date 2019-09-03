<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFactReembolsos extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'grabaDefinitivamente', 
		'idTipoComprobante', 
		'idTipoConsumo', 
		'idUsuarioAuditoria', 
		'idFactReembolso', 
		'anio', 
		'mes', 
		'idAreaTramitaSeguro', 
		'idFuenteFinanciamiento', 
		'descripcion', 
		'saldoInicial', 
		'consumoPorReembolsar', 
		'reembolsoPagado', 
		'reembolsoPorPagar', 
		'saldoFinal', 
		'documentos', 
		'idEstadoReembolso', 
	];
}