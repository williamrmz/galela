<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class Dom_eess extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'pre_IdEESS', 
		'pre_Nombre', 
		'pre_Afilia', 
		'pre_UCI', 
		'pre_IdCategoriaEESS', 
		'pre_IdDisa', 
		'pre_IdOdsis', 
		'pre_IdUbigeo', 
		'pre_CodEjeAdm', 
		'pre_Vrae', 
		'pre_Umbral', 
		'pre_Aisped', 
		'pre_esmn', 
		'pre_IdEstado', 
		'pre_CodigoRENAES', 
		'entidad', 
	];
}