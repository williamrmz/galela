<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOHis_FactCatalogoServicios extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idDiagCpt', 
		'codigoDiagCpt', 
		'descripcionDiagCpt', 
		'esCpt', 
	];
}