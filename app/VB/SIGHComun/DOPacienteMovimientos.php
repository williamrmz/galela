<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOPacienteMovimientos extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idCuentaAtencion', 
		'peso', 
		'talla', 
		'idDxNutricional', 
		'grafXedadEnMeses', 
		'grafYpercentilTE', 
		'grafYpercentilPT', 
		'grafYpercentilPE', 
		'zetaPT', 
		'zetaTE', 
		'zetaPE', 
		'hemoglobina', 
		'parasitosis', 
	];
}