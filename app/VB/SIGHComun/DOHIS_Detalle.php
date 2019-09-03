<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOHIS_Detalle extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'conexion', 
		'idUsuarioAuditoria', 
		'mensajeError', 
		'idHisDetalle', 
		'idHisCabecera', 
		'idTipoAtencion', 
		'diaAtencion', 
		'idHisPaciente', 
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
	];
}