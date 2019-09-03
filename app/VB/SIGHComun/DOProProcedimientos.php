<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOProProcedimientos extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idPrograma', 
		'idProCabecera', 
		'idControl', 
		'idDiagnostico', 
		'idProducto', 
		'idResultado', 
		'labConfHIS', 
	];
}