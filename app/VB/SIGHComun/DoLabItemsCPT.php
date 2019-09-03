<?php

namespace App\VB\SIGHComun;

use Illuminate\Database\Eloquent\Model;

use DB;

class DoLabItemsCPT extends Model
{
	public $timestamps = false;

	public $incrementing = false;

	public $fillable = [
		'idUsuarioAuditoria', 
		'idProductoCpt', 
		'ordenXresultado', 
		'idGrupo', 
		'idItemGrupo', 
		'idItem', 
		'valorSiEsCombo', 
		'valorReferencial', 
		'metodo', 
		'soloNumero', 
		'soloTexto', 
		'soloCombo', 
		'soloCheck', 
	];
}