<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtencionTriaje extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idAtencion', 
		'presion', 
		'temperatura', 
		'peso', 
		'talla', 
		'fechaTriaje', 
		'idUsuarioCreo', 
		'fechaModifico', 
		'idUsuarioModifico', 
		'saturacion', 
	];
}