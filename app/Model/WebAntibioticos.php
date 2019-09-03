<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WebAntibioticos extends Model
{
    protected $table = "WebAntibioticos";

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function scopeFiltro($query, $filtro)
    {
        $filtro = str_replace(' ', '', $filtro);
        if( $filtro != null)
        {
            $query->whereRaw("REPLACE(CAST(id AS VARCHAR)+nombre, ' ', '') LIKE '%$filtro%' ");
        }
    }
}
