<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOPlanesCatalogoBienesInsumos extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idProducto', 
		'precioUnitario', 
		'idPlan', 
		'idPlanCatalogo', 
	];
}