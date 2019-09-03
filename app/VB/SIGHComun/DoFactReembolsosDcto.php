<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFactReembolsosDcto extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'motivoAnulacion', 
		'idComprobantePago', 
		'idUsuarioAuditoria', 
		'idFactReembolso', 
		'nroSerie', 
		'nroDocumento', 
	];
}