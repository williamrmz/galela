<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class Dom_insumos extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'ins_CodIns', 
		'ins_Nombre', 
		'ins_FormaFarmaceutica', 
		'ins_Presen', 
		'ins_Concen', 
		'ins_Costo', 
		'ins_Observacion', 
		'ins_Petitorio', 
		'ins_FecBaja', 
		'ins_DocBaja', 
		'ins_IdEstado', 
	];
}