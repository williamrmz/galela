<?php 
// GENERATED AT: 17-07-2019 03:43:54 PM
// AUTHOR: Romel
namespace App\Visual\SIGHComun; 

use App\BaseModel; 

use DB; 

class DOListBarItems extends BaseModel
{
	protected $table = 'ListBarItems';

	protected $fillable = [
		'IdListItem',
		'Texto',
		'Clave',
		'IdListGrupo',
		'Indice',
		'KeyIcon',
	];

	// MUTATORS AND ACCESESORS

	public function getIdListItemAttribute() 
	{
		return isset($this->attributes['IdListItem'])? $this->attributes['IdListItem']: null;
	}
	public function setIdListItemAttribute( $value ) 
	{
		$this->attributes['IdListItem'] = $value;
	}

	public function getTextoAttribute() 
	{
		return isset($this->attributes['Texto'])? $this->attributes['Texto']: null;
	}
	public function setTextoAttribute( $value ) 
	{
		$this->attributes['Texto'] = $value;
	}

	public function getClaveAttribute() 
	{
		return isset($this->attributes['Clave'])? $this->attributes['Clave']: null;
	}
	public function setClaveAttribute( $value ) 
	{
		$this->attributes['Clave'] = $value;
	}

	public function getIdListGrupoAttribute() 
	{
		return isset($this->attributes['IdListGrupo'])? $this->attributes['IdListGrupo']: null;
	}
	public function setIdListGrupoAttribute( $value ) 
	{
		$this->attributes['IdListGrupo'] = $value;
	}

	public function getIndiceAttribute() 
	{
		return isset($this->attributes['Indice'])? $this->attributes['Indice']: null;
	}
	public function setIndiceAttribute( $value ) 
	{
		$this->attributes['Indice'] = $value;
	}

	public function getKeyIconAttribute() 
	{
		return isset($this->attributes['KeyIcon'])? $this->attributes['KeyIcon']: null;
	}
	public function setKeyIconAttribute( $value ) 
	{
		$this->attributes['KeyIcon'] = $value;
	}
}