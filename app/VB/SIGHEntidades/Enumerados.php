<?php

namespace App\VB\SIGHEntidades;

class Enumerados
{

    // '    Organización: Usaid - Politicas en Salud
    // '    Aplicativo: SisGalenPlus v.3
    // '    Programa:  Clase para capa de Procesos Generales de Tipo enumerados
    // '    Programado por: Castro W
    // '    Fecha: Enero 2005
    // '
    // '------------------------------------------------------------------------------------
    // Option Explicit


    public static function param( $key ){

        $data['sghOpciones'] = [
            'sghAgregar'  => 1,
            'sghModificar'  => 2,
            'sghConsultar'  => 3,
            'sghEliminar'  => 4,
            'sghBuscar'  => 6,
            'sghImprimir'  => 7,
        ];

        $data['sghTipoNumeracionDeNroHistoria'] = [
            ' sghHistoriaDefinitivaAutomatica'  => 1,
            ' sghHistoriaDefinitivaManual'  => 2,
            ' sghHistoriaDefinitivaReciclada'  => 3,
            ' sghHistoriaTemporalCOnsultaExterna'  => 4,
            ' sghHistoriaTemporalEmergencia'  => 5,
            ' sghHistoriaTemporalAlojamiento'  => 6,
            ' sghHistoriaTemporalServiciosIntermedios'  => 7,
            ' sghSinHistoria'  => 9,
        ];

        $data['sghTipoServicio'] = [
            ' sghConsultaExterna'  => 1,
            ' sghEmergenciaConsultorios'  => 2,
            ' sghHospitalizacion'  => 3,
            ' sghEmergenciaObservacion'  => 4,
        ];

        $data['sghBotonDetallePresionado'] = [
            'sghAceptar'  => 10,
            'sghCancelar'  => 20,
        ];

        $data['sghTipoFiltroPacientes'] = [
            'sghFiltrarTodos'  => 10,
            'sghFiltrarConHistoriasTemporales'  => 20,
            'sghFiltrarConHistoriasDefinitivas'  => 30,
            'sghFiltrarTriaje'  => 40 , //'GR 01082018
        ];

        $data['sghTipoFiltroAdmision'] = [
            'sghFiltrarConsultaExterna'  => 10,
            'sghFiltrarHospitalizacion'  => 20,
            'sghFiltrarConsultorioEmergencia'  => 30,
            'sghFiltrarObservacionEmergencia'  => 40,
            'sghFiltrarEmergencia'  => 50,
        ];

        $data['sghEtapaPrestamoHistoriaClinica'] = [
            'sghSolicitud'  => 1,
            'sghEnvio'  => 2,
            'sghDevolucion'  => 3,
        ];

        $data['sghTipoBusquedaPrestamoHistoria'] = [
            'sghTodasHistorias'  => 1,
            'sghHistoriaSolicitadas'  => 2,
            'sghHistoriaEnPrestamo'  => 3,
            'sghHistoriaDevueltas'  => 4,
        ];

        $data['sghTipoVistaFormAtenciones'] = [
            'sghVistaAdmision'  => 1,
            'sghVistaAtencion'  => 2,
        ];
        $data['sghTiposDiagnostico'] = [
            'sghAtencionConsultaExterna'  => 1,
            'sghHospitalizacionIngreso'  => 2,
            'sghHospitalizacionEgreso'  => 3,
            'sghHospitalizacionMortalidad'  => 4,
            'sghHospitalizacionNacimiento'  => 5,
            'sghHospitalizacionComplicaciones'  => 6,
            'sghInterconsultas'  => 7,
        ];
        $data['sghTipoAccionEmergenciaYHospitalizacion'] = [
            'sghAdmisionNormal'  => 1,
            'sghEnviarAObservacion'  => 2,
            'sghTrasladarAHospitalizacion'  => 3,
            'sghDarDeAlta'  => 4,
            'sghIngresarUnAlojamientoConjunto'  => 5,
            'sghTransferencias'  => 6,
        ];
        $data['sghTiposReporteHospitalizacion'] = [
            'sghReporteEgresosHospitalario'  => 1,
            'sghReporteIngresosHospitalario'  => 2,
        ];

        $data['sghTipoDetalleComprobante'] = [
            'sghDetalleComprobanteServicios'  => 1,
            'sghDetalleComprobanteInsumos'  => 2,
        ];

        $data['sghEstadoFacturacion'] = [
            'sghAtendido'  => 1,
            'sghPendientePago'  => 3,
            'sghPagadoYatendido'  => 4,
            'sghDevolver'  => 5,
            'sghDevuelto'  => 6,
            'sghAnulado'  => 9,
            'sghAutorizAutomática'  => 10,
            'sghDespachado'  => 11,
            'sghRegistrado'  => 12,
            'sghReembolsoParcial'  => 15,
            'sghConPreVenta'  => 16,
        ];

        $data['sghTipoEstadoAtencion'] = [
            'sghEstadoAtencionSolicitado'  => 1,
            'sghEstadoAtencionAtendido'  => 2,
        ];

        $data['sghEstadoCuenta'] = [
            'sghAbierto'  => 1,
            'sghPagado'  => 4,
            'sghCerrado'  => 5,
            'sghAnulado'  => 9,
            'sghConAltaMedica'  => 10,
            'sghPendientePagoSeguros'  => 11,
            'sghNoLlegaAlServicioHospitalizado'  => 12,
        ];

        $data['sghTipoFacturacionServicio'] = [
            'sghFacturacionServicioPorEstancia'  => 1,
            'sghFacturacionServicioPorProcedimiento'  => 2,
            'sghFacturacionServicioTotal'  => 3,
        ];

        $data['sghTipoFinanciamiento'] = [
            'sghBase'  => 0,
            'sghPacienteNormal'  => 1,
            'sghSis'  => 2,
            'SisIndependiente'  => 3,  //'JHIMI 18042018 Nuevo tipo
            'sghSOAT'  => 19,  //'JHIMI 18032018 de 3 a 19
            'sghConvenios'  => 18,  //'JHIMI 18032018 de 4 a 18
            'sghCreditoHospitalario'  => 5,
            'sghDefensaNacional'  => 6,
            'sghServicioSocial'  => 9,
            'sghCreditoPersonal'  => 10,
        ];

        $data['sghFuenteFinanciamiento'] = [
            'sghFFPaciente'  => 1,
            'sghFFSIS'  => 3,
            'sghFFSoat'  => 4, //'JHIMI 18042018 de 2 a 4
            'sghFFParticularHospitalizado'  => 5,
            'sghFFFospoli'  => 6,
            //'sghFFSeguroPacifico'  => 2,
            //'sghFFSeguroRimac'  => 3,
            //'sghFFSeguroWieseAetna'  => 4,
            //'sghFFSeguroGenerali'  => 5,
            //'sghFFESSALUD'  => 6,
            //'sghFFFospoli'  => 7,
            //'sghFFSeguroLaPositiva'  => 10,
            //'sghFFPacienteParticular'  => 11,
        ];


        $data['sghTipoEmpleado'] = [
            'sghCajero'  => 1,
            'sghCuentaCorriente'  => 2,
            'sghSis'  => 3,
            'sghConvenio'  => 4,
            'sghAsistenta'  => 5,
            'sghSOAT'  => 6,
            'sghOtros'  => 7,
        ];

        $data['sghTipoProducto'] = [
            'sghbien'  => 1,
            'sghServicio'  => 2,
            'sghAmbos'  => 3,
        ];

        $data['sghOpcionesPago'] = [
            'sghNuevoPagoConHistoria'  => 1,
            'sghNuevoPagoSinHistoria'  => 2,
            'sghPagarOrdenExistente'  => 3,
            'sghPagarCuentaExistente'  => 4,
            'sghDevolucion'  => 5,
            'sghAnulacion'  => 6,
            'sghReimprimirComprobante'  => 7,
            'sghPagarOrdenExistenteF'  => 8,
            'sghPagarOrdenExistenteFS'  => 9,
            'sghPagarCuentaTotalFS'  => 10,
            'sghDevolucionINO'  => 11,
            'sghAnularDevolucionINO'  => 12,
        ];

        $data['sghAreasLaboraEmpleado'] = [
            'sghAlmacenFarmacia'  => 1,
            'sghImageneología'  => 2,
            'sghLaboratorio'  => 3,
            'sghSeguros'  => 4,
            'sghEspecialidadesCE'  => 5,
            'sghEspecialidadesHosp'  => 6,
            'sghEspecialidadesEmergObs'  => 7,
            'sghEspecialidadesEmergCons'  => 8,
            'sghAreaTramitaSeguros'  => 9,
        ];

        $data['sghTipoOrden'] = [
            'sghPorCodigo'  => 1,
            'sghPorDescripcion'  => 2,
            'sghPorIdProductoMasFecha'  => 3,
            'sghPorFechaYhora'  => 4,
            'sghPorIdProductoMasIdServiciopaciente'  => 5,
            'sghPorIdFuenteFinanciamientoIdTipoServicio'  => 6,
            'sghPorServicioNombre'  => 7,
            'sghPorDepartamentoEspecialidadServicioNombre'  => 8,
        ];

        $data['sghEstadoTabla'] = [
            'sghAnulado'  => 0,
            'sghRegistrado'  => 1,
            'sghCerrado'  => 2,
        ];

        $data['sghTipoServicioOfrecidos'] = [
            'sghSoloInsumos'  => 0,
            'sghSoloCPT'  => 1,
            'sghInsumosYcpt'  => 2,
        ];

        $data['sghImpresion'] = [
            'sghPantalla'  => 0,
            'sghImpresoraBoletaContinua'  => 1,
            'sghImpresoraBoletaPorBoleta'  => 2,
            'sghImpresora'  => 3,
            'sghExcel'  => 4,
            'sghImpresionFactura'  => 5,
        ];

        $data['sghDatoDelEmpleado'] = [
            'sghIniciales'  => 0,
            'sghUsuario'  => 1,
            'sghApellidosYnombres'  => 2,
        ];


        $data['sghTipoServicioHospitalizacion'] = [
            'sghSoloPacHospitalizados'  => 1,
            'sghSoloPacAlojados'  => 2,
            'sghTodos'  => 3,
        ];

        $data['sghTipoEdades'] = [
            'sghAño'  => 1,
            'sghMeses'  => 2,
            'sghDias'  => 3,
            'sghHoras'  => 4,
        ];

        $data['sghTipoEstados'] = [
            'sghFiltraSoloAnulados'  => 0,
            'sghFiltraSoloActivos'  => 1,
            'sghFiltraAnuladosYactivos'  => 2,
        ];

        $data['sghOrdenDeServiciosHospital'] = [
            'sghPorDescTipoServicio'  => 1,
            'sghPorDescServicio'  => 2,
        ];

        $data['sghTipoFinanciamientoGeneraPago'] = [
            'sghTodosLosQuePaganEnCaja'  => 1,
            'sghTodosLosQueTienenAlgunSeguro'  => 5,
            'sghSoloSeguroSIS'  => 2,
            'sghSoloSeguroSOAT'  => 3,
            'sghSoloSeguroConvenios'  => 4,
        ];

        $data['sghComoSeTrabajaEnEstadoCuentaLosSeguros'] = [
            'sghTrabajaNinguno'  => 0,
            'sghTrabajaParticular'  => 1,
            'sghTrabajaSeguroSIS'  => 2,
            'sghTrabajaSeguroSOAT'  => 3,
            'sghTrabajaSeguroConvenios'  => 4,
            'sghTrabajaServicioSocial'  => 9,
        ];

        $data['sghPuntosCargaBasicos'] = [
            'sghPtoCargaAdmisionEmergencia'  => 10,
            'sghPtoCargaAdmisionHospitalizacion'  => 9,
            'sghPtoCargaAdmisionCE'  => 6,
            'sghPtoCargaServicioHospitalizacion'  => 1,
            'sghPtoCargaCaja'  => 99,
            'sghPtoCargaRayosX'  => 21,
            'sghPtoCargaTomografia'  => 22,
            'sghPtoCargaEcogObstetrica'  => 23,
            'sghPtoCargaEcogGeneral'  => 20,
            'sghPtoCargaPatologiaClinica'  => 2,
            'sghPtoCargaAnatomiaPatologica1'  => 3,
            'sghPtoCargaAnatomiaPatologica2'  => 32,
            'sghPtoCargaBancoSangre1'  => 11,
            'sghPtoCargaBancoSangre2'  => 38,
            'sghPtoCargaFarmacia'  => 5,
            'sghPtoCargaCentroQx'  => 622,
            'sghPtoCargaCtp'  => 2500,
        ];


        $data['sghTipoPaquetes'] = [
            'sghTipoPaqueteSoloServicio'  => 1,
            'sghTipoPaqueteSolofarmacia'  => 2,
            'sghTipoPaqueteServicioYfarmacia'  => 3,
        ];

        $data['sghTipoPrecioFarmacia'] = [
            'sghPrecioCompra'  => 1,
            'sghPrecioDistribucion'  => 2,
            'sghPrecioVentaContado'  => 3,
            'sghPrecioDonacion'  => 4,
        ];

        $data['sghTipoConceptoImagen'] = [
            'sghImgTCingreso'  => 1,
            'sghImgTCsalidaDeterioro'  => 2,
            'sghImgTCsalida'  => 3,
        ];

        $data['sghTipoDx'] = [
            'sghTipoDxNINGUNO'  => 0,
            'sghTipoDxDefinitivo'  => 1,
            'sghTipoDxPresuntivo'  => 2,
        ];

        $data['sghTipoSalidaItemFarmacia'] = [
            'sghSoloVenta'  => 1,
            'sghSoloEstrategico'  => 2,
            'sghVentaEstrategico'  => 3,
            'sghDonaciones'  => 4,
        ];

        $data['sghBaseDatosExterna'] = [
            'sghJamo'  => 273,
            'sghSis'  => 325,
            'visitasH'  => 372, //'JR
        ];

        //'debb-24/03/2011
        $data['sghFiltraCpt'] = [
            'sghMuestraTodosCpt'  => 0,
            'sghCptSoloLaboratorio'  => 1,
            'sghCptSoloRayosX'  => 2,
            'sghCptSoloTomografia'  => 3,
            'sghCptSoloEcografiaObstetrica'  => 4,
            'sghCptSoloEcografiaGeneral'  => 5,
        ];


        $data['sghPerinatalModulos'] = [
            'sighHasta28Dias'  => 1,
            'sighDesde29diasHasta1anio'  => 2,
            'sighDesde1Hasta4anios'  => 3,
            'sighDesde5Hasta9anios'  => 4,
            'sighDesde10Hasta11anios'  => 5,
            'sighDesde12Hasta17anios'  => 6,
            'sighDesde18anios'  => 7,
        ];

        $data['sghPerinatalListas'] = [
            'sighInmunizaciones'  => 1,
            'sighCptFrecuentes'  => 2,
            'sighMorbilidadDesarrollo'  => 3,
            'sighMorbilidadFrecuente'  => 4,
        ];

        $data['sghDxDefinitivos'] = [
            'sighDxCeDefinitivo'  => 102,
            'sighDxHospEmergPrincipal'  => 301,
            'sighDxHospEmergCausaFinal'  => 303,
            'sighDxHospEmergDefinitivo'  => 402,
        ];

        $data['sghRecetaEstados'] = [
            'sighRecetaAnulada'  => 0,
            'sighRecetaRegistrada'  => 1,
            'sighRecetaDespachada'  => 2,
            'sighRecetaConBoleta'  => 3,
        ];

        $data['sghEstadosComprobante'] = [
            'sighEstadosComprobantePagado'  => 4,
            'sighEstadosComprobanteDevuelto'  => 6,
            'sighEstadosComprobanteAnulado'  => 9,
        ];
        $data['sghTipoConceptoFarmacia'] = [
            'sghTipoConceptoSIS'  => 13,
            'sghTipoConceptoSOAT'  => 14,
            'sghTipoConceptoConvenios'  => 23,
        ];
        $data['sghOpcionGalenHos'] = [
            ' sghRegistroCitaCE'  => 102,
            ' sghRegistroAtencionCE'  => 103,
            ' sghEstadoDeCuenta'  => 613,
            ' sghFormatoFUA'  => 1345,
            ' sghAdmisionEmergencia'  => 202,
            ' sghAdmisionHospitalizacion'  => 302,
            ' sghVentasFarmacia'  => 1307,
            ' sghConsumoEnServicio'  => 601,
            ' sghLaboratorioAP'  => 1321,
            ' sghLaboratorioPC'  => 1312,
            ' sghLaboratorioBS'  => 1322,
            ' sghImagenEcogO'  => 1320,
            ' sghImagenEcogG'  => 1317,
            ' sghImagenRayosX'  => 1318,
            ' sghImagenTomografia'  => 1319,
            ' sghPacienteExternoConSeguro'  => 1339,
            ' sghGestionGaja'  => 702, //'mgaray201504
        ];
        $data['sghTipoCondicion'] = [
            ' sghTipoCondicionNuevo'  => 1,
            ' sghTipoCondicionReingresante'  => 2,
            ' sghTipoCondicionContinuador'  => 3,
        ];
        $data['sghUltimaBusqueda'] = [
            ' sghEnBoleta'  => 1,
            ' sghEnNroCuenta'  => 2,
        ];

        //'JVG 02-04-2012 - Adicion de Enumeracion para el Modulo HIS GalenHos
        //'Tipo de Actividades en HIS GalenHos
        $data['sghHISTipoActividad'] = [
            'Atencion'  => 1,
            'ActividadPreventivaPromocional'  => 2,
            'ActividadMasiva'  => 3,
            'ActividadConAnimales'  => 4,
        ];

        $data['sghHISTipoEdades'] = [
            'dias'  => 1,
            'meses'  => 2,
            'Años'  => 3,
        ];

        $data['sghHISEstados'] = [
            'Nuevo'  => 1,
            'Reingreso'  => 2,
            'Continuador'  => 3,
        ];

        $data['sghCitaWebEstados'] = [
            'CupoANULADO'  => 0,
            'CupoLlenadoEnCitaGalenHos'  => 1,
            'CupoDisponibleEnCitaWeb'  => 2,
            'CupoConfirmadoEnCitaWeb'  => 3,
            'CupoConfirmadoYconCitaEnGalenhos'  => 4,
            'CupoDisponibleEnRefCon'  => 5,
            'CupoConfirmadoEnRefCon'  => 6,
        ];

        $data['sghSIScodigo'] = [
            'sghAfiliacionLPISpago'  => 1,
            'sghInscripcionLPIS'  => 2,
            'sghAfiliacionLPISgratis'  => 3,
            'sghAfiliacionLPISgratisAntiguo'  => 4,
            'sghAfiliacionAUXgratis'  => 7,
            'sghInscripcionAUX'  => 8,
        ];

        $data['sghColores'] = [
            'sghRojo'  => 1,
            'sghAzul'  => 2,
            'sghNegro'  => 3,
            'sghVerde'  => 4,
            'sghBlanco'  => 5,
        ];


        $data['sghRecetasEstadosDetalle'] = [
            'sghAnuladoPorMedico'  => 0,
            'sghRecetado'  => 1,
            'sghDespachado'  => 2,
            'sghEnDosisAlPaciente'  => 3,
            'sghConcluido'  => 4,
        ];

        $data['sghVersionBD'] = [
            'sighSql2000'  => 0,
            'sighSql2008'  => 1,
            'sighPosgreSql'  => 2,
        ];

        $data['sghDefaultVentana'] = [
            'sighApellidoPaterno'  => 0,
            'sighDNI'  => 1,
            'sighHistoria'  => 2,
        ];

        $data['sghFuaTipo'] = [
            'sghFuaTipoManual'  => 1,
            'sghFuaTipoAutomatico'  => 2,
        ];


        $data['sghTipoProceso'] = [
            'sghProcesaYgraba'  => 1,
            'sghSoloParaReporte'  => 2,
        ];

        $data['sghCategoriaEstablecimiento'] = [
            'sghOtros'  => 0,
            'sghHospital'  => 1,
            'sghCS'  => 2,
            'sghPS'  => 3,
        ];

        //'mgaray
        $data['sighTriajeOrigen'] = [
            'Triaje'  => 1,
            'ConsultaExterna'  => 2,
            'Emergencia'  => 3,
            'Hospitalizacion'  => 4,
        ];

        $data['sighTriajeVariable'] = [
            'Peso'  => 1,
            'Talla'  => 2,
            'PerimCefalico'  => 3,
            'PresArtSistolica'  => 4,
            'PresArtDiastolica'  => 5,
            'Temperatura'  => 6,
            'FrecCardiaca'  => 7,
            'FrecRespiratoria'  => 8,
            'Pulso'  => 9,
            //'PAOLA
            'Saturacion'  => 10,
        ];

        $data['sighTriajeEstadoPaciente'] = [
            'NoRequerido'  => 0,
            'Despierto'  => 1,
            'Dormido'  => 2,
        ];

        //'atención integral
        $data['sighGrupoEdad'] = [
            'Nino'  => 1,
            'Adolescente'  => 2,
            'Joven'  => 3,
            'Adulto'  => 4,
            'AdultoMayor'  => 5,
        ];

        $data['sighTipoDatoRespuesta'] = [
            'Texto'  => 1,
            'Numerico'  => 2,
            'fecha'  => 3,
        ];

        $data['sighItemPlanIntegral'] = [
            'Inmunizacion'  => 1,
            'Crecimiento'  => 2,
            'Desarrollo'  => 3,
            'SuplementoNutricional'  => 4,
            'Tamizaje'  => 5,
        ];

        $data['sghOrdenServicio'] = [
            'sghPorEspecialidad'  => 0,
            'sghPorNombreServicio'  => 1,
        ];

        $data['sghCitasWebEstados'] = [
            'sghCWebAnulado'  => 0,
            'sghCWebCitaEnGalenhos'  => 1,
            'sghCWebCupoPCitaWeb'  => 2,
            'sghCWebCitaWebConfirmado'  => 3,
            'sghCWebCitaWebConfirmadoYcitado'  => 4,
        ];
        $data['sghCitaDesde'] = [
            'sghReprogramarFecha'  => 1,
            'sghReprogramarMedico'  => 2,
            'sghMantenimientoCita'  => 3,
        ];

        //'mgaray20141009
        $data['sghIntegracionTipoSistema'] = [
            'sghRisPacs'  => 1,
        ];

        $data['sghIntegracionProveedorSistema'] = [
            'sghCarestream'  => 1,
        ];

        $data['sghSexo'] = [
            'Masculino'  => 1,
            'Femenino'  => 2,
        ];

        //'DEBB2014a
        $data['sghInventarioTipo'] = [
            'sghManual'  => 1,
            'sghAutomatico'  => 2,
        ];

        //'mgaray201411e
        $data['sghDesviacion'] = [
            'sghDesviacionMenos2'  => -2,
            'sghDesviacionMenos1'  => -1,
            'sghNormal'  => 0,
            'sghDesviacion1'  => 1,
            'sghDesviacion2'  => 2,
        ];

        $data['sghDesviacionColor'] = [
            'sghDesviacionMenos3'  => '&H0&',
            'sghDesviacionMenos2'  => '&HFF&',
            'sghDesviacionMenos1'  => '&H80FF&',
            'sghNormal'  => '&H8000&',
            'sghDesviacion1'  => '&H80FF&',
            'sghDesviacion2'  => '&HFF&',
            'sghDesviacion3'  => '&H0&',
            'sghValorTriaje'  => '&H400000',
        ];
        //'mgaray201503
        $data['sghIdesTipoFinanciador'] = [
            'PersonaNatural'  => 1,
            'PersonaJuridica'  => 2,
            'Extranjero'  => 3,
        ];

        $data['sghRENAESFuente'] = [
            'SIS'  => 1,
            'SUNASA'  => 2,
            'GALENHOS'  => 3,
            'RENAESNORMA'  => 4,
        ];

        $data['sghTipoEstablecimiento'] = [
            'Hospital'  => 1,
            'CentroSalud'  => 2,
            'PuestoSalud'  => 3,
        ];

        $data['sghEstadoPeticionHttp'] = [
            'RespuestaOk'  => 200,
            'PagNoEncontrada'  => 404,
            'ErrorInternoServidor'  => 500,
            'ServidorNoEncontrado'  => 502,
            'TiempoEsperaAgotado'  => 504,
            'SinConexion'  => 12029,
        ];

        //'FRANK 24082015
        $data['sghEstadoNotaCredito'] = [
            'PorAprobar'  => 0,
            'Aprobado'  => 1,
            'anulado'  => 2,
            'Canjeado'  => 3,
        ];

        $data['sghTipoFiltroProcedimientosMQ'] = [
            'sghFiltrarTodosMQ'  => 10,
        ];

        $data['sghTipoFiltroMotivoAtencionEmergencia'] = [
            'sghFiltrarTodosAtencionEmergencia'  => 10,
        ];

        $data['sghCodigoRenaesHospitales'] = [
            'sghHospitalLoayza'  => 10,
        ];


        $value = false;
        foreach($data as $array){
            if( isset($array[$key]) ){
                $value = $array[$key];
                break;
            }
        }
        return $value;
    }
}
