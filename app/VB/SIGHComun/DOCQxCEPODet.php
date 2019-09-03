<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxCEPODet extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idChequeoEnfermeriaPreOperatoriaDet', 
		'idChequeoEnfermeriaPreOperatoria', 
		'idChequeoEnfermeriaPreOperatoriaCab', 
		'sI', 
		'nO', 
		'nO_APLICA', 
		'observacion', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
		'idUsuarioAuditoria', 
	];
}