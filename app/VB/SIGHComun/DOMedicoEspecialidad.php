<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOMedicoEspecialidad extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idMedico', 
		'idEspecialidad', 
		'idMedicoEspecialidad', 
	];
}