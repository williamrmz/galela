<?php

namespace App\VB\SIGHNegocios;

use Illuminate\Database\Eloquent\Model;

use DB;

use App\VB\SIGHDatos\TiposDestinosAtencion;
use App\VB\SIGHDatos\Atenciones;
use App\VB\SIGHEntidades\Enumerados;
use App\VB\SIGHDatos\FacturacionBienesPagos;
use App\VB\SIGHDatos\Pacientes;
use App\VB\SIGHDatos\Parametros;
use App\VB\SIGHDatos\HistoriasClinicas;
use App\VB\SIGHEntidades\Cadena;
use App\VB\SIGHComun\DOHistoriaClinica;
use App\VB\SIGHComun\DOPaciente;
use App\VB\SIGHComun\DoSunasaPacientesHistoricos;
use App\VB\SIGHDatos\SunasaPacientesHistoricos;
use App\VB\SIGHDatos\PacientesDatosAdd;
use mysql_xdevapi\Exception;


class ReglasAdmision extends Model
{
    private $mo_ReglasComunes;

    private $lcBuscaParametro;

    public function __construct()
    {
        $this->mo_ReglasComunes = new ReglasComunes;
        $this->lcBuscaParametro = new Parametros;
    }

    // Created by Romel Diaz at 2019-09-27
    public function PacientesEliminar( $oDOPaciente, $mo_lnIdTablaLISTBARITEMS, $mo_lcNombrePc, $lcNpaciente, $oDoSunasaPacientesHistoricos)
    {
        $errors = collect([]);

        try
        {
            $oPaciente = new Pacientes;
            $oHistoria = new HistoriasClinicas;
            $oDoHistoria = new DOHistoriaClinica;
            $oDoHistoria->nroHistoriaClinica = $oDOPaciente->nroHistoriaClinica;
            $oDoHistoria->idUsuarioAuditoria = $oDOPaciente->idUsuarioAuditoria;


            //NOTA: la base de siempre devuelve (1), por esta razon no se puede evaludar si se a eliminado algun registro o ninguno
            if(isset($oDoSunasaPacientesHistoricos->idSunasaPacienteHistorico))
            {
                $objSunasa = SunasaPacientesHistoricos::find($oDoSunasaPacientesHistoricos->idSunasaPacienteHistorico);
                if ($objSunasa) { $objSunasa->delete(); }
            }


            if( $oDOPaciente->idTipoNumeracion == param('sghHistoriaDefinitivaManual')
                || $oDOPaciente->idTipoNumeracion == param('sghHistoriaDefinitivaAutomatica')
                || $oDOPaciente->idTipoNumeracion == param('sghHistoriaDefinitivaReciclada') )
            {
                $eliminarHistoria = $oHistoria->Eliminar($oDoHistoria);
                if( $eliminarHistoria > 1)
                {
                    throw new Exception("Se ha producido un error al intentar eliminar los datos de la historia clinica");
                }
            }
            $oPaciente->Eliminar($oDOPaciente);
            AuditoriaAgregarV($oDOPaciente->idUsuarioAuditoria, "E", $oDOPaciente->idPaciente, "Pacientes", $mo_lnIdTablaLISTBARITEMS, $mo_lcNombrePc, $lcNpaciente);

        }
        catch (\Exception $e)
        {
            $errors->push($e->getMessage());
        }

        return jsonClass([ 
			'status' => count($errors)==0? true: false, 
			'errors' => $errors 
		]);
    }

    // Created by Romel Diaz at 2019-09-25
    public function PacientesModificarYActualizarHistoriaClinicaDefinitiva( $oDOPaciente, $oDoHistoria, $lIdTipoGenHistoriaClinicaAnterior, $mo_lnIdTablaLISTBARITEMS, $mo_lcNombrePc, $lcNpaciente, $oDoSunasaPacientesHistoricos, $oDOPacienteDatosAdd  = null)
    {
        $oPaciente = new Pacientes;
        $oHistoria = new HistoriasClinicas;
        $oSunasaPacientesHistoricos = new SunasaPacientesHistoricos;

        $errors = collect([]);

        // dd( $lIdTipoGenHistoriaClinicaAnterior ); // 2
        $sghHistoriaDefinitivaManual = param('sghHistoriaDefinitivaManual');            //2
        $sghHistoriaDefinitivaAutomatica = param('sghHistoriaDefinitivaAutomatica');    //1
        $sghHistoriaDefinitivaReciclada = param('sghHistoriaDefinitivaReciclada');      //3
    
        //'Agregar historia clinica (Si es tenia historia temporal y ahora tiene historia definitiva)
        if( $lIdTipoGenHistoriaClinicaAnterior == $sghHistoriaDefinitivaManual
            || $lIdTipoGenHistoriaClinicaAnterior == $sghHistoriaDefinitivaAutomatica
            || $lIdTipoGenHistoriaClinicaAnterior == $sghHistoriaDefinitivaReciclada ) {

            if ( $lIdTipoGenHistoriaClinicaAnterior == $sghHistoriaDefinitivaManual ) {
                $modificarHistoria = $oHistoria->Modificar($oDoHistoria); // == 1
            }
        }else
        {
            
            //'Si era temporal y ahora es definitiva => Genera y agrega la historia
            if( $oDoHistoria->idTipoNumeracion == $sghHistoriaDefinitivaManual
                || $oDoHistoria->idTipoNumeracion == $sghHistoriaDefinitivaAutomatica
                || $oDoHistoria->idTipoNumeracion == $sghHistoriaDefinitivaReciclada  ) {

                // $oDoHistoria->idTipoNumeracion = $sghHistoriaDefinitivaAutomatica;

                if ( $oDoHistoria->idTipoNumeracion <> $sghHistoriaDefinitivaManual ) {
                    $oDoHistoria->nroHistoriaClinica = $oHistoria->GenerarNroHistoria($oDOPaciente->idTipoNumeracion);
                }
                
                if ( $oDoHistoria->nroHistoriaClinica == 0 ) {
                    if ( $oDoHistoria->idTipoNumeracion == $sghHistoriaDefinitivaReciclada ) {
                        $errors->push("No se pudo generar el nro de de historia clínica reciclada" );
                    }
                    if ( $oDoHistoria->idTipoNumeracion == $sghHistoriaDefinitivaAutomatica ) {
                        $errors->push("No se pudo generar el nro de de historia clínica automatica, verifique el generador de números ");
                    }
                }

                $historiaInsertar = $oHistoria->Insertar($oDoHistoria);
                if (  $historiaInsertar === false) {
                    $errors->push('oHistoria.MensajeError');
                }

                $oDOPaciente->nroHistoriaClinica = $oDoHistoria->nroHistoriaClinica;
                $oDOPaciente->idTipoNumeracion = $oDoHistoria->idTipoNumeracion;
            }

        }

        //TODO: esta asignacion no existe en el codigo real
        $oDOPaciente->nroHistoriaClinica = $oDoHistoria->nroHistoriaClinica;
        $oDOPaciente->idTipoNumeracion = $oDoHistoria->idTipoNumeracion;
        
        //'Modificar paciente
        $pacienteModificar = $oPaciente->Modificar($oDOPaciente, true);
        // dd( $pacienteModificar );
        if ( $pacienteModificar != 1 ){
            $errors->push('Error: no se pudo modificar los datos del paciente');
        }else{
            if( $oDOPacienteDatosAdd != null) {
                $oDOPacienteDatosAdd->idPaciente = $oDOPaciente->idPaciente;
            }
            // $this->PacientesDatosAdicionalesPersonalesAgregar($oDOPacienteDatosAdd); // SOLO V7
        }

        $auditar = auditoriaAgregarV($oDOPaciente->idUsuarioAuditoria, "M", $oDOPaciente->idPaciente, "Pacientes", $mo_lnIdTablaLISTBARITEMS, $mo_lcNombrePc, $lcNpaciente);      //'ListBarItems.idListItem
        // dd( $auditar );
        
        if ($oDoSunasaPacientesHistoricos->nuevoSeguro == true)
        {
            $insertarSeguro = $oSunasaPacientesHistoricos->Insertar($oDoSunasaPacientesHistoricos);
            // dd( $insertarSeguro );
            if( $insertarSeguro->idSunasaPacienteHistorico == 0 ) {
                $errors->push('Error: insertar Sunasa Pacientes Historicos');
            }
        }
        else
        {
            $modificarSunasa = $oSunasaPacientesHistoricos->Modificar($oDoSunasaPacientesHistoricos);
            // dd( $modificarSunasa );
            if ( $modificarSunasa == 0 )
            {
                $errors->push('Error al modificar datos de SUNASA (Pacientes históricos)');
            }
        }

        return jsonClass([ 
            'status' => count($errors)==0? true: false, 
            'errors' => $errors 
        ]);
        // 'GR 27062018  -- Agrega los telefonos de los pacientes
        // If Not oPaciente.AgregarTelefonoDePacientes(oDOPaciente) Then
        //     bProcesoOK = False: ms_MensajeError = oPaciente.MensajeError: GoTo Terminar
        // End If
        
        // 'GR 27062018  -- Agrega lel telfono del tutor
        // If Not oPaciente.AgregarTelefonoDeTutor(oDOPaciente) Then
        //     bProcesoOK = False: ms_MensajeError = oPaciente.MensajeError: GoTo Terminar
        // End If
        
        // If Not oPaciente.AgregarUbigeoTutor(oDOPaciente) Then
        //     bProcesoOK = False: ms_MensajeError = oPaciente.MensajeError: GoTo Terminar
        // End If
        
        // If Not oPaciente.AgregarGSanguineoFactorRhyReligion(oDOPaciente) Then
        //     bProcesoOK = False: ms_MensajeError = oPaciente.MensajeError: GoTo Terminar
        // End If
    }

    // Created by Romel Diaz at 2019-09-23
    public function SunasaPacientesHistoricosSeleccionarPorIdPaciente( $idPaciente )
    {
        $oSunasaPacientesHistoricos = new SunasaPacientesHistoricos;
        $oDoSunasaPacientesHistoricos = new DoSunasaPacientesHistoricos;
        $oDoSunasaPacientesHistoricos->idPaciente = $idPaciente;
        return $oSunasaPacientesHistoricos->SeleccionarPorIdPaciente($oDoSunasaPacientesHistoricos);
    }

    // Created by Romel Diaz at 2019-09-23
    public function CentrosPobladosDevuelveDptoProvDistritoSegunIdCentroPoblado( $lnIdCentroPoblado )
    {
        return execute('CentrosPobladosDevuelveDptoProvDistritoSegunIdCentroPoblado', ['IdCentroPoblado'=>$lnIdCentroPoblado]);
    }

    // Created by Romel Diaz at 2019-09-23
    public function PacientesSeleccionarPorId( $idPaciente )
    {
        $oTabla = new Pacientes;
        $oDOPaciente = new DOPaciente;
        $oDOPaciente->idPaciente = $idPaciente;
        return $oTabla->SeleccionarPorId($oDOPaciente);
    }

    // Created by Romel Diaz at 2019-09-20
    public function PacientesFiltrar($oPaciente, $lbUsaApellidoMaternoVacio, $lbUsaApellidoPaternoVacio, $lcApellidoVacio)
    {
        $oTabla = new Pacientes;
        return $oTabla->Filtrar($oPaciente, $lbUsaApellidoMaternoVacio, $lbUsaApellidoPaternoVacio, $lcApellidoVacio);
    }


    // Created by Romel Diaz at 2019-09-18
    public function PacientesAgregarPacienteEHistoriaClinica($oDOPaciente, $oDoHistoria,  $idListBar, $mo_lcNombrePc, $lcNpaciente, $oDoSunasaPacientesHistoricos, $oDOPacienteDatosAdd = null)
    {
        $errors = collect([]);

        $oPaciente = new Pacientes;
        $oHistoria = new HistoriasClinicas;
        $oDoHistoriaClinica = new DOHistoriaClinica;
        $oSunasaPacientesHistoricos = new SunasaPacientesHistoricos;
        $bProcesoOK = true;

        $PacientesAgregarPacienteEHistoriaClinica = false;
        
        if ($oDoHistoria->idTipoNumeracion <> param('sghHistoriaDefinitivaManual') ) {
            $param351 = $this->lcBuscaParametro->SeleccionaFilaParametro(255);
            $param351 = isset($param351[0])? $param351[0]->ValorTexto: '';

            // TODO: NO SE USA EN ESTA VERSION V3
            if ($param351 == "S" and $oDOPaciente->nroDocumento <> "" ) {  //'Requerimiento INSNSB, Actualizado por FCV 30032015
                $oDoHistoria->nroHistoriaClinica = $oDOPaciente->NroDocumento;
            }else{
                $oDoHistoria->nroHistoriaClinica = $oHistoria->GenerarNroHistoria($oDOPaciente->idTipoNumeracion);
            }
        }
        
        if ($oDoHistoria->nroHistoriaClinica == "") {  //'JHIMI 27062018
            if ( $oDoHistoria->idTipoNumeracion == param('sghHistoriaDefinitivaReciclada') )
            {
                $errors->push("La opción de Historias Recicladas aun no esta implementada");
            }
        }

        $oDOPaciente->idTipoNumeracion = $oDoHistoria->idTipoNumeracion;
        $oDOPaciente->nroHistoriaClinica = $oDoHistoria->nroHistoriaClinica;
        
        $pacienteInsertar = $oPaciente->Insertar( $oDOPaciente );
        $oDOPaciente->idPaciente = $pacienteInsertar->idPaciente;

        // TODO: programar oDOPacienteDatosAdd
        if( (int) $oDOPaciente->idPaciente == 0 ) {
            $errors->push('Ocurrio un error al momento de registrar los datos del paciente');
        }else {
            $oDOPacienteDatosAdd = json_decode( json_encode(['idPaciente'=>0]));
            
            if($oDOPacienteDatosAdd != null) {
                $oDOPacienteDatosAdd->idPaciente = $oDOPaciente->idPaciente;
            }
            // $this->PacientesDatosAdicionalesPersonalesAgregar($oDOPacienteDatosAdd); // SOLO V7
        }

        $auditoria = AuditoriaAgregarV($oDOPaciente->idUsuarioAuditoria, "A", $oDOPaciente->idPaciente, "Pacientes", $idListBar, $mo_lcNombrePc, $lcNpaciente);      //'ListBarItems.idListItem
        
        $oDoHistoria->idPaciente = $oDOPaciente->idPaciente;
        $oDoHistoria->nroHistoriaClinica = $oDOPaciente->nroHistoriaClinica;
        
        if( $oDoHistoria->idTipoNumeracion == param('sghHistoriaDefinitivaManual')
            ||$oDoHistoria->idTipoNumeracion == param('sghHistoriaDefinitivaAutomatica')
            ||$oDoHistoria->idTipoNumeracion == param('sghHistoriaDefinitivaReciclada') )
        {
            $oDoHistoria->fechaCreacion = dateFormat($oDoHistoria->fechaCreacion, 'd-m-Y');
            $insertarHistoria = $oHistoria->Insertar($oDoHistoria);
            if( $insertarHistoria !==1 ){ //break;
                $errors->push('Ocurrio un error al momento de registrar los datos de la historia clinica');
            }
        }
        
        if ( $oDoSunasaPacientesHistoricos->yaNoTieneSeguro == false )
        {
            $oDoSunasaPacientesHistoricos->idPaciente = $oDOPaciente->idPaciente;
            $insertarSunasa = $oSunasaPacientesHistoricos->Insertar($oDoSunasaPacientesHistoricos);
            if( (int) $insertarSunasa->idSunasaPacienteHistorico == 0){ //break;
                $errors->push('Ocurrio un error al momento de registrar los datos SUNASA');
            }
        }

        return jsonClass([ 
			'status' => count($errors)==0? true: false, 
			'errors' => $errors 
		]);
        
        // SOLO V7
        //         'GR 27062018  -- Agrega los telefonos de los pacientes
        // If Not oPaciente.AgregarTelefonoDePacientes(oDOPaciente) Then
        //     bProcesoOK = False: ms_MensajeError = oPaciente.MensajeError: GoTo Terminar
        // End If
        
        //     'GR 07082018  -- Agrega el telefono del tutor
        // If Not oPaciente.AgregarTelefonoDeTutor(oDOPaciente) Then
        //     bProcesoOK = False: ms_MensajeError = oPaciente.MensajeError: GoTo Terminar
        // End If
        
        // If Not oPaciente.AgregarUbigeoTutor(oDOPaciente) Then
        //     bProcesoOK = False: ms_MensajeError = oPaciente.MensajeError: GoTo Terminar
        // End If
        
        // If Not oPaciente.AgregarGSanguineoFactorRhyReligion(oDOPaciente) Then
        //     bProcesoOK = False: ms_MensajeError = oPaciente.MensajeError: GoTo Terminar
        // End If
    }

    // Created by Romel Diaz at 2019-09-19
    public function PacientesDatosAdicionalesPersonalesAgregar($oDOPacienteAdd)
    {
        // SOLO V7
        if ($oDOPacienteAdd != null) {
            $oPacienteAdd = new PacientesDatosAdd;
            $agregar = $oPacienteAdd->DatosPersonalesAgregar($oDOPacienteAdd);
        }
    }

    // Created by Romel Diaz at 2019-09-18
    public function UltimoNroHistoriaGenerado()
    {
        $oTabla = new HistoriasClinicas;
        return $oTabla->UltimoNroHistoria();
    }

    // Created by Romel Diaz at 2019-09-18
    public function ExisteFichaFamiliar( $lcFichaFamiliar, $lnIdPaciente )
    {
        $errors = collect([]);
        $oRecordset = $this->PacientesSeleccionarPorFichaFamiliar($lcFichaFamiliar);

        foreach( $oRecordset as $row){
            if ($row->idPaciente <> $lnIdPaciente){
                $errors->push( Trim($row->ApellidoPaterno) . " " . Trim($row->ApellidoMaterno) . ", " .$row->PrimerNombre. ' Por favor contacte al personal de soporte técnico');
                break;
            }
        }

        return jsonClass([ 
			'status' => count($errors)? false: true, 
			'errors' => $errors,
        ]);
    }

    // Created by Romel Diaz at 2019-09-18
    public function PacientesSeleccionarPorFichaFamiliar( $lcFichaFamiliar )
    {
        return execute('PacientesSeleccionarPorFichaFamiliar', ['lcFichaFamiliar'=>$lcFichaFamiliar]);
    }
    
    // Created by Romel Diaz at 2019-09-18
    public function PacientesFiltraPorNroDocumentoYtipo( $lcNroDocumento, $lnIdDocIdentidad, $oConexion1=null )
    {
        $oTabla = new Pacientes;
        if( $oConexion1 != null) $oTabla->conexion = $oConexion1;
        return $oTabla->PacientesFiltraPorNroDocumentoYtipo($lcNroDocumento, $lnIdDocIdentidad);
    }

    // Created by Romel Diaz at 2019-09-18
    public function PacientesObtenerConElMismoNroHistoriaDefinitiva( $oPaciente )
    {
        $oTabla = new Pacientes;
        return $oTabla->ObtenerConLaMismaHistoriaDefinitiva($oPaciente);
    }

    // Created by Romel Diaz at 2019-09-18
    public function PacientesObtenerConElAutogenerado( $oPaciente )
    {
        $oTabla = new Pacientes;
        return $oTabla->ObtenerConElMismoAutogenerado($oPaciente);
    }

    // Created by Romel Diaz at 2019-09-17
    public function PacienteCrearNroAutogenerado($oPaciente)
    {
        $P1 = "";    //'Primer digito del apellido paterno
        $P4 = "";    //'Cuarto Digito del apellido paterno
        $M1 = "";    //'Primer digito del apellido materno
        $M4 = "";    //'Cuarto digito del apellido materno
        $N11 = "";   //'Primer digito del primer nombre
        $N41 = "";   //'Cuarto digito del primer materno
        $N12 = "";   //'Primer digito del Ultimo materno
        $N42 = "";   //'Cuarto digito del Ultimo materno
        $D = "";     //'Digito de verificacion
        $DD = "";
        $MM = "";
        $AAA = "";
        $sTemp  = "";

        $oPaciente->fechaNacimiento = dateFormat( $oPaciente->fechaNacimiento, 'd-m-Y H:i');

        $DD = left($oPaciente->fechaNacimiento, 2);
        $MM = mid($oPaciente->fechaNacimiento, 4, 2);
        $AAA = mid($oPaciente->fechaNacimiento, 8, 3);


        $this->DevuelvePrimeryCuartoCaracter( $oPaciente->apellidoPaterno, $P1, $P4 );
        $this->DevuelvePrimeryCuartoCaracter( $oPaciente->apellidoMaterno, $M1, $M4 );
        $this->DevuelvePrimeryCuartoCaracter( $oPaciente->primerNombre, $N11, $N41 );
        $this->DevuelvePrimeryCuartoCaracter( $oPaciente->segundoNombre, $N12, $N42 );

        $sTemp = $AAA . $MM . $DD . $oPaciente->idTipoSexo . $P1 . $P4 . $M1 . $M4 . $N11 . $N41 . $N12 . $N42;
        $mod = $this->Modulo10($sTemp);
        $hora = dateFormat($oPaciente->fechaNacimiento, 'H:i');

        $return = $sTemp . $mod . $hora;

        return $return;

        dd([
            'return' => $return,
            'sTemp' => $sTemp,
            'fecha' => $oPaciente->fechaNacimiento,
            'AAA' => $AAA,
            'MM' => $MM,
            'DD' => $DD,
            'SX' => $oPaciente->idTipoSexo,
            'P1' => $P1,
            'P4' => $P4,
            'M1' => $M1,
            'M4' => $M4,
            'N11' => $N11,
            'N41' => $N41,
            'N12' => $N12,
            'N42' => $N42,
            'MOD' => $mod,
            'HORA' => $hora,  
        ]);
    }

    // Created by Romel Diaz at 2019-09-17
    public function Modulo10($sValor)
    {
        $sTemp = "";
        $I = 0;
        
        // dd($sValor  );
        for ( $i=1; $i <= len($sValor); $i++){
            if( is_numeric ( mid($sValor, $i, 1) ) ){
                $sTemp = $sTemp . mid($sValor, $i, 1);
                
            }else{
                $sTemp = $sTemp . $this->DevuelveValorEnNumeros(mid($sValor, $i, 1));
            }
        }

        $iTotal = 0;
        $k = 0;
        for ( $i=1; $i <= len($sValor); $i++){
            if( ($i % 2) <> 0 ){ // INPAR
                $k = CInt(Mid($sTemp, $i, 1)) * 2;
                $iTotal = $iTotal + ($k - ($k % 10)) / 10 + ($k % 10);
            }else{ // PAR
                $iTotal = $iTotal + CInt(mid($sTemp, $i, 1));
            }
        }

        if ( ($iTotal % 10) == 0) {
            $Modulo10 = 0;
        } else {
            $Modulo10 = 10 - ($iTotal % 10);
        }

        return $Modulo10;
    }

    // Created by Romel Diaz at 2019-09-17
    public function DevuelveValorEnNumeros($sCaracter)
    {
        $chars1 = '';
        $chars1 = 'ABCDEFGHIJKLMN';
        $chars2 = 'Ñ';
        $chars3 = 'OPQRSTUVWXYZ';

        if ( strripos($chars1, $sCaracter) !== false ){
            return asc( $sCaracter) - 55;
        } else if ( strripos($chars2, $sCaracter) !== false ){
            return 24;
        } else if ( strripos($chars3, $sCaracter) !== false ){
            return asc( $sCaracter) - 55;
        } else{
            return '';
        }
    }

    // Created by Romel Diaz at 2019-09-17
    public function DevuelvePrimeryCuartoCaracter($sPalabra, &$C1, &$C2)
    {
        $sTemp = "";
        if ($sPalabra <> "") {
            $sTemp = $this->ObtenerUltimaPalabra($this->EliminarConjunciones($sPalabra));
            $C1 = ucase(left($sTemp, 1));
            $C2 = ucase($this->DevuelveCuartoCaracter($sTemp));

            if( $C2 == 'N2'){
                dd( $sPalabra );
            }
        }else {
            $C1 = "X";
            $C2 = "X";
        }
    }

    // Created by Romel Diaz at 2019-09-17
    public function EliminarConjunciones($sPalabra)
    {
        $sTemp = $sPalabra;
        $sTemp = Cadena::ReemplazarCadena($sTemp, "DE", "");
        $sTemp = Cadena::ReemplazarCadena($sTemp, "DEL", "");
        $sTemp = Cadena::ReemplazarCadena($sTemp, "EL", "");
        $sTemp = Cadena::ReemplazarCadena($sTemp, "LA", "");
        $sTemp = Cadena::ReemplazarCadena($sTemp, "LOS", "");
        $sTemp = Cadena::ReemplazarCadena($sTemp, "LAS", "");
        $sTemp = replace_recursive( $sTemp, '  ', '');
        return $sTemp;
    }
    
    // Created by Romel Diaz at 2019-09-17
    public function ObtenerUltimaPalabra($sTexto)
    {
        $tmp = trim($sTexto);

        $lastSpacePos = strrpos($tmp, " ");

        if ($lastSpacePos===false) $lastSpacePos = 0;

        $lastWord = trim( substr($tmp, $lastSpacePos, strlen($tmp)) );

        return $lastWord;
    }

    //'JHIMI 23042018 SE AGREGA LA CANTIDAD DE CARACTERES COMO PARTE DEL AUTOGENERADO (PARA LOS RN GEMELOS)
    public function DevuelveCuartoCaracter($sPalabra) {
        if (len($sPalabra) <= 4 ) {
            // return right($sPalabra, 1) . len($sPalabra);  //'JHIMI 23042018
            return right($sPalabra, 1);
        }else{
            return mid($sPalabra, 4, 1);
        }
    }


    // Created by Romel Diaz at 2019-09-10
    public function AtencionesParaAtencionPagantesDelMedico( $lnIdServicioIngreso, $ldFechaIngreso)
    {
        $sql = "EXEC AtencionesParaAtencionPagantesDelMedico :ldFechaIngreso, :lnIdServicioIngreso";
        $params = [
            'ldFechaIngreso' => $ldFechaIngreso,
            'lnIdServicioIngreso' => $lnIdServicioIngreso,
        ];
        return DB::select($sql, $params);
    }

    // Created by Romel Diaz at 2019-09-10
    public function atencionesCExServicio( $lnIdServicioIngreso, $lcFechaIngreso, $oConexionExterna)
    {
        $sql = "EXEC atencionesCExServicio :lnIdServicioIngreso, :FechaIngreso";
        $params = [
            'lnIdServicioIngreso' => $lnIdServicioIngreso,
            'FechaIngreso' => $lcFechaIngreso,
        ];
        return DB::connection('sighExterna')->select($sql, $params);
    }

    // Created by Romel Diaz at 2019-09-10
    public function EsServicioCostoCero($lnIdServicio)
    {
        $oRsTmp = [];
        $EsServicioCostoCero = false;
        $oRsTmp = $this->mo_ReglasComunes->ServiciosSeleccionarXidentificador( $lnIdServicio );

        foreach($oRsTmp as $row){
            if( $row->CostoCeroCE == "S") {
                $EsServicioCostoCero = true;
                break;
            }
        }
        return $EsServicioCostoCero;
    }

    // Created by Romel Diaz at 2019-09-10
    // 'JHIMI 13032018 se cambia el tipo de dato del parametro lnHistoriaClinica de Long  String
    public function AtencionesSeleccionarCEPorCuentaPorHistoriaPorApellidosPorServicio( $lnHistoriaClinica, $lnIdCuentaAtencion, $lcApellidoPaterno, $ldFechaIngreso, $lnIdServicio, $lcDni)
    {
        $oTabla = new Atenciones;
        return $oTabla->AtencionesSeleccionarCEPorCuentaPorHistoriaPorApellidosPorServicio( $lnHistoriaClinica, $lnIdCuentaAtencion, $lcApellidoPaterno, $ldFechaIngreso, $lnIdServicio, $lcDni);
    }

    // Created by Romel Diaz at 2019-09-10
    public function TiposDestinoAtencionSeleccionarDestinosDeConsultoriosExternos()
    {
        $oTabla = new TiposDestinosAtencion;
        return $oTabla->SeleccionarDestinosDeConsultoriosExternos();
    }

    // Created by Romel Diaz at 2019-09-10
    public function TiposDestinoAtencionSeleccionarDestinosDeConsultoriosExternosXidCuentaAtencion($ml_IdCuentaAtencion )
    {
        $oTabla = new TiposDestinosAtencion;
        return $oTabla->SeleccionarDestinosDeConsultoriosExternosXIdCuentaAtencion($ml_IdCuentaAtencion);
    }


    // Created by Romel Diaz at 2019-09-10
    public function DevuelveServiciosDelHospital( $lcFiltro, $lcEspecialidades, $lnTipoEstado, $lnOrden)
    {
        $lcSql = "";
        $sWhere = "";
        if ($lnTipoEstado <> param('sghFiltraAnuladosYactivos') ) {
            $lcSql = lcSql . " and dbo.Servicios.idEstado= " . $lnTipoEstado;
        }
        if ($lcEspecialidades <> "" ) {
            $lcSql = $lcSql & $lcEspecialidades;
        }
        if ($lnOrden == param('sghPorDescServicio')  ) {
            $lcSql = $lcSql . " ORDER BY dbo.Servicios.Nombre";
        }else {
            $lcSql = $lcSql . " ORDER BY dbo.TiposServicio.Descripcion,dbo.Servicios.Nombre";
        }
        $lcSql = $lcFiltro . $lcSql;

        $sql = 'EXEC DevuelveServiciosDelHospitalFiltro :lcFiltro';
        $params = [
            'lcFiltro' => $lcFiltro,
        ];
        return DB::select($sql, $params);
    }

    // Created by Romel Diaz at 2019-09-10
    public function DevuelveEspecialidadesDelHospital( $filtro )
    {
        $sql = "EXEC DevuelveEspecialidadesDelHospitalfiltro :filtro";
        $params = ['filtro' => $filtro];
        return DB::select($sql, $params);
    }

    public static function AtencionesCEFiltrarPorPaciente($nroHistoria, $apePaterno, $apeMaterno, $dni, $idNroCuenta, $fecTriaje = '', $fecInicio = '30-12-1899', $fecFin = '30-12-1899', $primerNombre = '')
    {
        $sql = "exec AtencionesCEFiltrarPorPaciente :NroHistoria, :ApePaterno, :ApeMaterno, :PrimerNombre, :Dni, :NroCuenta, :FecTriaje, :FecInicio, :FecFin";
        $params = [
            'NroHistoria' => $nroHistoria,
            'ApePaterno' => $apePaterno,
            'ApeMaterno' => $apeMaterno,
            'PrimerNombre' => $primerNombre,
            'Dni' => $dni,
            'NroCuenta' => $idNroCuenta,
            'FecTriaje' => $fecTriaje,
            'FecInicio' => $fecInicio,
            'FecFin' => $fecFin
        ];

        return DB::connection('sqlsrv_ext')->select($sql, $params);
    }

}