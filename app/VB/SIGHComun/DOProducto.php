<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOProducto extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idCategoriaProducto', 
		'bloqueado', 
		'precioBase', 
		'nombre', 
		'idProducto', 
		'codigo', 
	];
}