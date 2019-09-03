<?php

namespace App\VB\SIGHNegocios;

use Illuminate\Database\Eloquent\Model;

use DB;

use App\VB\SIGHDatos\TiposCondicionTrabajo;
use App\VB\SIGHDatos\TiposDocIdentidad;
use App\VB\SIGHDatos\TiposFinanciamiento;
use App\VB\SIGHDatos\Empleados;
use App\VB\SIGHDatos\UsuariosRoles;
use App\VB\SIGHDatos\Parametros;

use App\VB\SIGHDatos\CentrosCosto;
use App\VB\SIGHDatos\PartidasPresupuestales;
use App\VB\SIGHDatos\CatalogoServicios;
use App\VB\SIGHDatos\CatalogoServiciosGrupo;
use App\VB\SIGHDatos\FactPuntosCarga;
use App\VB\SIGHDatos\CatalogoServiciosSubGrupo;
use App\VB\SIGHDatos\CatalogoServiciosSeccion;
use App\VB\SIGHDatos\CatalogoServiciosSubSeccion;


use App\VB\SIGHComun\DOEmpleado;
use App\VB\SIGHComun\DOCatalogoServicio;


class ReglasComunes extends Model
{
    public function EmpleadosFiltrar( $oDOEmpleado )
    {
        $oTabla = new Empleados;
        return $oTabla->Filtrar($oDOEmpleado);
    }

    public function TiposEmpleadosSeleccionarSegunFiltro( $where)
    {
        $sql = "EXEC TiposEmpleadosSeleccionarSegunFiltro :where";
        $params = ['where' => $where];
        return DB::select($sql, $params);
    }

    public function TiposCondicionTrabajoSeleccionarTodos()
    {
        $oTabla = new TiposCondicionTrabajo;
        return $oTabla->SeleccionarTodos();
    }

    public function TiposDestacadosSeleccionarTodos()
    {
        $sql = "EXEC TiposDestacadosSeleccionarTodos";
        return DB::select($sql);
    }

    public function TiposDocIdentidadSeleccionarTodos()
    {
        $oTabla = new TiposDocIdentidad;
        return $oTabla->SeleccionarTodos();
    }

    public function FactPuntosCargaSeleccionarPorFiltro( $filtro )
    {
        $query = "EXEC FactPuntosCargaSeleccionarPorFiltro :filtro";

        $params = [ 'filtro' => $filtro, ];

        return \DB::select($query, $params);
    }

    public function TiposFinanciamientoSegunFiltro( $filtro )
    {
        $oTiposFinanciamiento = new TiposFinanciamiento;
        return $oTiposFinanciamiento->TiposFinanciamientoSegunFiltro( $filtro );
    }

    public function EmpleadosAgregar($oDOEmpleado, $oUsuariosRoles, $oRsCargos, $oRsLaboraEn, $mo_lnIdTablaLISTBARITEMS, $mo_lcNombrePc, $lcNombreEmpleado, $lcDniEncriptado)
    {
        $empleadosAgregar = false;
        $oEmpleado = new Empleados;

        $empleadoInsertar = $oEmpleado->Insertar($oDOEmpleado);

        if( isset($empleadoInsertar->idEmpleado) ){
            $oDOEmpleado->idEmpleado = $empleadoInsertar->idEmpleado;
            // dd('usuario insertado');
            $oUsuarioRol = new UsuariosRoles;
            $actualizaUsuario = $oUsuarioRol->ActualizarPorEmpleado($oUsuariosRoles, $oDOEmpleado->idEmpleado);
            // dd('roles actualizados');
            // dd($actualizaUsuario);
            if( $actualizaUsuario ){
                // cargos
                foreach( $oRsCargos as $row){
                    $row->idEmpleado = $oDOEmpleado->idEmpleado;
                    $sql = 'EXEC EmpleadosCargosAgregar :idTipoCargo, :idEmpleado';
                    $params = [
                        'idTipoCargo' => $row->idTipoCargo,
                        'idEmpleado' => $row->idEmpleado,
                    ];
                    $agregaCargo = DB::update($sql, $params);
                }
                // dd('cargos agregados');

                // lugares de trabajo
                $lnIdEspecialidadAC = null;
                $lbTrabajaEnArchivoClinico = false;
                $oRsTmp = DB::select('EXEC ConsultaServiciosXidServicio :idServicio', ['idServicio' => $this->ParametrosIdServicioArchivoClinico()]);
                // dd($oRsTmp);
                if( count($oRsTmp) == 0){
                    // alert()
                }else{
                    $lnIdEspecialidadAC = $oRsTmp[0]->idEspecialidad;
                }
                // dd($lnIdEspecialidadAC);

                foreach($oRsLaboraEn as $row){
                    $row->idEmpleado = $oDOEmpleado->idEmpleado;
                    $sql = 'EXEC EmpleadosLugarDeTrabajoAgregar :idEmpleado, :idLaboraArea, :idLaboraSubArea';
                    $params = [
                        'idEmpleado' => $row->idEmpleado,
                        'idLaboraArea' => $row->idLaboraArea,
                        'idLaboraSubArea' => $row->idLaboraSubArea,
                    ];

                    $agregaLugar = DB::update($sql, $params);

                    if ($lnIdEspecialidadAC == $row->idLaboraSubArea ) {
                        $lbTrabajaEnArchivoClinico = True;
                    }
                }
                // dd('lugares agregados');

                // archivero (Archivo Clinico)
                if( $lbTrabajaEnArchivoClinico ){
                    dd('aki');
                    $oBuscaServicios = new  SIGHNegocios.ReglasAdmision;
                    $oRsSubArea = $oBuscaServicios->DevuelveServiciosDelHospital("(1,2,3,4)", "", sghFiltraAnuladosYactivos, sghPorDescTipoServicio);
                    foreach ($oRsSubArea as $subArea){
                        $sql = 'EXEC ArchiveroServicioAgregar :idServicio, :idEmpleado, :idArchivero, :idUsuarioAuditoria';
                        $params = [
                            'idServicio' => $subArea->IdServicio,
                            'idLaboraArea' => $row->idLaboraArea,
                            'idArchivero' => $oDOEmpleado->idEmpleado,
                            'idUsuarioAuditoria' => 0,
                        ];
                        $agregaLugar = DB::update($sql, $params);
                    }
                }
                // dd($lcDniEncriptado);

                if ( $lcDniEncriptado <> '') {
                    $sql = 'EXEC parametrosModificarDniEncriptado :dniEncriptado';
                    $params = [
                        'dniEncriptado' => $lcDniEncriptado,
                    ];
                    $tmp = DB::update($sql, $params);
                }

                $au =AuditoriaAgregarV($oDOEmpleado->idUsuarioAuditoria, "A", $oDOEmpleado->idEmpleado, "Empleados", $mo_lnIdTablaLISTBARITEMS, $mo_lcNombrePc, $lcNombreEmpleado);
                // dd($au);
                $empleadosAgregar = true;
                return $empleadosAgregar;
            }
        }
    }

    public function EmpleadosModificar($oDOEmpleado, $oUsuariosRoles, $oRsCargos, $oRsLaboraEn, $mo_lnIdTablaLISTBARITEMS, $mo_lcNombrePc, $lcNombreEmpleado, $lcDniEncriptado)
    {
        $empleadosModificar = false;
        $oEmpleado = new Empleados;

        $empleadoModificado = $oEmpleado->Modificar($oDOEmpleado);

        if( $empleadoModificado ){
            // dd('usuario modificado');
            $oUsuarioRol = new UsuariosRoles;
            // Call mo_ReglasSeguridad.AuditoriaAgregarV(oDOEmpleado.IdUsuarioAuditoria, "M", oDOEmpleado.idEmpleado, "Empleados", oConexion, mo_lnIdTablaLISTBARITEMS, mo_lcNombrePc, lcNombreEmpleado)
            $actualizaUsuario = $oUsuarioRol->ActualizarPorEmpleado($oUsuariosRoles, $oDOEmpleado->idEmpleado);
            // dd('roles actualizados(eliminados y creados');
            // dd($actualizaUsuario);
            if( $actualizaUsuario ){
                // cargos
                $sql = 'EXEC EmpleadosCargosEliminar :idEmpleado';
                $params = [ 'idEmpleado' => $oDOEmpleado->idEmpleado, ];
                $eliminaCargos = DB::update($sql, $params);
                // dd($eliminaCargos);
                // dd('cargos eliminados');
                foreach( $oRsCargos as $row){
                    $row->idEmpleado = $oDOEmpleado->idEmpleado;
                    $sql = 'EXEC EmpleadosCargosAgregar :idTipoCargo, :idEmpleado';
                    $params = [
                        'idTipoCargo' => $row->idTipoCargo,
                        'idEmpleado' => $row->idEmpleado,
                    ];
                    $agregaCargo = DB::update($sql, $params);
                }
                // dd('cargos agregados');

                // lugares donde labora
                $sql = 'EXEC EmpleadosLugarDeTrabajoEliminar :idEmpleado';
                $params = [ 'idEmpleado' => $oDOEmpleado->idEmpleado, ];
                $eliminaLugares = DB::update($sql, $params);
                // dd($eliminaLugares);
                // dd('lugares eliminados');

                $lnIdEspecialidadAC = null;
                $lbTrabajaEnArchivoClinico = false;
                $oRsTmp = DB::select('EXEC ConsultaServiciosXidServicio :idServicio', ['idServicio' => $this->ParametrosIdServicioArchivoClinico()]);
                // dd($oRsTmp);
                if( count($oRsTmp) == 0){
                    // alert()
                }else{
                    $lnIdEspecialidadAC = $oRsTmp[0]->idEspecialidad;
                }
                // dd($lnIdEspecialidadAC);

                foreach($oRsLaboraEn as $row){
                    $row->idEmpleado = $oDOEmpleado->idEmpleado;
                    $sql = 'EXEC EmpleadosLugarDeTrabajoAgregar :idEmpleado, :idLaboraArea, :idLaboraSubArea';
                    $params = [
                        'idEmpleado' => $row->idEmpleado,
                        'idLaboraArea' => $row->idLaboraArea,
                        'idLaboraSubArea' => $row->idLaboraSubArea,
                    ];

                    $agregaLugar = DB::update($sql, $params);

                    if ($lnIdEspecialidadAC == $row->idLaboraSubArea ) {
                        $lbTrabajaEnArchivoClinico = True;
                    }
                }
                // dd('lugares agregados');

                // archivero (Archivo Clinico)
                $sql = 'EXEC ArchiveroServicioEliminarXIdEmpleado :idEmpleado';
                $params = [ 'idEmpleado' => $oDOEmpleado->idEmpleado, ];
                $eliminaArchivero = DB::update($sql, $params);
                // dd($eliminaArchivero);

                if( $lbTrabajaEnArchivoClinico ){
                    dd('aki');
                    $oBuscaServicios = new  SIGHNegocios.ReglasAdmision;
                    $oRsSubArea = $oBuscaServicios->DevuelveServiciosDelHospital("(1,2,3,4)", "", sghFiltraAnuladosYactivos, sghPorDescTipoServicio);
                    foreach ($oRsSubArea as $subArea){
                        $sql = 'EXEC ArchiveroServicioAgregar :idServicio, :idEmpleado, :idArchivero, :idUsuarioAuditoria';
                        $params = [
                            'idServicio' => $subArea->IdServicio,
                            'idLaboraArea' => $row->idLaboraArea,
                            'idArchivero' => $oDOEmpleado->idEmpleado,
                            'idUsuarioAuditoria' => 0,
                        ];
                        $agregaLugar = DB::update($sql, $params);
                    }
                }
                // dd($lcDniEncriptado);

                if ( $lcDniEncriptado <> '') {
                    $sql = 'EXEC parametrosModificarDniEncriptado :dniEncriptado';
                    $params = [
                        'dniEncriptado' => $lcDniEncriptado,
                    ];
                    $tmp = DB::update($sql, $params);
                }
                $au = AuditoriaAgregarV($oDOEmpleado->idUsuarioAuditoria, "M", $oDOEmpleado->idEmpleado, "Empleados", $mo_lnIdTablaLISTBARITEMS, $mo_lcNombrePc, $lcNombreEmpleado);
                // dd($au);
                $empleadosModificar = true;
                return $empleadosModificar;
            }
        }
    }

    public function EmpleadosEliminar($oDOEmpleado, $idListItem, $mo_lcNombrePc, $lcNombreEmpleado)
    {
        $oEmpleado = new Empleados;
        $oUsuarioRol = new UsuariosRoles;

        // Medicos
        $sql = 'EXEC EmpleadosMedicosConsultar :idEmpleado';
        $params = [ 'idEmpleado' => $oDOEmpleado->idEmpleado, ];
        $oRsTmp = DB::select($sql, $params);
        foreach($oRsTmp as $row){
            $sql = 'EXEC MedicosEspecialidadEliminarPorIdMedico :idMedico';
            $params = [ 'idMedico' => $row->IdMedico, ];
            $eliminarMedicoEspecialidad = DB::update($sql, $params);

            $sql = 'EXEC MedicosEliminar :idMedico, :idUsuarioAuditoria';
            $params = [ 'idMedico' => $row->IdMedico, 'idUsuarioAuditoria' => $oDOEmpleado->idUsuarioAuditoria];
            $eliminarMedico = DB::update($sql, $params);

        }
        // dd('MedicosEspecialidad, Medicos eliminados');

        // Cargos
        $sql = 'EXEC EmpleadosCargosLugarDeTrabajoArchiveroServicioEliminar :idEmpleado';
        $params = [ 'idEmpleado' => $oDOEmpleado->idEmpleado, ];
        $elimnarCargosLugaresArchivero = DB::update($sql, $params);
        // dd('Cargos, Lugares, Archiveros eliminados!');

        $eliminarUsuario = $oUsuarioRol->EliminarPorEmpleado($oDOEmpleado->idEmpleado);
        // dd($eliminarUsuario);
        $eliminarEmpleado = $oEmpleado->Eliminar($oDOEmpleado);
        // dd($eliminarEmpleado);
        $au = AuditoriaAgregarV($oDOEmpleado->idUsuarioAuditoria, "E", $oDOEmpleado->idEmpleado, "Empleados", $idListItem, $mo_lcNombrePc, $lcNombreEmpleado);
        // dd($au);
        return true;
    }

    public function ParametrosIdServicioArchivoClinico()
    {
        $oTabla = new Parametros;
        $data = $oTabla->SeleccionarIdServicioArchivoClinico();
        $id = isset($data[0])? $data[0]->ValorInt: 0;
        return $id;
    }

    public function TiposEmpleadosSeleccionarSiSeProgramaPorId( $lnIdTipoEmpleado )
    {
        $sql = 'EXEC TiposEmpleadosSeleccionarSiSeProgramaPorId :idTipoEmpleado';
        $params = [
            'idTipoEmpleado' => $lnIdTipoEmpleado,
        ];
        $data = DB::select($sql, $params);

        if( !isset($data[0])) return false;

        return $data[0]->EsProgramado? true: false;
    }

    public function EmpleadosObtenerConElMismoCodigoPlanilla( $oDOEmpleado )
    {
        $oEmpleado = new Empleados;
        return $oEmpleado->ObtenerConElMismoCodigoPlanilla($oDOEmpleado);
    }

    public function EmpleadosObtenerConelMismoDNI($lcDni, $lnIdTipoDocumento)
    {
        $oEmpleado = new Empleados;
        $data = $oEmpleado->ObtenerConElMismoDNI($lcDni, $lnIdTipoDocumento);
        return $data;
    }

    public function EmpleadosObtenerConElMismoUsuario($oDOEmpleado)
    {
        $oEmpleado = new Empleados;
        $data = $oEmpleado->ObtenerConElMismoUsuario($oDOEmpleado);
        return $data;
    }

    public function EmpleadosSeleccionarPorId( $idEmpleado )
    {
        $oEmpleado = new Empleados;
        $oDOEmpleado = new DOEmpleado;
        $oDOEmpleado->idEmpleado = $idEmpleado;
        $data = $oEmpleado->SeleccionarPorId($oDOEmpleado);
        if (isset($data[0])){
			if ( trim($data[0]->Clave)  != ''){
				$data[0]->Clave = decryptString($data[0]->Clave);
			}
			return $data[0];
		}
    }

    public function EmpleadosCargosSeleccionarPorFiltro( $lcFiltro )
    {
        $sql = "EXEC EmpleadosCargosSeleccionarPorFiltro :filtro";
        $params = [
            'filtro' => $lcFiltro,
        ];
        return DB::select($sql, $params);
    }

    public function EmpleadosLugarDeTrabajoSeleccionarPorFiltro( $lcFiltro )
    {
        $sql = "EXEC EmpleadosLugarDeTrabajoSeleccionarPorFiltro :filtro";
        $params = [
            'filtro' => $lcFiltro,
        ];
        return DB::select($sql, $params);
    }

    //NEW
    public function AreasTrabajo(){
        $table = [
            [ 'id'=> 0, 'key'=>'sghOtroLugar', 'nombre'=> 'Otro lugar'],
            [ 'id'=> 1, 'key'=>'sghAlmacenFarmacia', 'nombre'=> 'Almacen ó Farmacia'],
            [ 'id'=> 2, 'key'=>'sghImageneologia', 'nombre'=> 'Imagenología'],
            [ 'id'=> 3, 'key'=>'sghLaboratorio', 'nombre'=> 'Laboratorio'],
            [ 'id'=> 4, 'key'=>'sghSeguros', 'nombre'=> 'Seguros'],
            [ 'id'=> 5, 'key'=>'sghEspecialidadesCE', 'nombre'=> 'Especialidades de consulta externa'],
            [ 'id'=> 6, 'key'=>'sghEspecialidadesHosp', 'nombre'=> 'Epecialidades de hospitalizacion'],
            [ 'id'=> 7, 'key'=>'sghEspecialidadesEmergObs', 'nombre'=> 'Empecialidades de emergencia - observacion'],
            [ 'id'=> 8, 'key'=>'sghEspecialidadesEmergCons', 'nombre'=> 'Empecialidades de emergencia - consultorios'],
            [ 'id'=> 9, 'key'=>'sghAreaTramitaSeguros', 'nombre'=> 'Area tramita seguros'],
        ];
        return json_decode(json_encode($table));
    }
    //NEW
    public function SubAreaTrabajoSeleccionarXKeyArea($keyArea)
    {
        // App\VB\SIGHNegocios\ReglasFarmacia
        $data  = [];
        switch( $keyArea ){
            case 'sghAlmacenFarmacia': //OK
                $servicio = new \App\VB\SIGHNegocios\ReglasFarmacia;
				$data = $servicio->FarmAlmacenSeleccionarSegunFiltro("idTipoLocales<>'X' and idEstado=1");
				foreach($data as $key => $row){
					$data[$key]->id = $row->idAlmacen;
					$data[$key]->text = $row->descripcion;
				}
				break;
            case 'sghImageneologia': //OK
                $servicio = new \App\VB\SIGHNegocios\ReglasComunes;
				$data = $servicio->FactPuntosCargaSeleccionarPorFiltro("TipoPunto='I'");
				foreach($data as $key => $row){
					$data[$key]->id = $row->IdPuntoCarga;
					$data[$key]->text = $row->Descripcion;
				}
				break;
            case 'sghLaboratorio'://SI
                $servicio = new \App\VB\SIGHNegocios\ReglasComunes;
				$data = $servicio->FactPuntosCargaSeleccionarPorFiltro("TipoPunto='L'");
				foreach($data as $key => $row){
					$data[$key]->id = $row->IdPuntoCarga;
					$data[$key]->text = $row->Descripcion;
				}
				break;
            case 'sghSeguros'://SI
                $servicio = new \App\VB\SIGHNegocios\ReglasComunes;
				$data = $servicio->TiposFinanciamientoSegunFiltro("esOficina=1");
				foreach($data as $key => $row){
					$data[$key]->id = $row->IdTipoFinanciamiento;
					$data[$key]->text = $row->Descripcion;
				}
				break;
			case 'sghServiciosHosp':
				$servicio = new \App\VB\SIGHNegocios\ReglasAdmision;
				$data  = $servicio->DevuelveServiciosDelHospital("(1,2,3,4)");
				foreach($data as $key => $row){
					$data[$key]->id = $row->idServicio;
					$data[$key]->text = $row->DservicioHosp;
				}
				break;
			case 'sghEspecialidadesCE'://SI
                $servicio = new \App\VB\SIGHNegocios\ReglasAdmision;
				$data  = $servicio->DevuelveEspecialidadesDelHospital("(1)");
				foreach($data as $key => $row){
					$data[$key]->id = $row->IdEspecialidad;
					$data[$key]->text = $row->DescripcionLarga;
				}
				break;
			case 'sghEspecialidadesHosp': //SI
                $servicio = new \App\VB\SIGHNegocios\ReglasAdmision;
				$data  = $servicio->DevuelveEspecialidadesDelHospital("(3)");
				foreach($data as $key => $row){
					$data[$key]->id = $row->IdEspecialidad;
					$data[$key]->text = $row->DescripcionLarga;
				}
				break;
			case 'sghEspecialidadesEmergCons': //SI
                $servicio = new \App\VB\SIGHNegocios\ReglasAdmision;
				$data  = $servicio->DevuelveEspecialidadesDelHospital("(2)");
				foreach($data as $key => $row){
					$data[$key]->id = $row->IdEspecialidad;
					$data[$key]->text = $row->DescripcionLarga;
				}
				break;
			case 'sghEspecialidadesEmergObs': //SI
                $servicio = new \App\VB\SIGHNegocios\ReglasAdmision;
				$data  = $servicio->DevuelveEspecialidadesDelHospital("(4)");
				foreach($data as $key => $row){
					$data[$key]->id = $row->IdEspecialidad;
					$data[$key]->text = $row->DescripcionLarga;
				}
				break;
            case 'sghAreaTramitaSeguros': //SI
                $servicio = new \App\VB\SIGHNegocios\ReglasFacturacion;
				$data  = $servicio->AreaTramitaSegurosDevuelveTodosSegunFiltro("");
				foreach($data as $key => $row){
					$data[$key]->id = $row->idAreaTramitaSeguros;
					$data[$key]->text = $row->Descripcion;
				}
				break;
			case 'sghOtroLugar': //SI
				$data  = 0;
				break;
			default:
				$data = [];
                break;
        }
        return $data;
    }

    public function CentrosCostoSeleccionarTodos()
    {
        $oTabla = new CentrosCosto;
        return $oTabla->SeleccionarTodos();
    }

    public function PartidasPresupuestalesSeleccionarTodos()
    {
        $oTabla = new PartidasPresupuestales;
        return $oTabla->SeleccionarTodos();
    }

    public function CatalogoServiciosGrupoSeleccionarTodos()
    {
        $oTabla = new CatalogoServiciosGrupo;
        return $oTabla->SeleccionarTodos();
    }

    public function SeleccionarPuntosDeCarga()
    {
        $oTabla = new FactPuntosCarga;
        return $oTabla->SeleccionarTodos();
    }

    public function CatalogoServiciosSubGrupoSeleccionarPorGrupo( $lIdGrupo )
    {
        $oTabla = new CatalogoServiciosSubGrupo;
        return $oTabla->SeleccionarPorGrupo( $lIdGrupo );
    }

    public function CatalogoServiciosSeccionSeleccionarPorSubGrupo( $lIdSubGrupo )
    {
        $oTabla = new CatalogoServiciosSeccion;
        return $oTabla->SeleccionarPorSubGrupo( $lIdSubGrupo );
    }

    public function CatalogoServiciosSubSeccionSeleccionarPorSeccion( $lIdServicioSeccion )
    {
        $oTabla = new CatalogoServiciosSubSeccion;
        return $oTabla->SeleccionarPorSeccion( $lIdServicioSeccion );
    }

    public function CatalogoServiciosSeleccionarPorCodigo( $lcCodigo, $oConexion=null){
        //No existe el procedimiento almacendo SISGALEN v3
        // $oTabla = new CatalogoServicios;
        // return $oTabla->SeleccionarPorCodigoSIS($lcCodigo, $oConexion);
        return DB::table('FactCatalogoServicios')->where('codigo', $lcCodigo)->get();
    }

    public function CatalogoServiciosAgregar( &$oDOCatalogoServicio, $oRsPuntoCarga, $idListBar, $mo_lcNombrePc, $lcNombreServicio)
    {
        $oCatalogoServicios = new CatalogoServicios;
        $catalogoInsertar = $oCatalogoServicios->Insertar( $oDOCatalogoServicio );
        $oDOCatalogoServicio->idProducto = $catalogoInsertar->idProducto;

        if( $catalogoInsertar->idProducto > 0){
            $oDOCatalogoServicio->idProducto = $catalogoInsertar->idProducto;
            foreach( $oRsPuntoCarga as $row){
                $sql = 'EXEC FactCatalogoServiciosPtosAgregar :idPuntoCarga, :idProducto, :esPreVenta';
                $params = [
                    'idPuntoCarga' => $row->idPuntoCarga,
                    'idProducto' => $oDOCatalogoServicio->idProducto,
                    'esPreVenta' => $row->esPreVenta,
                ];
                $puntoAgregar = DB::update($sql, $params);
            }
            $au = AuditoriaAgregarV($oDOCatalogoServicio->idUsuarioAuditoria, 'A', $oDOCatalogoServicio->idProducto, 'FactCatalogoServicios', $idListBar, $mo_lcNombrePc, $lcNombreServicio);
        }
        return true;
    }

    public function CatalogoServiciosModificar( $oDOCatalogoServicio, $oRsPuntoCarga, $idListBar, $mo_lcNombrePc, $lcNombreServicio)
    {
        $oCatalogoServicios = new CatalogoServicios;
        $catalogoModificar = $oCatalogoServicios->Modificar($oDOCatalogoServicio);
        // dd($catalogoModificar);
        if( $catalogoModificar ){
            $sql = 'EXEC FactCatalogoServiciosPtosEliminar :idProducto';
            $params = [
                'idProducto' => $oDOCatalogoServicio->idProducto,
            ];
            $eliminarPuntos = DB::update($sql, $params);
            // dd($eliminarPuntos);

            foreach( $oRsPuntoCarga as $row){
                $sql = 'EXEC FactCatalogoServiciosPtosAgregar :idPuntoCarga, :idProducto, :esPreVenta';
                $params = [
                    'idPuntoCarga' => $row->idPuntoCarga,
                    'idProducto' => $oDOCatalogoServicio->idProducto,
                    'esPreVenta' => $row->esPreVenta,
                ];
                $puntoAgregar = DB::update($sql, $params);
                // dd($puntoAgregar);
            }

            $au = AuditoriaAgregarV($oDOCatalogoServicio->idUsuarioAuditoria, 'M', $oDOCatalogoServicio->idProducto, 'FactCatalogoServicios', $idListBar, $mo_lcNombrePc, $lcNombreServicio);
            // dd($au);
        }
        return true;
    }

    public function CatalogoServiciosEliminar( $oDOCatalogoServicio, $idListBar, $mo_lcNombrePc, $lcNombreServicio)
    {
        $oCatalogoServicios = new CatalogoServicios;
        $sql = 'EXEC FactCatalogoServiciosPtosEliminar :idProducto';
        $params = [ 'idProducto' => $oDOCatalogoServicio->idProducto, ];
        $eliminarPuntos = DB::update($sql, $params);
        // dd($eliminarPuntos);

        $eliminarCatalogo = $oCatalogoServicios->Eliminar($oDOCatalogoServicio);
        // dd($eliminarCatalogo);
        $au = AuditoriaAgregarV($oDOCatalogoServicio->idUsuarioAuditoria, "E", $oDOCatalogoServicio->idProducto, "FactCatalogoServicios", $idListBar, $mo_lcNombrePc, $lcNombreServicio);
        // dd($au);
        return true;
    }

    public function CatalogoServiciosFiltrarDEBB($oDOCatalogoServicio, $ml_TipoCatalogo)
    {
        $oTabla = new CatalogoServicios;
        $data = 0;

        // dd($oDOCatalogoServicio->codigo);
        if ($ml_TipoCatalogo == 0){

            $data = DB::table('FactCatalogoServiciosSubGrupo as ssg')
                ->leftJoin('FactCatalogoServicios as s', function ($query) use($oDOCatalogoServicio){
                    $query->on('s.idServicioSubGrupo', '=', 'ssg.idServicioSubGrupo')
                        ->where('s.codigo', 'LIKE', "%$oDOCatalogoServicio->codigo%")
                        ->where('s.nombre', 'LIKE', "%$oDOCatalogoServicio->nombre%");
                })
                ->orderBy('ssg.idServicioSubGrupo', 'asc')
                ->select('s.idProducto', 's.codigo', 's.nombre', DB::raw('0 as precioUnitario'), DB::raw('1 AS activo')
                    ,'ssg.idServicioSubGrupo', 'ssg.descripcion as descripcionSubGrupo')
                ->get();
            $dataGroup = [];
            foreach( $data as $row){
                $dataGroup[$row->idServicioSubGrupo]['idServicioSubGrupo'] = $row->idServicioSubGrupo;
                $dataGroup[$row->idServicioSubGrupo]['descripcion'] = $row->descripcionSubGrupo;
                // $dataGroup[$row->idServicioSubGrupo]['servicios'][] = isset($row->idProducto)?$row: [];
                if(isset($row->idProducto)){
                    $dataGroup[$row->idServicioSubGrupo]['servicios'][] = $row;
                }else{
                    $dataGroup[$row->idServicioSubGrupo]['servicios'] = [];
                }
            }
            $dataGroup = json_decode( json_encode($dataGroup));
            // dd($dataGroup);
            return $dataGroup;
            // $data = $oTabla->FiltrarCatalogoBase($oDOCatalogoServicio);
        }else{
            $data = $oTabla->FiltrarCatalogodebb($oDOCatalogoServicio, $ml_TipoCatalogo);
        }

    }

    public function CatalogoServiciosSeleccionarPorId($idProducto)
    {
        $oProducto = new CatalogoServicios;
        $oDOBienesInsumos = new DOCatalogoServicio;
        $oDOBienesInsumos->idProducto = $idProducto;
        $data = $oProducto->SeleccionarPorId($oDOBienesInsumos);
        return isset($data[0])? $data[0]: null;
    }

    public function FactCatalogoServiciosPtosSeleccionarXidProducto( $lnIdProducto ){
        $sql = 'EXEC FactCatalogoServiciosPtosSeleccionarXidProducto :idProducto';
        $params = [
            'idProducto' => $lnIdProducto,
        ];
        return DB::select($sql, $params);
    }

    public function FactPuntosCargaSeleccionarPorId( $lnIdPuntoCarga )
    {
        $sql = 'EXEC FactPuntosCargaSeleccionarPorId :idPuntoCarga';
        $params = [
            'idPuntoCarga' => $lnIdPuntoCarga,
        ];
        return DB::select($sql, $params);
    }

    

}