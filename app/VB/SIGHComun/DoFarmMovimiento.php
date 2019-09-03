<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFarmMovimiento extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'movNumero', 
		'movTipo', 
		'idAlmacenOrigen', 
		'idAlmacenDestino', 
		'idTipoConcepto', 
		'documentoIdtipo', 
		'documentoNumero', 
		'observaciones', 
		'total', 
		'idMotivoAnulacion', 
		'fechaAnulacion', 
		'idUsuarioAnulacion', 
		'fechaCreacion', 
		'idUsuario', 
		'idEstadoMovimiento', 
	];
}