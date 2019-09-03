<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFarmPreVenta extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'descripcion', 
		'paquete', 
		'dNI', 
		'fechaHoraPrescribe', 
		'horaCreacion', 
		'idUsuarioAuditoria', 
		'idPreventa', 
		'idAlmacen', 
		'idVendedor', 
		'idPaciente', 
		'idTipoFinanciamiento', 
		'total', 
		'idDiagnostico', 
		'idTipoReceta', 
		'idCuentaAtencion', 
		'idPrescriptor', 
		'fechaCreacion', 
		'idUsuario', 
		'fechaModificacion', 
		'idUsuarioModifica', 
		'idEstadoPreventa', 
	];
}