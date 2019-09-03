<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoRecetaDetalleItem extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idReceta', 
		'idItem', 
		'documentoDespacho', 
		'cantidadDespachada', 
	];
}