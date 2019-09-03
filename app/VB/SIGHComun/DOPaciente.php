<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOPaciente extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'sectorista', 
		'sector', 
		'madreTipoDocumento', 
		'nroOrdenHijo', 
		'madreSegundoNombre', 
		'madrePrimerNombre', 
		'madreApellidoMaterno', 
		'madreApellidoPaterno', 
		'madreDocumento', 
		'email', 
		'idIdioma', 
		'usoWebReniec', 
		'factorRh', 
		'grupoSanguineo', 
		'idEtnia', 
		'fichaFamiliar', 
		'idDistritoNacimiento', 
		'idDistritoDomicilio', 
		'idDistritoProcedencia', 
		'idUsuarioAuditoria', 
		'idCentroPobladoProcedencia', 
		'idCentroPobladoNacimiento', 
		'nroHistoriaClinica', 
		'idPaisDomicilio', 
		'nombreMadre', 
		'nombrePadre', 
		'idCentroPobladoDomicilio', 
		'idTipoOcupacion', 
		'idDocIdentidad', 
		'idEstadoCivil', 
		'idGradoInstruccion', 
		'idProcedencia', 
		'idTipoSexo', 
		'autogenerado', 
		'telefono', 
		'telefono2', 
		'telefono3', 
		'telefono4', 
		'nroDocumento', 
		'fechaNacimiento', 
		'tercerNombre', 
		'segundoNombre', 
		'primerNombre', 
		'apellidoPaterno', 
		'idPaciente', 
		'idTipoNumeracion', 
		'observacion', 
		'idPaisProcedencia', 
		'idPaisNacimiento', 
		'direccionDomicilio', 
		'apellidoMaterno', 
		'idCentroPobladoDomicilioTutor', 
		'idDistritoDomicilioTutor', 
		'idPaisDomicilioTutor', 
		'direccionDomiciliotutor', 
		'religion', 
	];
}