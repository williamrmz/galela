<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOFuenteFinanciamiento extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'codigoHIS', 
		'esUsadoEnCaja', 
		'codigoFuenteFinanciamientoSEM', 
		'idAreaTramitaSeguros', 
		'utilizadoEn', 
		'idTipoConceptoFarmacia', 
		'idUsuarioAuditoria', 
		'idTipoFinanciamiento', 
		'descripcion', 
		'idFuenteFinanciamiento', 
		'idTipoFinanciador', 
		'codigo', 
	];
}