<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOHIS_Detalle_Verifica extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idHisDetalle', 
		'idHisCabecera', 
		'idTipoAtencion', 
		'diaAtencion', 
		'sexo', 
		'idNacionalidad', 
		'nroDocIdentidad', 
		'nroHijo', 
		'idEtnia', 
		'idTipoDocumento', 
		'nroHC_FF', 
		'codigoActividad', 
		'idTipoFinanciamiento', 
		'idDistrito', 
		'idTipoEdad', 
		'edad', 
		'talla', 
		'peso', 
		'idEstadoaEstablec', 
		'idEstadoaServicio', 
		'nroRegistroLote', 
		'nroRegistroHoja', 
		'registrado', 
		'coincide', 
	];
}