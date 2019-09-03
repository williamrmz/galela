<?php

namespace App\Visual;

use App\BaseModel;
use DB;

class Procedure extends BaseModel
{
    
    Public static function actualizaAtencionesNacimientosEliminaAtencionesHijoMadre( $idPaciente, $idAtencion)
    {
        DB::beginTransaction();
        try {
            DB::update("UPDATE AtencionesNacimientos SET idPacienteNacido=NULL WHERE idPacienteNacido=$idPaciente");
            DB::update("DELETE FROM  AtencionesHijoMadre WHERE idAtencion=$idPaciente");
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw new Exception($e->getMessage());
        }
        return true;
    }

    //OK
    public static function auditoriaAgregar($idEmpleado, $accion, $idRegistro, $tabla)
    {
        $data = DB::table('auditoria')->insert([
            'idEmpleado' => $idEmpleado,
            'accion' => $accion,
            'idRegistro' => $idRegistro,
            'tabla' => $tabla,
            'fechaHora' => date('d-m-Y H:i:s'),
        ]);
        return $data;
    }

    //OK
    public static function labGruposAgregar(&$idGrupo, $nombreGrupo, $siglasGrupo, $idCargo, $idUsuarioAuditoria=null)
    {
        $success = DB::table('labGrupos')->insert([
            'nombreGrupo' => $nombreGrupo,
            'siglasGrupo' => $siglasGrupo,
            'idCargo' => $idCargo
        ]);
        $data = $success? DB::getPdo()->lastInsertId(): null;
        return $data;
    }

    //OK
    public static function labGruposModificar($idGrupo, $nombreGrupo, $siglasGrupo, $idCargo, $idUsuarioAuditoria=null)
    {
        $data = DB::table('labGrupos')->where('idGrupo', $idGrupo)->update([
            'nombreGrupo' => $nombreGrupo,
            'siglasGrupo' => $siglasGrupo,
            'idCargo' => $idCargo
        ]);
        return $data;
    }

    //OK
    public static function labGruposEliminar($idGrupo, $idUsuarioAuditoria=null)
    {
        $data = DB::table('labGrupos')->where('idGrupo', $idGrupo)->delete();
        return $data;
    }

    //OK
    public static function labGruposSeleccionarPorId($idGrupo)
    {
        $data = DB::table('labGrupos')->where('idGrupo', $idGrupo)
            ->select('idGrupo', 'nombreGrupo', 'siglasGrupo', 'idCargo')->first();
        return $data;
    }

    //OK
    public static function labGruposSeleccionarTodos()
    {
        $data = DB::table('labGrupos')
            ->select('idGrupo', 'nombreGrupo', 'siglasGrupo', 'idCargo')->get();
        return $data;
    }

    //OK
    public static function rolesAgregar($nombre, $idUsuarioAuditoria=null)
    {
        $success = DB::table('roles')->insert([
            'nombre' => $nombre,
        ]);

        $data = $success? DB::getPdo()->lastInsertId(): null;
        // self::auditoriaAgregar($idUsuarioAuditoria, 'C', $id, 'roles');
        return $data;
    }

    //OK
    public static function rolesEliminar($idRol, $idUsuarioAuditoria=null)
    {
        $data = DB::table('roles')->where('idRol', $idRol)->delete();
        return $data;
    }

    
    public static function rolesItemsAgregar($consultar, $eliminar, $modificar, $agregar, $idRol, $idListItem, $idRolItem, $idUsuarioAuditoria=null)
    {
        $success = DB::table('rolesItems')->insert([
            'consultar' => $consultar,
            'eliminar' => $eliminar,
            'modificar' => $modificar,
            'agregar' => $agregar,
            'idRol' => $idRol,
            'idListItem' => $idListItem,
        ]);

        $data = $success? DB::getPdo()->lastInsertId(): null;
        return $data;
    }

    //OK
    public static function rolesItemSeleccionarPermisosPorIdEmpleadoYIdListItem( $idEmpleado, $idListItem)
    {
        $data = DB::table('empleados as e')
            ->leftJoin('usuariosRoles as ur', 'ur.idEmpleado', 'e.idEmpleado')
            ->leftJoin('rolesItems as ri', 'ri.idRol', 'ur.idRol')
            ->where('e.idEmpleado', $idEmpleado)
            ->where('ri.IdListItem', $idListItem)
            ->select(
                DB::Raw("SUM(cast(ri.agregar as int)) as agregar"), 
                DB::Raw("SUM(cast(ri.modificar as int)) as modificar"), 
                DB::Raw("SUM(cast(ri.eliminar as int)) as eliminar"), 
                DB::Raw("SUM(cast(ri.consultar as int)) as consultar")
            )
            ->get();
        return $data;
    }

    public static function rolesItemsEliminar($idRolItem, $idUsuarioAuditoria=null)
    {
        $data = DB::table('rolesItems')->where('idRolItem', $idRolItem)->delete();
        return $data;
    }


    public static function rolesItemsEliminarXidRol($idRol)
    {
        $data = DB::table('rolesItems')->where('idRol', $idRol)->delete();
        return $data;
    }


    public static function rolesItemsModificar($consultar, $eliminar, $modificar, $agregar, $idRol, $idListItem, $idRolItem, $idUsuarioAuditoria=null)
    {
        $data = DB::table('rolesItems')->where('idRolItem', $idRolItem)->insert([
            'consultar' => $consultar,
            'eliminar' => $eliminar,
            'modificar' => $modificar,
            'agregar' => $agregar,
            'idRol' => $idRol,
            'idListItem' => $idListItem,
        ]);
        $idRol = DB::getPdo()->lastInsertId();
        return $data;
    }

    //OK
    public static function rolesItemsSeleccionarGruposPorUsuario($idUsuario)
    {
        $data = DB::table('empleados as e')
            ->leftJoin('usuariosRoles as ur', 'ur.idEmpleado', 'e.idEmpleado')
            ->leftJoin('rolesItems as ri', 'ri.idRol', 'ur.idRol')
            ->leftJoin('listBarItems as li', 'li.idListItem', 'ri.idListItem')
            ->leftJoin('listBarGrupos as lg', 'lg.idListGrupo', 'li.idListGrupo')
            ->where('e.idEmpleado', $idUsuario)
            ->select('lg.idListGrupo', 'lg.clave', 'lg.texto', 'lg.indice')
            ->orderBy('lg.indice', 'asc')
            ->distinct()
            ->get();
        return $data;
    }

    //OK
    public static function rolesItemsSeleccionarItemsPorUsuarioYGrupo($idGrupo, $idUsuario)
    {
        $query = DB::table('empleados as e')
            ->leftJoin('usuariosRoles as ur', 'ur.idEmpleado', 'e.idEmpleado')
            ->leftJoin('rolesItems as ri', 'ri.idRol', 'ur.idRol')
            ->leftJoin('listBarItems as li', 'li.idListItem', 'ri.idListItem')
            ->leftJoin('listBarGrupos as lg', 'lg.idListGrupo', 'li.idListGrupo')
            ->where('e.idEmpleado', $idUsuario);

        if($idGrupo > 0) $query->where('li.idListGrupo', $idGrupo) ; 

        $data = $query->select('li.idListItem', 'li.clave', 'li.texto', 'li.indice', 'li.keyIcon', 'li.idListGrupo')
            ->orderBy('li.indice', 'asc')->distinct()->get();
        return $data;
    }

    //OK
    public static function rolesItemsSeleccionarPorId( $idRolItem )
    {
        $data = DB::table('rolesItems')->where('idRolItem', $idRolItem)
            ->select('idRolItem', 'idListItem', 'idRol', 'agregar', 'modificar', 'eliminar', 'consultar')    
            ->get();
        return $data;
    }

    //OK
    public static function rolesItemsSeleccionarPorRol( $idRol )
    {
        $data = DB::table('rolesItems as ri')->where('ri.idRol', $idRol)
            ->leftJoin('listBarItems as li', 'li.idListItem', 'ri.idListItem')
            ->leftJoin('listBarGrupos as lg', 'lg.idListGrupo', 'li.idListGrupo')
            ->select('li.idListItem', 'li.texto as subModulo', 'lg.texto as modulo', 
                'ri.agregar', 'ri.modificar', 'ri.eliminar', 'ri.consultar')    
            ->get();
        return $data;
    }

    //OK
    public static function rolesModificar($idRol, $nombre, $idUsuarioAuditoria=null)
    {
        $data = DB::table('roles')->where('idRol', $idRol)->update([
            'nombre' => $nombre,
        ]);
        return $data;
    }


    public static function rolesPermisosAgregar($idRol, $idPermiso, &$idRolPermiso, $idUsuarioAuditoria=null)
    {
        $success = DB::table('rolesPermisos')->insert([
            'idRol' => $idRol,
            'idPermiso' => $idPermiso,
        ]);

        $data = $success? DB::getPdo()->lastInsertId(): null;
        self::auditoriaAgregar($idUsuarioAuditoria, 'A', $idRolPermiso, 'rolesPermisos');
        return $data;
    }

    public static function rolesPermisosEliminar($idRolPermiso, $idUsuarioAuditoria=null)
    {
        $data = DB::table('rolesPermisos')->where('idRolPermiso', $idRolPermiso)->delete();
        self::auditoriaAgregar($idUsuarioAuditoria, 'E', $idRolPermiso, 'rolesPermisos');
        return $data;
    }

    public static function rolesPermisosEliminarPorIdRol($idRol)
    {
        $data = DB::table('rolesPermisos')->where('idRol', $idRol)->delete();
        return $data;
    }

    public static function rolesPermisosModificar($idRol, $idPermiso, $idRolPermiso, $idUsuarioAuditoria=null)
    {
        $data = DB::table('rolesPermisos')->where('idRolPermiso', $idRolPermiso)->update([
            'idRol' => $idRol,
            'idPermiso' => $idPermiso
        ]);
        self::auditoriaAgregar($idUsuarioAuditoria, 'M', $idRolPermiso, 'rolesPermisos');
        return $data;
    }

    //OK
    public static function rolesPermisosSeleccionarPorId($idRolPermiso)
    {
        $data = DB::table('rolesPermisos')->where('idRolPermiso', $idRolPermiso)
            ->select('idRolPermiso', 'idPermiso', 'idRol')->get();
        return $data;
    }

    //OK
    public static function rolesPermisosSeleccionarPorRol($idRol)
    {
        $data = DB::table('rolesPermisos as rp')
            ->leftJoin('permisos as p', 'p.idPermiso', 'rp.idPermiso')
            ->where('rp.idRol', $idRol)
            ->select('p.idPermiso', 'p.descripcion')
            ->orderBy('p.descripcion')->get();
        return $data;
    }

    //OK
    public static function rolesPermisosXidEmpleado($idEmpleado)
    {
        $data = DB::table('Empleados as e')
            ->leftJoin('UsuariosRoles as ur', 'ur.idEmpleado', 'e.idEmpleado')
            ->leftJoin('Roles as r', 'r.idRol', 'ur.idRol')
            ->leftJoin('RolesPermisos as rp', 'rp.idRol', 'r.idRol')
            ->leftJoin('Permisos as p', 'p.idPermiso', 'rp.idPermiso')
            ->where('e.idEmpleado', $idEmpleado)
            ->select('rp.idPermiso', 'p.descripcion', 'p.modulo')
            ->distinct()->get();
        return $data;
    }

    public static function rolesReportesAgregar($idRol, $idReporte, $tieneAcceso)
    {
        $data = DB::table('rolesReportes')->insert([
            'idRol' => $idRol,
            'idReporte' => $idReporte,
            'tieneAcceso' => $moditieneAccesoficar,
        ]);

        return $data;
    }

    //OK
    public static function rolesReportesConsultar()
    {
        $data = DB::table('rolesReportes')->select('idRol', 'idReporte', 'tieneAcceso')->get();
        return $data;
    }

    public static function rolesReportesEliminarConsultar( $idRol )
    {
        $data = DB::table('rolesReportes')->where('idRol', $idRol)->delete();
        return $data;
    }

    public static function rolesReportesRolesPermisosEliminar( $idRol )
    {
        //transaction
        $data = true;
        DB::table('RolesReportes')->where('idRol', $idRol)->delete();
        DB::table('RolesPermisos')->where('idRol', $idRol)->delete();
        return $data;
    }

    //OK
    public static function rolesReportesSeleccionarXrol($idRol)
    {
        $data = DB::table('RolesReportes as rr')
            ->leftJoin('ListBarReporte as lr', 'lr.idReporte', 'rr.idReporte')
            ->where('rr.tieneAcceso', 1)
            ->where('rr.idRol', $idRol)
            ->select('rr.idRol', 'rr.idReporte', 'lr.reporte', 'lr.modulo', 'lr.id_menuReporte', 'rr.tieneAcceso')
            ->orderBy('lr.modulo', 'asc')
            ->orderBy('lr.reporte', 'asc')
            ->get();
        return $data;
    }

    //OK
    public static function rolesSeleccionarPorId( $idRol )
    {
        $data = DB::table('roles')->where('idRol', $idRol)
            ->select('idRol', 'nombre')->first();
        return $data;
    }

    //OK
    public static function rolesSeleccionarTodos()
    {
        $data = DB::table('roles')
            ->select('idRol', 'nombre')->get();
        return $data;
    }


    public static function ListbarGruposAgregar($indice, $clave, $text, $idListGrupo, $idUsuarioAuditoria=null)
    {
        $success = DB::table('listbarGrupos')->insert([
            'indice' => $indice,
            'clave' => $clave,
            'text' => $text,
        ]);

        $data = $success? DB::getPdo()->lastInsertId(): null;
        // self::auditoriaAgregar($idUsuarioAuditoria, 'A', $data, 'listbarGrupos');
        return $data;
    }

    public static function ListbarGruposEliminar($idListGrupo, $idUsuarioAuditoria=null)
    {
        $data = DB::table('listbarGrupos')->where('idListGrupo', $idListGrupo)->delete();
        // self::auditoriaAgregar($idUsuarioAuditoria, 'E', $idListGrupo, 'listbarGrupos');
        return $data;
    }

    public static function ListbarGruposModificar($indice, $clave, $text, $idListGrupo, $idUsuarioAuditoria=null)
    {
        $data = DB::table('listbarGrupos')->where('idListGrupo')->update([
            'indice' => $indice,
            'clave' => $clave,
            'text' => $text,
        ]);
        // self::auditoriaAgregar($idUsuarioAuditoria, 'M', $idListGrupo, 'listbarGrupos');
        return $data;
    }

    public static function ListbarGruposSeleccionarPorId($idListGrupo)
    {
        $data = DB::table('listbarGrupos')->where('idListGrupo', $idListGrupo)->first();
        return $data;
    }

    public static function ListbarItemsAgregar($keyIcon, $indice, $clave, $texto, $idListGrupo, $idListItem, $idUsuarioAuditoria=null)
    {
        $success = DB::table('listbarItems')->insert([
            'keyIcon' => $keyIcon,
            'indice' => $indice,
            'clave' => $clave,
            'texto' => $texto,
            'idListGrupo' => $idListGrupo,
        ]);

        $data = $success? DB::getPdo()->lastInsertId(): null;
        return $data;
    }

    public static function ListbarItemsEliminar($idListItem, $idUsuarioAuditoria)
    {
        $data = DB::table('listbarItems')->where('idListItem', $idListItem)->delete();
        return $data;
    }


    public static function ListbarItemsModificar($keyIcon, $indice, $clave, $text, $idListGrupo, $idListItem, $idUsuarioAuditoria=null)
    {
        $success = DB::table('listbarItems')->where('idListItem', $idListItem)->update([
            'keyIcon' => $keyIcon,
            'indice' => $indice,
            'clave' => $clave,
            'text' => $text,
            'idListGrupo' => $idListGrupo,
        ]);

        return $data;
    }

    //OK
    public static function ListbarItemsSeleccionarPorId($idListItem)
    {
        $data = DB::table('listbarItems')->where('idListItem', $idListItem)
            ->select('idListItem', 'texto', 'clave', 'idListGrupo', 'indice', 'keyIcon')->first();
        return $data;
    }

    //OK
    public static function ListbarItemsSeleccionarTodos()
    {
        $data = DB::table('listbarItems as li')
            ->leftJoin('listbarGrupos as lg', 'lg.idListGrupo', 'li.idListGrupo')
            ->select('li.idListItem', 'li.texto as subModulo', 'lg.texto as modulo')
            ->orderBy('lg.texto', 'asc')
            ->orderBy('lg.idListGrupo', 'asc')
            ->get();
        return $data;
    }

    //OK
    public static function ListBarReporteSeleccionarTodos()
    {
        $data = DB::table('ListBarReporte')
            ->select('idReporte','reporte','modulo','id_menuReporte')
            ->orderBy('modulo', 'asc')
            ->orderBy('reporte', 'asc')
            ->get();
        return $data;
    }


    public static function LabMovimientoLaboratorioSeleccionarPorFechasDinamicoOrden($desdeFecha, $hastaFecha, $tipoOrden)
    {
        $params = [
            'desdeFecha' => $desdeFecha,
            'hastaFecha' => $hastaFecha,
        ];
        $sql = "";
        if($tipoOrden > 0 ){
            $sql = "SELECT dbo.FactCatalogoServicios.Codigo, dbo.FactCatalogoServicios.Nombre, dbo.LabMovimiento.MovTipo, dbo.LabMovimiento.IdTipoConcepto,
           dbo.LabTipoConceptos.Concepto, dbo.LabMovimiento.Fecha, dbo.LabMovimientoLaboratorio.*, dbo.FactOrdenServicio.IdPaciente,
           dbo.Pacientes.ApellidoPaterno, dbo.Pacientes.ApellidoMaterno, dbo.Pacientes.PrimerNombre, dbo.Pacientes.NroHistoriaClinica,
           dbo.Pacientes.IdTipoSexo, dbo.Pacientes.FechaNacimiento, dbo.Servicios.Nombre AS dServicio, dbo.CajaComprobantesPago.NroSerie,
           dbo.CajaComprobantesPago.NroDocumento, dbo.FactOrdenServicio.IdServicioPaciente, dbo.FactOrdenServicio.idFuenteFinanciamiento,
           dbo.FuentesFinanciamiento.Descripcion AS nombrePlan, dbo.LabMovimientoCPT.cantidad, dbo.LabMovimientoCPT.precio,
           dbo.LabMovimientoCPT.importe AS total,dbo.LabMovimientoCPT.idProductoCPT, dbo.Servicios.idTipoServicio,
           dbo.Pacientes.NroDocumento as DNI,dbo.LabMovimientoLaboratorio.Paciente
            FROM dbo.LabMovimientoLaboratorio INNER JOIN
           dbo.LabMovimiento ON dbo.LabMovimientoLaboratorio.IdMovimiento = dbo.LabMovimiento.IdMovimiento RIGHT OUTER JOIN
           dbo.LabMovimientoCPT LEFT OUTER JOIN
           dbo.FactCatalogoServicios ON dbo.LabMovimientoCPT.idProductoCPT = dbo.FactCatalogoServicios.IdProducto ON
           dbo.LabMovimiento.IdMovimiento = dbo.LabMovimientoCPT.idMovimiento LEFT OUTER JOIN
           dbo.CajaComprobantesPago ON
           dbo.LabMovimientoLaboratorio.IdComprobantePago = dbo.CajaComprobantesPago.IdComprobantePago LEFT OUTER JOIN
           dbo.Pacientes RIGHT OUTER JOIN
           dbo.FuentesFinanciamiento RIGHT OUTER JOIN
           dbo.FactOrdenServicio ON dbo.FuentesFinanciamiento.IdFuenteFinanciamiento = dbo.FactOrdenServicio.idFuenteFinanciamiento LEFT OUTER JOIN
           dbo.Servicios ON dbo.FactOrdenServicio.IdServicioPaciente = dbo.Servicios.IdServicio ON
           dbo.Pacientes.IdPaciente = dbo.FactOrdenServicio.IdPaciente ON
           dbo.LabMovimientoLaboratorio.IdOrden = dbo.FactOrdenServicio.IdOrden LEFT OUTER JOIN
           dbo.LabTipoConceptos ON dbo.LabMovimiento.IdTipoConcepto = dbo.LabTipoConceptos.idTipoConcepto
            WHERE dbo.LabMovimiento.Fecha Between :desdeFecha and :hastaFecha
           and dbo.LabMovimiento.IdLabEstado<>0 and   dbo.LabMovimiento.IdTipoConcepto=3
           ORDER BY dbo.LabMovimientoCpt.idProductoCPT,dbo.LabMovimiento.Fecha";
        }else{
            $sql = "SELECT dbo.FactCatalogoServicios.Codigo, dbo.FactCatalogoServicios.Nombre, dbo.LabMovimiento.MovTipo, dbo.LabMovimiento.IdTipoConcepto,
            dbo.LabTipoConceptos.Concepto, dbo.LabMovimiento.Fecha, dbo.LabMovimientoLaboratorio.*, dbo.FactOrdenServicio.IdPaciente,
            dbo.Pacientes.ApellidoPaterno, dbo.Pacientes.ApellidoMaterno, dbo.Pacientes.PrimerNombre, dbo.Pacientes.NroHistoriaClinica,
            dbo.Pacientes.IdTipoSexo, dbo.Pacientes.FechaNacimiento, dbo.Servicios.Nombre AS dServicio, dbo.CajaComprobantesPago.NroSerie,
            dbo.CajaComprobantesPago.NroDocumento, dbo.FactOrdenServicio.IdServicioPaciente, dbo.FactOrdenServicio.idFuenteFinanciamiento,
            dbo.FuentesFinanciamiento.Descripcion AS nombrePlan, dbo.LabMovimientoCPT.cantidad, dbo.LabMovimientoCPT.precio,
            dbo.LabMovimientoCPT.importe AS total,dbo.LabMovimientoCPT.idProductoCPT, dbo.Servicios.idTipoServicio,
            dbo.Pacientes.NroDocumento as DNI,dbo.LabMovimientoLaboratorio.Paciente
             FROM dbo.LabMovimientoLaboratorio INNER JOIN
            dbo.LabMovimiento ON dbo.LabMovimientoLaboratorio.IdMovimiento = dbo.LabMovimiento.IdMovimiento RIGHT OUTER JOIN
            dbo.LabMovimientoCPT LEFT OUTER JOIN
            dbo.FactCatalogoServicios ON dbo.LabMovimientoCPT.idProductoCPT = dbo.FactCatalogoServicios.IdProducto ON
            dbo.LabMovimiento.IdMovimiento = dbo.LabMovimientoCPT.idMovimiento LEFT OUTER JOIN
            dbo.CajaComprobantesPago ON
            dbo.LabMovimientoLaboratorio.IdComprobantePago = dbo.CajaComprobantesPago.IdComprobantePago LEFT OUTER JOIN
            dbo.Pacientes RIGHT OUTER JOIN
            dbo.FuentesFinanciamiento RIGHT OUTER JOIN
            dbo.FactOrdenServicio ON dbo.FuentesFinanciamiento.IdFuenteFinanciamiento = dbo.FactOrdenServicio.idFuenteFinanciamiento LEFT OUTER JOIN
            dbo.Servicios ON dbo.FactOrdenServicio.IdServicioPaciente = dbo.Servicios.IdServicio ON
            dbo.Pacientes.IdPaciente = dbo.FactOrdenServicio.IdPaciente ON
            dbo.LabMovimientoLaboratorio.IdOrden = dbo.FactOrdenServicio.IdOrden LEFT OUTER JOIN
            dbo.LabTipoConceptos ON dbo.LabMovimiento.IdTipoConcepto = dbo.LabTipoConceptos.idTipoConcepto
             WHERE dbo.LabMovimiento.Fecha Between :desdeFecha and :hastaFecha
            and dbo.LabMovimiento.IdLabEstado<>0 and   dbo.LabMovimiento.IdTipoConcepto=3
            ORDER BY dbo.LabMovimiento.Fecha,dbo.LabMovimientoLaboratorio.Paciente";
        }

        $data = DB::select($sql, $params);
        return $data;
    }
}
