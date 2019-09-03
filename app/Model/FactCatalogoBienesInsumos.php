<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FactCatalogoBienesInsumos extends Model
{
    protected $table = "FactCatalogoBienesInsumos";


    public function scopeCodigo($query, $codigo)
    {
        if( trim($codigo) != null)
        {
            $query->where('Codigo', $codigo);
        }
    }

    public function scopeNombre($query, $nombre)
    {
        if( trim($nombre) != null)
        {
            $query->where('Nombre', 'LIKE',  "%$nombre%");
        }
    }
}
