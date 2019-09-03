<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOLabMovimientoLaboratorio extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'paciente', 
		'idTipoSexo', 
		'fechaNacimiento', 
		'idUsuarioAuditoria', 
		'idMovimiento', 
		'idOrden', 
		'correlativoAnual', 
		'idCuentaAtencion', 
		'idComprobantePago', 
		'idPersonaTomaLab', 
		'idPersonaRecoge', 
		'idDiagnostico', 
		'esDiagnosticoDefinitivo', 
		'ordenaPrueba', 
	];
}