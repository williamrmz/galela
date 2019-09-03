<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOProcedimiento extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'nombre', 
		'idUsuarioAuditoria', 
		'edadMinDias', 
		'idProducto', 
		'idTipoSexo', 
		'descripcionOPCS', 
		'codigoOPCS', 
		'edadMaxDias', 
		'restriccion', 
		'codigoCPT2004', 
		'codigoCPT99', 
		'descripcion', 
		'idProcedimiento', 
	];
}