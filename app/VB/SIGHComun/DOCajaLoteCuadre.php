<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCajaLoteCuadre extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idLote', 
		'diferencia', 
		'cuadreUsuario', 
		'calculado', 
		'idLoteCuadre', 
		'idTipoFormaPago', 
	];
}