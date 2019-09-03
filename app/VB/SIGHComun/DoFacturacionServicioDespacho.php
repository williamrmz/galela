<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFacturacionServicioDespacho extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'grupoHIS', 
		'subGrupoHIS', 
		'idUsuarioAuditoria', 
		'idOrden', 
		'idProducto', 
		'cantidad', 
		'precio', 
		'total', 
		'labConfHIS', 
		'idReceta', 
		'idDiagnostico', 
	];
}