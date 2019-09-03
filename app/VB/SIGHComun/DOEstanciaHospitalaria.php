<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOEstanciaHospitalaria extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idProducto', 
		'llegoAlServicio', 
		'idUsuarioAuditoria', 
		'diasEstancia', 
		'idAtencion', 
		'idFacturacionServicio', 
		'idMedicoOrdena', 
		'idCama', 
		'idServicio', 
		'horaDesocupacion', 
		'fechaDesocupacion', 
		'horaOcupacion', 
		'fechaOcupacion', 
		'secuencia', 
		'idEstanciaHospitalaria', 
		'idMedicoOrdenaOrigen', 
		'idDiagnosticoTrasferencia', 
	];
}