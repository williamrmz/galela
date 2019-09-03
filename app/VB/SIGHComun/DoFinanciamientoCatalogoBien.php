<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFinanciamientoCatalogoBien extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'activo', 
		'idTipoFinanciamiento', 
		'idProducto', 
		'precioUnitario', 
		'idPlanCatalogo', 
	];
}