<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOFarmaciaRecetas extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idMedicoOrdena', 
		'idServicioOrdena', 
		'fechaReceta', 
		'nroReceta', 
		'idCuentaAtencion', 
		'idReceta', 
	];
}