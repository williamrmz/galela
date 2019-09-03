<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOFinanciamientoCatalogoServ extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'seUsaSinPrecio', 
		'idUsuarioAuditoria', 
		'activo', 
		'idTipoFinanciamiento', 
		'idProducto', 
		'precioUnitario', 
		'idFinanciamientoCatalogo', 
	];
}