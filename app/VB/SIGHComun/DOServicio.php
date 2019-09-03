<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOServicio extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'codigoServicioRenaes', 
		'fuaTipoAnexo2015', 
		'codigoServicioFUA', 
		'codigoServicioSuSalud', 
		'usaFUA', 
		'tipoEdad', 
		'usaGalenHos', 
		'usaModuloMaterno', 
		'usaModuloNinoSano', 
		'esObservacionEmergencia', 
		'triaje', 
		'idEstado', 
		'minimaEdad', 
		'costoCeroCE', 
		'codigoServicioHIS', 
		'ubicacionSEM', 
		'codigoServicioSEM', 
		'maximaEdad', 
		'soloTipoSexo', 
		'idUsuarioAuditoria', 
		'idTipoServicio', 
		'idEspecialidad', 
		'nombre', 
		'idServicio', 
		'idProducto', 
		'sVG', 
		'codigo', 
	];
}