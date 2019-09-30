<?php

namespace App\VB\SIGHNegocios;

use Illuminate\Database\Eloquent\Model;

use DB;

use App\VB\SIGHDatos\ListbarItems;
use App\VB\SIGHDatos\Permisos;
use App\VB\SIGHDatos\Roles;
use App\VB\SIGHDatos\RolesItems;
use App\VB\SIGHDatos\RolesPermisos;
use App\VB\SIGHComun\DORol;
use App\VB\SIGHDatos\UsuariosRoles;

class ReglasSeguridad extends Model
{

    public function RolesSeleccionarTodos()
    {
        $oTabla = new Roles;
        return $oTabla->SeleccionarTodos();
    }

    public function ListItemsSeleccionarTodos()
    {
        $oTabla = new ListbarItems;
        return $oTabla->SeleccionarTodos();
    }

    public function PermisosSeleccionarTodos()
    {
        $oTabla = new Permisos;
        return $oTabla->SeleccionarTodos();
    }

    public function ListBarReportesSeleccionarTodos()
    {
        $data = DB::select('EXEC ListBarReporteSeleccionarTodos');
        return $data;
    }

    public function RolesAgregar($oRol, $oRolesItem, $oRolesPermiso, $oRolesReporte,$listBarItems, $nombrePC)
    {
        $oRoles = new Roles;
        $oRolesItems = new RolesItems;
        $oRolesPermisos = new RolesPermisos;

        $data = $oRoles->Insertar($oRol);
        
        if( $data->idRol > 0 )
        {
            $oRol->idRol = $data->idRol;
            if( $oRolesItems->ActualizarRolesItems($oRolesItem, $oRol->idRol) )
            {
                // dd('items actualizados');
                if( $oRolesPermisos->ActualizarRolesPermisos($oRolesPermiso, $oRol->idRol) )
                {
                    // dd('permisos actualizados');
                    foreach( $oRolesReporte as $oRolReporte){
                        $oRolReporte->idRol = $oRol->idRol;

                        $query = "EXEC RolesReportesAgregar :idRol, :idReporte, :tieneAcceso";

                        $params = [
                            'idRol' => ($oRolReporte->idRol == "")? Null: $oRolReporte->idRol, 
                            'idReporte' => ($oRolReporte->idReporte == 0)? Null: $oRolReporte->idReporte, 
                            'tieneAcceso' => ($oRolReporte->tieneAcceso == 0)? Null: $oRolReporte->tieneAcceso, 
                        ];

                        $updated = \DB::update($query, $params);
                    }
                    // dd('reportes actualizados');
                    return true;
                }
            }
        }
        
        return false;
    }

    // USO EN: ROLES MODIFICAR
    public function RolesSeleccionarPorId( $idRol )
    {
        $oTabla = new Roles;
        $rol = new DOROl;
        $rol->idRol = $idRol;
        $results = $oTabla->SeleccionarPorId( $rol );
        $data = isset($results[0])? $results[0]: null;
        return $data;
    }

    public function RolesItemsSeleccionarPorRol( $idRol )
    {
        $oTabla = new RolesItems;
        return $oTabla->SeleccionarPorRol($idRol);
    }

    // Romel diaz ramos 01/01/2019
    public function RolesPermisosSeleccionarPorRol( $idRol )
    {

        $oTabla = new RolesPermisos;
        return $oTabla->SeleccionarPorRol($idRol);
    }

    public function RolesReportesSeleccionarXrol( $idRol )
    {
        $query = "EXEC RolesReportesSeleccionarXrol :idRol";

        $params = [ 'idRol' => $idRol, ];

        return \DB::select($query, $params);
    }

    public function RolesModificar($oRol, $oRolesItem, $oRolesPermiso, $oRolesReporte,$listBarItems, $nombrePC)
    {
        $oRoles = new Roles;
        $oRolesItems = new RolesItems;
        $oRolesPermisos = new RolesPermisos;

        if( $oRoles->Modificar($oRol) )
        {
            // dd('rol actuaizado');
            if( $oRolesItems->ActualizarRolesItems($oRolesItem, $oRol->idRol) )
            {
                // dd('items actualizados');
                if( $oRolesPermisos->ActualizarRolesPermisos($oRolesPermiso, $oRol->idRol) )
                {
                    // dd('permisos actualizados');
                    $query = "RolesReportesEliminarConsultar :idRol";
                    $params = [ 'idRol' => $oRol->idRol ];
                    $data = \DB::update($query, $params);

                    foreach( $oRolesReporte as $oRolReporte){
                        $oRolReporte->idRol = $oRol->idRol;

                        $query = "EXEC RolesReportesAgregar :idRol, :idReporte, :tieneAcceso";

                        $params = [
                            'idRol' => $oRolReporte->idRol, 
                            'idReporte' => $oRolReporte->idReporte, 
                            'tieneAcceso' => $oRolReporte->tieneAcceso,
                        ];

                        $updated = \DB::update($query, $params);
                    }
                    // dd('reportes actualizados');
                    return true;
                }
            }
        }
        
        return false;
    }
    
    public function RolesEliminar($oRol, $listBarItems, $nombrePC)
    {
        $oRoles = new Roles;
        $oRolesItems = new RolesItems;

        $modulosDeleted = $oRolesItems->EliminarRolesItems($oRol->idRol);
        $oRolesItems->EliminarRolesItems($oRol->idRol);
        // dd('modulos eliminados');

        $query = "EXEC RolesReportesRolesPermisosEliminar :idRol";
        $params = [ 'idRol' => $oRol->idRol ];
        $rolesReportesDeleted = \DB::update($query, $params);
        // dd('roles y reportes eliminados');

        $rolDeleted = $oRoles->Eliminar($oRol);
        // dd('rol eliminado');
        // AuditoriaAgregarV(oDoRol.IdUsuarioAuditoria, "E", oDoRol.IdRol, "Roles", oConexion, mo_lnIdTablaLISTBARITEMS, mo_lcNombrePc, lcNombreRol)
        
        return true;
    }

    public function UsuariosRolesSeleccionarPorEmpleado( $lIdEmpleado )
    {
        $oTabla = new UsuariosRoles;
        return $oTabla->SeleccionarPorEmpleado($lIdEmpleado);
    }

}