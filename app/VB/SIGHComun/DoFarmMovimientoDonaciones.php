<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFarmMovimientoDonaciones extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'movNumero', 
		'movTipo', 
		'idCuentaAtencion', 
		'idPrescriptorReceta', 
		'idCoordinadorServicioSocial', 
		'idDiagnostico', 
	];
}