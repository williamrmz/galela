<?php 
namespace App\Visual\SIGHComun; 

use App\BaseModel; 

use DB; 

class DORolPermiso extends BaseModel
{
	protected $table = 'RolesPermisos';

	protected $fillable = [
		'IdRolPermiso',
		'IdPermiso',
		'IdRol',
	];
}