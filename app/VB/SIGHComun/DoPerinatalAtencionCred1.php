<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoPerinatalAtencionCred1 extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idPerinatalAtencion', 
		'idModulo', 
		'estimulacionTemprana', 
		'alimentacionComplementaria', 
		'lactanciaMaterna', 
		'personalSalud', 
		'demandaIndividual', 
		'mujerEdadReproductiva', 
		'mujerGestante', 
		'idAtencion', 
	];
}