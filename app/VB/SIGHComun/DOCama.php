<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCama extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'y', 
		'x', 
		'idPaciente', 
		'idServicioUbicacionActual', 
		'codigo', 
		'idEstadoCama', 
		'idCondicionOcupacion', 
		'idTiposCama', 
		'idServicioPropietario', 
		'idCama', 
	];
}