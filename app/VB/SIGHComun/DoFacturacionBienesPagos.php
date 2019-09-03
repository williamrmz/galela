<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFacturacionBienesPagos extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idOrden', 
		'idProducto', 
		'cantidadPagar', 
		'precioVenta', 
		'totalPagar', 
	];
}