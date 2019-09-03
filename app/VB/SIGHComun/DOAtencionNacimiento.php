<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtencionNacimiento extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'docIdentidad', 
		'idDocIdentidad', 
		'idPacienteNacido', 
		'nroOrdenHijo', 
		'nroOrdenHijoEnParto', 
		'clamplajeFecha', 
		'apgar_5', 
		'apgar_1', 
		'idUsuarioAuditoria', 
		'idAtencion', 
		'idCondicionRN', 
		'idTipoSexo', 
		'peso', 
		'talla', 
		'edadSemanas', 
		'fechaNacimiento', 
		'idNacimiento', 
	];
}