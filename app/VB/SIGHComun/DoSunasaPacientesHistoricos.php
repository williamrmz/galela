<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoSunasaPacientesHistoricos extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'nuevoSeguro', 
		'yaNoTieneSeguro', 
		'idUsuarioAuditoria', 
		'idSunasaPacienteHistorico', 
		'idPaciente', 
		'codigoIAFA', 
		'idPaisTitular', 
		'idTipoDocumentoTitular', 
		'nroDocumentoTitular', 
		'apellidoCasada', 
		'validacionRegIdentidad', 
		'nroCarnetIdentidad', 
		'estadoDelSeguro', 
		'idAfiliacion', 
		'productoYplan', 
		'fechaInicioAfiliacion', 
		'fechaFinalAfiliacion', 
		'idRegimen', 
		'codigoEstablecimientoIAFA', 
		'codigoEstablecimientoRENAES', 
		'idParentesco', 
		'rUCempleador', 
		'anteriorIdTipoDocumentoAsegurado', 
		'anteriorNroDocumentoAsegurado', 
		'dNIusarioOperacion', 
		'idOperacion', 
		'fechaEnvio', 
		'sisSepelioParienteEncargado', 
		'sisSepelioDni', 
		'sisSepelioFnacimiento', 
		'sisSepelioSexo', 
		'sisNroAfiliacion', 
	];
}