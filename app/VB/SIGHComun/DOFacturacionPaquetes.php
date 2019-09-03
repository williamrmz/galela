<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOFacturacionPaquetes extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idComprobantePago', 
		'idOrdenPago', 
		'idProducto', 
		'idFactPaquete', 
		'idPuntoCarga', 
		'idEspecialidadServicio', 
		'atencionId', 
	];
}