<?php 
namespace App\Visual\SIGHComun; 

use App\BaseModel; 

use DB; 

class DORolItem extends BaseModel
{
	protected $table = 'RolesItems';

	protected $fillable = [
		'IdRolItem',
		'IdListItem',
		'IdRol',
		'Agregar',
		'Modificar',
		'Eliminar',
		'Consultar',
	];
}