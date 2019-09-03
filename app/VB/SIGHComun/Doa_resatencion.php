<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class Doa_resatencion extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'pers_IdResAtencion', 
		'pers_IdTipoDocumento', 
		'pers_ApePaterno', 
		'pers_ApeMaterno', 
		'pers_PriNombre', 
		'pers_OtrNombre', 
		'pers_IdTipoPersonalSalud', 
		'pers_Colegiatura', 
		'pers_IdEspecialidad', 
		'pers_NroEspecialidad', 
		'pers_IdEstado', 
	];
}