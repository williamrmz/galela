<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOFactCatalogoServiciosHosp extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idFinanciamientoCatalogo', 
		'precioUnitario', 
		'idProducto', 
		'idTipoFinanciamiento', 
		'activo', 
		'seUsaSinPrecio', 
	];
}