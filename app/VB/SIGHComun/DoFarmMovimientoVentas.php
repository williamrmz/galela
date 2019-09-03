<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFarmMovimientoVentas extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'fechaHoraPrescribe', 
		'idServicioPaciente', 
		'idFuenteFinanciamiento', 
		'idUsuarioAuditoria', 
		'movNumero', 
		'movTipo', 
		'tipoVenta', 
		'idPreventa', 
		'idTipoFinanciamiento', 
		'idPrescriptor', 
		'idTipoReceta', 
		'idDiagnostico', 
		'idCuentaAtencion', 
		'idPaciente', 
		'idPaquete', 
		'idReceta', 
	];
}