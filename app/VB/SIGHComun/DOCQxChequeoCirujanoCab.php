<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxChequeoCirujanoCab extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idProgramacion', 
		'idS', 
		'conexion', 
		'idUsuarioAuditoria', 
		'mensajeError', 
		'idChequeoCirujanoCab', 
		'idOrdenOperatoriaMQ', 
		'idMedico', 
		'edad', 
		'fecha', 
		'idDiagnostico', 
		'nroChequeoCirujano', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
	];
}