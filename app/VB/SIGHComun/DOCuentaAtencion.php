<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCuentaAtencion extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'fechaCreacion', 
		'idUsuarioAuditoria', 
		'totalPorPagar', 
		'idEstado', 
		'totalPagado', 
		'totalAsegurado', 
		'totalExonerado', 
		'horaCierre', 
		'fechaCierre', 
		'horaApertura', 
		'fechaApertura', 
		'idPaciente', 
		'idCuentaAtencion', 
	];
}