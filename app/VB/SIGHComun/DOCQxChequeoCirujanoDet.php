<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxChequeoCirujanoDet extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'conexion', 
		'idUsuarioAuditoria', 
		'mensajeError', 
		'idChequeoCirujanoDet', 
		'idChequeoCirujano', 
		'idChequeoCirujanoCab', 
		'sI', 
		'nO', 
		'nO_APLICA', 
		'estadoReg', 
		'idUsuario', 
		'estacion', 
		'fechaReg', 
	];
}