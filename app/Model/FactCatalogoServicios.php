<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FactCatalogoServicios extends Model
{
    protected $table = "FactCatalogoServicios";

    protected $primaryKey = 'IdProducto';

    public function scopeTipoCatalogo($query, $tipoCatalogo)
    {
        if( trim($tipoCatalogo) != null)
        {
            // $query->where('Nombre', 'LIKE',  "%$nombre%");
        }
    }

    public function subGrupo()
    {
        return $this->hasOne('App\Model\FactCatalogoServicioSubGrupo', 'IdServicioSubGrupo', 'IdServicioSubGrupo');
    }

    public function scopeBuscar($query, $filtro)
    {
        $filtro = str_replace(' ', '', $filtro);
        if( $filtro != null)
        {
            $query->whereRaw("REPLACE(s.Codigo+s.Nombre, ' ', '') LIKE '%$filtro%' ");
        }
    }

    public function scopeCodigo($query, $codigo)
    {
        if( trim($codigo) != null)
        {
            $query->where('s.Codigo', $codigo);
        }
    }

    public function scopeNombre($query, $nombre)
    {
        if( trim($nombre) != null)
        {
            $query->where('s.Nombre', 'LIKE',  "%$nombre%");
        }
    }

    public function insumos()
    {
        return \DB::table('LabInsumosCpt as ic')->whereNull('DeletedAt')
            ->leftJoin('FactCatalogoBienesInsumos as bi', 'bi.IdProducto', 'ic.IdProductoInsumo')
            ->where('ic.IdProductoServicio', $this->IdProducto)
            ->select('ic.IdInsumo', 'bi.Codigo', 'bi.Nombre', 'ic.Cantidad', 'ic.Unidad')->get();

        // App\Model\FactCatalogoServicios
        return $this->hasManyThrough(
            'App\Model\FactCatalogoBienesInsumos',
            'App\Model\LabInsumosCpt', 
            'IdProductoServicio',
            'IdProducto',
            'IdProducto',
            'IdProductoInsumo'
        );
    }

    public function grupoExamen()
    {
        // App\Model\FactCatalogoServicios
        return $this->hasOneThrough(
                'App\Model\LabGrupos',
                'App\Model\LabItemsCpt',
                'idProductoCpt',
                'idGrupo',
                'IdProducto',
                'idGrupo'
            );
    }

    public static function buildCatalogo($servicios)
    {
        $subGrupos = [];
        foreach($servicios as $servicio){
            $add = true;
            foreach($subGrupos as $subGrupo){
                if($subGrupo->IdServicioSubGrupo == $servicio->IdServicioSubGrupo){
                    $add = false; break;
                }
            }

            if($add){
                $subGrupoAdd = $servicio->subGrupo;
                $serviciosAdd = $servicios->where('IdServicioSubGrupo', $subGrupoAdd->IdServicioSubGrupo);
                $subGrupoAdd->serviciosFiltrados = $serviciosAdd;
                $subGrupos[] = $subGrupoAdd;
            }
        }

        // dd($subGrupos);
        return $subGrupos;
    }
}
