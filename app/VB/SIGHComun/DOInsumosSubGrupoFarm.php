<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOInsumosSubGrupoFarm extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idGrupoFarmacologico', 
		'descripcion', 
		'idSubGrupoFarmacologico', 
	];
}