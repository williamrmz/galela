<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxRegEnfermeriaURPACab extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'horaCoordinacion', 
		'idProgramacion', 
		'conexion', 
		'idUsuarioAuditoria', 
		'mensajeError', 
		'idRegistroEnfermeriaURPACab', 
		'idOrdenOperatoriaMQ', 
		'idMedico', 
		'idEnfermera', 
		'idAnestesiologiaSOP', 
		'idAnestesiologiaURPA', 
		'fecha', 
		'horaEntrada', 
		'horaSalida', 
		'idServicio', 
		'idCama', 
		'glucosa', 
		'nroRegistroEnfermeriaURPA', 
		'idUsuario', 
		'estacion', 
	];
}