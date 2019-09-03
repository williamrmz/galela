<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DODiagnostico extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'codigoCIEsinPto', 
		'descripcionMINSA', 
		'idUsuarioAuditoria', 
		'intrahospitalario', 
		'idDiagnostico', 
		'descripcion', 
		'codigoCIE9', 
		'codigoCIE10', 
		'codigoExportacion', 
		'idTipoSexo', 
		'morbilidad', 
		'idCategoria', 
		'restriccion', 
		'edadMaxDias', 
		'edadMinDias', 
		'codigoCIE2004', 
		'idCapitulo', 
		'idGrupo', 
		'gestacion', 
		'esActivo', 
		'fechaInicioVigencia', 
		'idSolicitudEspecialidad', 
		'idAtencion', 
		'idEspecialidad', 
		'idUsuario', 
		'fechaSolicitud', 
		'idEstado', 
	];
}