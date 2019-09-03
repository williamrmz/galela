<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOAtencionEmergencia extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idTipoAgenteAGAN', 
		'idGrupoOcupacionalALAB', 
		'idPosicionLesionadoALAB', 
		'idUbicacionLesionado', 
		'idTipoTransporte', 
		'idTipoVehiculo', 
		'idClaseAccidente', 
		'idRelacionAgresorVictima', 
		'idSeguridad', 
		'idTipoEvento', 
		'idLugarEvento', 
		'idCausaExternaMorbilidad', 
		'idAtencion', 
		'idAtencionEmergencia', 
		'tiempoEnfermedad', 
		'motivoConsulta', 
		'relato', 
		'antecedentes', 
		'eFGeneral', 
		'eFRespiratorio', 
		'eFCardiovascular', 
		'eFAbdomen', 
		'eFNeurologico', 
		'eFGenitorurinario', 
		'eFLocomotor', 
		'eFOtros', 
		'evolucion', 
	];
}