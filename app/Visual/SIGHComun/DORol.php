<?php 
namespace App\Visual\SIGHComun; 

use App\BaseModel; 

use DB; 

class DORol extends BaseModel
{
	public $autoincrement = false;

	protected $table = 'Roles';

	protected $fillable = [
		'IdRol',
		'Nombre',
	];

	public function getIdRolAttribute() { return $this->attributes['IdRol']; }

	public function setIdRolAttribute( $value ) { $this->attributes['IdRol'] = $value; }

	public function getNombreAttribute() { return $this->attributes['Nombre']; }

	public function setNombreAttribute( $value ) { $this->attributes['Nombre'] = $value; }
}