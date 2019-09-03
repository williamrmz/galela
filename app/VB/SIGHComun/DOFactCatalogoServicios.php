<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOFactCatalogoServicios extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idProducto', 
		'codigo', 
		'nombre', 
		'idServicioGrupo', 
		'idServicioSubGrupo', 
		'idServicioSeccion', 
		'idServicioSubSeccion', 
		'idPartida', 
		'idCentroCosto', 
		'codMINSA', 
		'codMINSAnoActualiza', 
		'esCPT', 
		'idOpcs', 
		'nombreMINSA', 
		'idEstado', 
		'codigoSIS', 
	];
}