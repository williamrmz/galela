<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoImagMovimientoImagenes extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuario', 
		'idProducto', 
		'paciente', 
		'idTipoSexo', 
		'fechaNacimiento', 
		'eo_FUM', 
		'eo_Gestantes', 
		'eo_Partos', 
		'eo_EG', 
		'idUsuarioAuditoria', 
		'idMovimiento', 
		'idOrden', 
		'correlativoAnual', 
		'idCuentaAtencion', 
		'idComprobantePago', 
		'idPersonaTomaImagen', 
		'idPersonaRecoge', 
		'zonaRayosX', 
		'porcInformeRadiolog', 
		'resultadoFinal', 
		'esContraste', 
		'esContrasteIonico', 
		'idDiagnostico', 
		'esDiagnosticoDefinitivo', 
	];
}