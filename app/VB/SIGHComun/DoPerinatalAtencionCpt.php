<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoPerinatalAtencionCpt extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idAtencion', 
		'idUsuarioAuditoria', 
		'idPerinatalAtencion', 
		'idModulo', 
		'idLista', 
		'idProducto', 
		'cptEsAutomatico', 
		'codigoHIS', 
		'idOrden', 
		'labConfHIS', 
		'itemCpt', 
	];
}