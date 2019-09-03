<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCajaNroDocumento extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idTipoComprobante', 
		'nroDocumento', 
		'nroSerie', 
		'nroDocumentoFinal', 
		'idCaja', 
		'nroDocumentoInicial', 
	];
}