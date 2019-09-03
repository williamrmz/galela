<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtencionesCE extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'triajeFrecRespiratoria', 
		'triajePulso', 
		'triajePerimCefalico', 
		'triajeFrecCardiaca', 
		'triajeOrigen', 
		'idUsuarioAuditoria', 
		'idAtencion', 
		'citaDniMedicoJamo', 
		'citaFecha', 
		'citaMedico', 
		'citaServicioJamo', 
		'citaIdServicio', 
		'citaMotivo', 
		'citaExamenClinico', 
		'citaDiagMed', 
		'citaExClinicos', 
		'citaTratamiento', 
		'citaObservaciones', 
		'citaFechaAtencion', 
		'citaIdUsuario', 
		'triajeEdad', 
		'triajePresion', 
		'triajeTalla', 
		'triajeTemperatura', 
		'triajePeso', 
		'triajeFecha', 
		'triajeIdUsuario', 
		'citaAntecedente', 
		'triajeSaturacion', 
		'nroHistoriaClinica', 
	];
}