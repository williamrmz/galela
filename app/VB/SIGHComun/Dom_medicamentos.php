<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class Dom_medicamentos extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'med_CodMed', 
		'med_Nombre', 
		'med_FormaFarmaceutica', 
		'med_Presen', 
		'med_Concen', 
		'med_Costo', 
		'med_Petitorio', 
		'med_Petitorio2005', 
		'med_Petitorio2010', 
		'med_FecBaja', 
		'med_FFDigemid', 
		'med_IdEstado', 
	];
}