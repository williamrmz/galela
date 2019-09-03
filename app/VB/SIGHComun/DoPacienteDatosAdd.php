<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoPacienteDatosAdd extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idPaciente', 
		'antecedentes', 
		'antecedAlergico', 
		'antecedObstetrico', 
		'antecedQuirurgico', 
		'antecedFamiliar', 
		'antecedPatologico', 
		'fNacimientoCalculada', 
	];
}