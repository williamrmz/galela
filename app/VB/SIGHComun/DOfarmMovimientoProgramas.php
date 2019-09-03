<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOfarmMovimientoProgramas extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'fechaHoraPrescribe', 
		'idUsuarioAuditoria', 
		'movNumero', 
		'movTipo', 
		'idCoordinador', 
		'idPrescriptor', 
		'idDiagnostico', 
		'idPaciente', 
		'idComponente', 
		'idSubComponente', 
	];
}