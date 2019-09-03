<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOProDiagnosticos extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idPrograma', 
		'idProCabecera', 
		'idControl', 
		'idDiagnostico', 
		'principal', 
		'labConfHIS', 
		'idSubClasificacionDX', 
	];
}