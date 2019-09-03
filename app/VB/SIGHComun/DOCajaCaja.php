<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCajaCaja extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idTipoComprobante', 
		'impresora2', 
		'impresoraDefault', 
		'loginPc', 
		'idUsuarioAuditoria', 
		'descripcion', 
		'codigo', 
		'idCaja', 
		'serieImpresoraDefault', 
		'serieImpresora2', 
	];
}