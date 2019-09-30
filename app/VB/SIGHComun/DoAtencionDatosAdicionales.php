<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoAtencionDatosAdicionales extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idTipoReferenciaOrigen', 
		'idTipoReferenciaDestino', 
		'idEstablecimientoOrigen', 
		'idEstablecimientoDestino', 
		'idEstablecimientoNoMinsaOrigen', 
		'idEstablecimientoNoMinsaDestino', 
		'huboInfeccionIntraHospitalaria', 
		'tieneNecropsia', 
		'idMedicoRespNacimiento', 
		'recienNacido', 
		'nroReferenciaDestino', 
		'nroReferenciaOrigen', 
		'sisCodigo', 
		'idSiasis', 
		'numeroDeHijos', 
		'proximaCita', 
		'idUsuarioAuditoria', 
		'idAtencion', 
		'direccionDomicilio', 
		'nombreAcompaniante', 
		'observacion', 
		'fuaCodigoPrestacion', 
		'seImprimioFicha', 
		'nroExpediente', 
		'idServicioDestino', 
		'ups', 
		'nroDocumentoAcompanante', 
		'domicilioAcompanante', 

	];

}