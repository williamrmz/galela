<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DODetalleProducto extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idMotivoNoAtencion', 
		'idEstadoProducto', 
		'idDocumentoDetalle', 
		'precioUnitario', 
		'cantidad', 
		'precioTotal', 
		'idProducto', 
		'idDetalleProducto', 
		'idCuentaAtencion', 
		'cubiertoPorSeguro', 
	];
}