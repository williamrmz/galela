<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoPadronNominal_Detalle extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'heces', 
		'hemoglobina', 
		'conexion', 
		'idUsuarioAuditoria', 
		'mensajeError', 
		'idPaNomDetalle', 
		'idTipoDoc', 
		'numDocumento', 
		'histClinica', 
		'apellidoPaterno', 
		'apellidoMaterno', 
		'nombres', 
		'idSexo', 
		'fecNacimiento', 
		'idTipoSeguro', 
		'numAfiliacion', 
		'fecEvaluacion', 
		'peso', 
		'talla', 
		'idDiagNutricional', 
		'codRenaes', 
		'idDiagPE', 
		'idDiagPT', 
		'idDiagTE', 
	];
}