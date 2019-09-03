<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoFactOrdenServ extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'fechaHoraRealizaCpt', 
		'idServicioPaciente', 
		'idUsuarioAuditoria', 
		'idOrden', 
		'idPuntoCarga', 
		'idPaciente', 
		'idCuentaAtencion', 
		'idTipoFinanciamiento', 
		'idFuenteFinanciamiento', 
		'fechaCreacion', 
		'idUsuario', 
		'idEstadoFacturacion', 
		'fechaDespacho', 
		'idUsuarioDespacho', 
	];
}