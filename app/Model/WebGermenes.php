<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WebGermenes extends Model
{
    protected $table = "WebGermenes";

    protected $primaryKey = 'id';

    public $timestamps = false;


    public function scopeNombre($query, $nombre)
    {
        if( trim($nombre) != '')
        {
            $query->where('nombre', 'LIKE', "%$nombre%");
        }
    }

    public function scopeFiltro($query, $filtro)
    {
        $filtro = str_replace(' ', '', $filtro);
        if( $filtro != null)
        {
            $query->whereRaw("REPLACE(CAST(id AS VARCHAR)+nombre, ' ', '') LIKE '%$filtro%' ");
        }
    }

}
