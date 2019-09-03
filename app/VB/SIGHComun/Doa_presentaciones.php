<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class Doa_presentaciones extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'tpre_IdPresentacion', 
		'tpre_Descripcion', 
		'tpre_Abreviatura', 
		'tpre_TopeMinimo', 
		'tpre_TopeNoHosp', 
		'tpre_TopeHosp', 
		'tpre_IdEstado', 
	];
}