<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoPerinatalAtencionMed extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idAtencion', 
		'idUsuarioAuditoria', 
		'idPerinatalAtencion', 
		'idModulo', 
		'idProducto', 
	];
}