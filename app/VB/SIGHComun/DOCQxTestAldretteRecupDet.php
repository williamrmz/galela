<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxTestAldretteRecupDet extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'conexion', 
		'idUsuarioAuditoria', 
		'mensajeError', 
		'idProgramacionSala', 
		'idComponentesTestAldrette', 
		'valorIngreso', 
		'valorEgreso', 
		'idUsuario', 
		'estacion', 
		'idComponentesVentilacionMecanica', 
		'valorIngresoVentilacion', 
		'valorAltaVentilacion', 
	];
}