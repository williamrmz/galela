<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFarmHistPrecio extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idHistPrecio', 
		'idProducto', 
		'fecha', 
		'precioCompra', 
		'precioDistribucion', 
		'precioVenta', 
		'precioDonacion', 
		'idUsuario', 
	];
}