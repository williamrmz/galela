<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOFacturacionCatalogoPqtes extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idFactPaquete', 
		'idPuntoCarga', 
		'idEspecialidadServicio', 
		'idProducto', 
		'cantidad', 
		'precio', 
		'importe', 
	];
}