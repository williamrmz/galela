<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxOpSuspendidasDet extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idCausaSuspensionOperacionDet', 
		'idCausaSuspensionOperacion', 
		'idSuspensionOperacionCab', 
		'valor', 
		'observacion', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
	];
}