<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFarmMovimientoDetalle extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idTipoSalidaBienInsumo', 
		'idUsuarioAuditoria', 
		'movNumero', 
		'movTipo', 
		'idProducto', 
		'lote', 
		'fechaVencimiento', 
		'item', 
		'cantidad', 
		'precio', 
		'total', 
		'registroSanitario', 
		'documentoNumero', 
	];
}