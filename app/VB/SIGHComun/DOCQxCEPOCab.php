<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxCEPOCab extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idProgramacion', 
		'idChequeoEnfermeriaPreOperatoriaCab', 
		'idOrdenOperatoriaMQ', 
		'fecha', 
		'hora', 
		'peso', 
		'talla', 
		'iCM', 
		'nroChequeoEnfermeriaPreOperatoria', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
		'idUsuarioAuditoria', 
	];
}