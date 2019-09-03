<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtenInteItemPlanSuplemento extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'itemPlanSuplemento', 
		'idPlanAtencion', 
		'idProducto', 
		'numeroDosis', 
	];
}