<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LabItems extends Model
{
    protected $table = "LabItems";

    protected $primaryKey = 'idItem';

    public $timestamps = false;

    public function referencias()
    {
        return $this->hasMany('App\Model\ValoresReferencia', 'id_item', 'idItem');
    }

    public function scopeFiltro($query, $filtro)
    {
        $filtro = str_replace(' ', '', $filtro);
        if( $filtro != null)
        {
            $query->whereRaw("REPLACE(CAST(idItem AS VARCHAR)+Item, ' ', '') LIKE '%$filtro%'");
        }
    }

    public function itemsCPT()
    {
        return $this->hasMany('App\Model\LabItemsCpt', 'idItem', 'idItem');
    }

    public function servicios()
    {
        return $this->hasManyThrough(
            'App\Model\FactCatalogoServicios',
            'App\Model\LabItemsCpt',
            'idItem',
            'IdProducto',
            'idItem',
            'idProductoCpt'
        );
    }

}
