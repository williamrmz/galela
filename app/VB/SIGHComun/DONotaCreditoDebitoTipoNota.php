<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DONotaCreditoDebitoTipoNota extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idTipoNota', 
		'tipoNota', 
		'nroSerie', 
		'nroDocumento', 
		'nroDocumentoInicial', 
		'nroDocumentoFinal', 
	];
}