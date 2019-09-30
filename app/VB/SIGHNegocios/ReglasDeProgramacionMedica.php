<?php

namespace App\VB\SIGHNegocios;

use Illuminate\Database\Eloquent\Model;

use DB;

use App\VB\SIGHDatos\Medicos;
use App\VB\SIGHDatos\ProgramacionMedica;


class ReglasDeProgramacionMedica extends Model
{

    public function __construct()
    {

    }
    
    // Created by Romel Diaz at 2019-09-30
    // 'MODIFICADO FRANKLIN CACHAY 10/10/2013 - se agrego oConexion.CommandTimeout = 300
    public function MedicosFiltrarPorDptoYEspecialidadSql2000($iddepartamento, $IdEspecialidad)
    {
        $oMedico =  new Medicos;
        return  $oMedico->FiltrarPorDptosYEspecialidadEsActivo($iddepartamento, $IdEspecialidad);
    }

    // Created by Romel Diaz at 2019-09-30
    Function MedicosFiltrarPorDptoYEspecialidadConEspecialidad($iddepartamento, $IdEspecialidad)
    {

        $data = DB::table('medicos as m')
            ->leftJoin('medicosEspecialidad as me', 'm.idMedico', '=', 'me.idMedico')
            ->leftJoin('especialidades as es', 'es.idEspecialidad', '=', 'me.idEspecialidad')
            ->leftJoin('empleados as em', 'm.idEmpleado ', '=', 'em.idEmpleado')
            ->selectRaw('distinct m.idMedico, em.ApellidoPaterno + " " as "nombre"')
            ->get();
        dd( $data);


        // select distinct m.idMedico, em.ApellidoMaterno 
        // from medicos m
        // left join medicosEspecialidad me on m.idMedico = me.idMedico
        // left join especialidades es on es.idEspecialidad = me.idEspecialidad
        // left join empleados em on m.idEmpleado = em.idEmpleado


        // $oMedico =  new Medicos;
        // return  $oMedico->FiltrarPorDptosYEspecialidadEsActivoConEspecialidad($iddepartamento, $IdEspecialidad);
    }

    // Created by Romel Diaz at 2019-09-30
    Function ProgramacionMedicaSeleccionarDiasDeCEPorMedicoYMes($IdMedico, $iMes, $iAnio)
    {
        $oProgramacion = new ProgramacionMedica;
        return $oProgramacion->SeleccionarDiasDeCEProgPorMedicoYMes($IdMedico, $iMes, $iAnio);
    }
}