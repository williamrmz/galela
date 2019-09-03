<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOa_categoriaeess extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'cat_IdCategoriaEESS', 
		'cat_Descripcion', 
		'cat_Abreviatura', 
		'cat_Nivel', 
		'cat_IdEstado', 
	];
}