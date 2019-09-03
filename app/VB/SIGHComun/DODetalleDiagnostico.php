<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DODetalleDiagnostico extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idDiagnostico', 
		'idsubClasificacionDx', 
		'idCuentaAtencion', 
		'idProducto', 
		'idPrioridad', 
		'idTipoCirugia', 
	];
}