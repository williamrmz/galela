<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOSExBasiloscopia extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idSolicitudBaciloscopia', 
		'idCuentaAtencion', 
		'idTipoMuestra', 
		'especificar', 
		'idAntecedenteTratamiento', 
		'srDiagnostico', 
		'segDiagnostico', 
		'rxAnormalDiagnostico', 
		'otroDiagnostico', 
		'idControlTratamiento', 
		'idExSolicitado', 
		'descripcionSolicitados', 
		'pruebaSensibilidadRapida', 
		'especificarPruebaRapida', 
		'pruebaSensibilidadConvencional', 
		'especificarPruebaConvencional', 
		'otroExamen', 
		'factorRiesgo', 
		'fechaObtencionMuestra', 
		'idCAlidadMuestraBaciloscopia', 
		'observaciones', 
		'usuarioRegistro', 
	];
}