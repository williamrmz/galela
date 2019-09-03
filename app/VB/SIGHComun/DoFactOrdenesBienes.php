<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFactOrdenesBienes extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'descripcion', 
		'paquete', 
		'dNI', 
		'idUsuarioExonera', 
		'importeExonerado', 
		'idUsuarioAuditoria', 
		'idOrden', 
		'idpuntocarga', 
		'idPaciente', 
		'idCuentaAtencion', 
		'idComprobantePago', 
		'movNumero', 
		'movTipo', 
		'idPreventa', 
		'fechaCreacion', 
		'idUsuario', 
		'idEstadoFacturacion', 
	];
}