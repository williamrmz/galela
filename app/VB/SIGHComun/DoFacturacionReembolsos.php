<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFacturacionReembolsos extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idFactReembolso', 
		'idCuentaAtencion', 
		'consumoPorReembolsar', 
		'reembolsoPorPagar', 
		'reembolsoPagadoFarmacia', 
		'reembolsoPagadoServicio', 
		'idReembolsosAnteriores', 
		'idDiagnostico', 
		'nroReferenciaDestino', 
	];
}