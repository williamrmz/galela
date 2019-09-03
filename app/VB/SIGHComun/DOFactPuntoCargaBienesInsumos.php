<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOFactPuntoCargaBienesInsumos extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idSubGrupoFarmacologico', 
		'idPuntoCarga', 
		'idPuntoCargaBienInsumo', 
	];
}