<?php

namespace App\VB\SIGHNegocios;

use Illuminate\Database\Eloquent\Model;

use DB;

class ReglasAdmision extends Model
{

    public function DevuelveServiciosDelHospital( $lcFiltro, $lcEspecialidades, $lnTipoEstado, $lnOrden)
    {
        $lcSql = "";
        $sWhere = "";
        if ($lnTipoEstado <> sghFiltraAnuladosYactivos ) {
            $lcSql = lcSql . " and dbo.Servicios.idEstado= " . $lnTipoEstado;
        }
        if ($lcEspecialidades <> "" ) {
            $lcSql = $lcSql & $lcEspecialidades;
        }
        if ($lnOrden == sghPorDescServicio ) {
            $lcSql = $lcSql . " ORDER BY dbo.Servicios.Nombre";
        }else {
            $lcSql = $lcSql . " ORDER BY dbo.TiposServicio.Descripcion,dbo.Servicios.Nombre";
        }
        $lcSql = $lcFiltro . $lcSql;

        $sql = 'EXEC DevuelveServiciosDelHospitalFiltro';
        $params = [
            'lcFiltro' => $lcFiltro,
        ];
        return DB::select($sql, $params);
    }

    public function DevuelveEspecialidadesDelHospital( $filtro )
    {
        $sql = "EXEC DevuelveEspecialidadesDelHospitalfiltro :filtro";
        $params = ['filtro' => $filtro];
        return DB::select($sql, $params);
    }

}