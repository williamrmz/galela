<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtenInteHCRespuestaPaciente extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idGrupoHCPaciente', 
		'idPaciente', 
		'itemRespuesta', 
		'valorTexto', 
		'valorNumero', 
		'valorFecha', 
		'valorNumeroFin', 
		'valorFechaFin', 
		'valorEspecificacion', 
		'esActivo', 
		'idPregunta', 
	];
}