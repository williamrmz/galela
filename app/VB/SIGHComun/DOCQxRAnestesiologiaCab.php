<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DOCQxRAnestesiologiaCab extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'nombre', 
		'idTiposDestinoOperacion', 
		'fechaReg', 
		'idDiagnosticoPostOperatorio', 
		'observaciones', 
		'descripcion', 
		'idUsuarioAuditoria', 
		'idRegistroAnestesiologiaCab', 
		'idProgramacionSala', 
		'idOrdenOperatoriaMQ', 
		'idMedico', 
		'fecha', 
		'hora', 
		'nroRegistroAnestesiologia', 
		'idUsuario', 
		'fechaNacimiento', 
		'edad', 
		'sexo', 
		'apellidoPaterno', 
		'apellidoMaterno', 
		'primerNombre', 
		'segundoNombre', 
		'idServicioIngreso', 
		'nroHistoriaClinica', 
		'nrocuenta', 
		'tipoFiliacion', 
		'nroDocumento', 
		'nroOrdenOperatoriaMQ', 
		'idOrdenOperatoria', 
		'idPaciente', 
		'idServicio', 
		'observacion', 
		'estadoReg', 
		'estacion', 
	];
}