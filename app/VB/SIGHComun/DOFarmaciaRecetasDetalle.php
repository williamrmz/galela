<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOFarmaciaRecetasDetalle extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'cantidad', 
		'idFacturacionBienes', 
		'idRecetaDetalle', 
		'idProducto', 
		'idReceta', 
		'estadoRegistro', 
	];
}