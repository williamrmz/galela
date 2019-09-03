<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxCondicionIngresoURPADet extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'conexion', 
		'idUsuarioAuditoria', 
		'mensajeError', 
		'idCondicionIngresoURPADet', 
		'idCondicionIngresoURPA', 
		'idRegistroEnfermeriaURPACab', 
		'valor', 
		'idUsuario', 
		'estacion', 
	];
}