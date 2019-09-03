<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOHIS_DetalleDx_Verifica extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idHisDetalle', 
		'idCIE', 
		'idSubClasificacionDX', 
		'codLAB', 
	];
}