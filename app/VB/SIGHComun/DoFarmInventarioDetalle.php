<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFarmInventarioDetalle extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'esHistoricoSaldo', 
		'cantidadSobrante', 
		'cantidadFaltante', 
		'cantidadSaldo', 
		'idTipoSalidaBienInsumo', 
		'idUsuarioAuditoria', 
		'idInventario', 
		'idProducto', 
		'lote', 
		'fechaVencimiento', 
		'cantidad', 
		'precio', 
		'registroSanitario', 
	];
}