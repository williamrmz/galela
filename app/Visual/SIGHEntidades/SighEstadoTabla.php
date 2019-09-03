<?php

namespace App\Visual\SIGHEntidades;

use App\BaseModel;

class SighEstadoTabla extends BaseModel
{
    public CONST PARAMS = [
        'sghOpciones' => [
            'sghAgregar' => 1,
            'sghModificar' => 2,
            'sghConsultar' => 3,
            'sghEliminar' => 4,
            'sghBuscar' => 6,
            'sghImprimir' => 7,
        ],
        
        'sghTipoNumeracionDeNroHistoria' => [
            'sghHistoriaDefinitivaAutomatica' => 1,
            'sghHistoriaDefinitivaManual' => 2,
            'sghHistoriaDefinitivaReciclada' => 3,
            'sghHistoriaTemporalCOnsultaExterna' => 4,
            'sghHistoriaTemporalEmergencia' => 5,
            'sghHistoriaTemporalAlojamiento' => 6,
            'sghHistoriaTemporalServiciosIntermedios' => 7,
            'sghSinHistoria' => 9,
        ],
        
        'sghTipoServicio' => [
            'sghConsultaExterna' => 1,
            'sghEmergenciaConsultorios' => 2,
            'sghHospitalizacion' => 3,
            'sghEmergenciaObservacion' => 4,
        ],
        
        'sghBotonDetallePresionado' => [
            'sghAceptar' => 10,
            'sghCancelar' => 20,
        ],
        
        'sghTipoFiltroPacientes' => [
            'sghFiltrarTodos' => 10,
            'sghFiltrarConHistoriasTemporales' => 20,
            'sghFiltrarConHistoriasDefinitivas' => 30,
            'sghFiltrarTriaje' => 40,
        ],
        
        'sghTipoFiltroAdmision' => [
            'sghFiltrarConsultaExterna' => 10,
            'sghFiltrarHospitalizacion' => 20,
            'sghFiltrarConsultorioEmergencia' => 30,
            'sghFiltrarObservacionEmergencia' => 40,
            'sghFiltrarEmergencia' => 50,
        ],
        
        'sghEtapaPrestamoHistoriaClinica' => [
            'sghSolicitud' => 1,
            'sghEnvio' => 2,
            'sghDevolucion' => 3,
        ],
        
        'sghTipoBusquedaPrestamoHistoria' => [
            'sghTodasHistorias' => 1,
            'sghHistoriaSolicitadas' => 2,
            'sghHistoriaEnPrestamo' => 3,
            'sghHistoriaDevueltas' => 4,
        ],
        
        'sghTipoVistaFormAtenciones' => [
            'sghVistaAdmision' => 1,
            'sghVistaAtencion' => 2,
        ],
        'sghTiposDiagnostico' => [
            'sghAtencionConsultaExterna' => 1,
            'sghHospitalizacionIngreso' => 2,
            'sghHospitalizacionEgreso' => 3,
            'sghHospitalizacionMortalidad' => 4,
            'sghHospitalizacionNacimiento' => 5,
            'sghHospitalizacionComplicaciones' => 6,
            'sghInterconsultas' => 7,
        ],
        'sghTipoAccionEmergenciaYHospitalizacion' => [
            'sghAdmisionNormal' => 1,
            'sghEnviarAObservacion' => 2,
            'sghTrasladarAHospitalizacion' => 3,
            'sghDarDeAlta' => 4,
            'sghIngresarUnAlojamientoConjunto' => 5,
            'sghTransferencias' => 6,
        ],
        'sghTiposReporteHospitalizacion' => [
            'sghReporteEgresosHospitalario' => 1,
            'sghReporteIngresosHospitalario' => 2,
        ],
        
        'sghTipoDetalleComprobante' => [
            'sghDetalleComprobanteServicios' => 1,
            'sghDetalleComprobanteInsumos' => 2,
        ],
        
        'sghEstadoFacturacion' => [
            'sghAtendido' => 1,
            'sghPendientePago' => 3,
            'sghPagadoYatendido' => 4,
            'sghDevolver' => 5,
            'sghDevuelto' => 6,
            'sghAnulado' => 9,
            'sghAutorizAutomática' => 10,
            'sghDespachado' => 11,
            'sghRegistrado' => 12,
            'sghReembolsoParcial' => 15,
            'sghConPreVenta' => 16,
        ],
        
        'sghTipoEstadoAtencion' => [
            'sghEstadoAtencionSolicitado' => 1,
            'sghEstadoAtencionAtendido' => 2,
        ],
        
        'sghEstadoCuenta' => [
            'sghAbierto' => 1,
            'sghPagado' => 4,
            'sghCerrado' => 5,
            'sghAnulado' => 9,
            'sghConAltaMedica' => 10,
            'sghPendientePagoSeguros' => 11,
            'sghNoLlegaAlServicioHospitalizado' => 12,
        ],
        
        'sghTipoFacturacionServicio' => [
            'sghFacturacionServicioPorEstancia' => 1,
            'sghFacturacionServicioPorProcedimiento' => 2,
            'sghFacturacionServicioTotal' => 3,
        ],
        
        'sghTipoFinanciamiento' => [
            'sghBase' => 0,
            'sghPacienteNormal' => 1,
            'sghSis' => 2,
            'SisIndependiente' => 3,  //JHIMI 18042018 Nuevo tipo
            'sghSOAT' => 19,  //JHIMI 18032018 de 3 a 19
            'sghConvenios' => 18,  //JHIMI 18032018 de 4 a 18
            'sghCreditoHospitalario' => 5,
            'sghDefensaNacional' => 6,
            'sghServicioSocial' => 9,
            'sghCreditoPersonal' => 10,
        ],
        
        'sghFuenteFinanciamiento' => [
            'sghFFPaciente' => 1,
            'sghFFSIS' => 3,
            'sghFFSoat' => 4, //JHIMI 18042018 de 2 a 4
            'sghFFParticularHospitalizado' => 5,
            'sghFFFospoli' => 6,
            //'sghFFSeguroPacifico => 2,
            //'sghFFSeguroRimac => 3,
            //'sghFFSeguroWieseAetna => 4,
            //'sghFFSeguroGenerali => 5,
            //'sghFFESSALUD => 6,
            //'sghFFFospoli => 7,
            //'sghFFSeguroLaPositiva => 10,
            //'sghFFPacienteParticular => 11,
        ],
        
        
        'sghTipoEmpleado' => [
            'sghCajero' => 1,
            'sghCuentaCorriente' => 2,
            'sghSis' => 3,
            'sghConvenio' => 4,
            'sghAsistenta' => 5,
            'sghSOAT' => 6,
            'sghOtros' => 7,
        ],
        
        'sghTipoProducto' => [
            'sghbien' => 1,
            'sghServicio' => 2,
            'sghAmbos' => 3,
        ],
        
        'sghOpcionesPago' => [
            'sghNuevoPagoConHistoria' => 1,
            'sghNuevoPagoSinHistoria' => 2,
            'sghPagarOrdenExistente' => 3,
            'sghPagarCuentaExistente' => 4,
            'sghDevolucion' => 5,
            'sghAnulacion' => 6,
            'sghReimprimirComprobante' => 7,
            'sghPagarOrdenExistenteF' => 8,
            'sghPagarOrdenExistenteFS' => 9,
            'sghPagarCuentaTotalFS' => 10,
            
            'sghDevolucionINO' => 11,
            'sghAnularDevolucionINO' => 12,
        ],
        
        'sghAreasLaboraEmpleado' => [
            'sghAlmacenFarmacia' => 1,
            'sghImageneología' => 2,
            'sghLaboratorio' => 3,
            'sghSeguros' => 4,
            'sghEspecialidadesCE' => 5,
            'sghEspecialidadesHosp' => 6,
            'sghEspecialidadesEmergObs' => 7,
            'sghEspecialidadesEmergCons' => 8,
            'sghAreaTramitaSeguros' => 9,
        ],
        
        'sghTipoOrden' => [
            'sghPorCodigo' => 1,
            'sghPorDescripcion' => 2,
            'sghPorIdProductoMasFecha' => 3,
            'sghPorFechaYhora' => 4,
            'sghPorIdProductoMasIdServiciopaciente' => 5,
            'sghPorIdFuenteFinanciamientoIdTipoServicio' => 6,
            'sghPorServicioNombre' => 7,
            'sghPorDepartamentoEspecialidadServicioNombre' => 8,
        ],
        
        'sghEstadoTabla' => [
            'sghAnulado' => 0,
            'sghRegistrado' => 1,
            'sghCerrado' => 2,
        ],
        
        'sghTipoServicioOfrecidos' => [
            'sghSoloInsumos' => 0,
            'sghSoloCPT' => 1,
            'sghInsumosYcpt' => 2,
        ],
        
        'sghImpresion' => [
            'sghPantalla' => 0,
            'sghImpresoraBoletaContinua' => 1,
            'sghImpresoraBoletaPorBoleta' => 2,
            'sghImpresora' => 3,
            'sghExcel' => 4,
            'sghImpresionFactura' => 5,
        ],
        
        'sghDatoDelEmpleado' => [
            'sghIniciales' => 0,
            'sghUsuario' => 1,
            'sghApellidosYnombres' => 2,
        ],
        
        
        'sghTipoServicioHospitalizacion' => [
            'sghSoloPacHospitalizados' => 1,
            'sghSoloPacAlojados' => 2,
            'sghTodos' => 3,
        ],
        
        'sghTipoEdades' => [
            'sghAño' => 1,
            'sghMeses' => 2,
            'sghDias' => 3,
            'sghHoras' => 4,
        ],
        
        'sghTipoEstados' => [
            'sghFiltraSoloAnulados' => 0,
            'sghFiltraSoloActivos' => 1,
            'sghFiltraAnuladosYactivos' => 2,
        ],
        
        'sghOrdenDeServiciosHospital' => [
            'sghPorDescTipoServicio' => 1,
            'sghPorDescServicio' => 2,
        ],
        
        'sghTipoFinanciamientoGeneraPago' => [
            'sghTodosLosQuePaganEnCaja' => 1,
            'sghTodosLosQueTienenAlgunSeguro' => 5,
            'sghSoloSeguroSIS' => 2,
            'sghSoloSeguroSOAT' => 3,
            'sghSoloSeguroConvenios' => 4,
        ],
        
        'sghComoSeTrabajaEnEstadoCuentaLosSeguros' => [
            'sghTrabajaNinguno' => 0,
            'sghTrabajaParticular' => 1,
            'sghTrabajaSeguroSIS' => 2,
            'sghTrabajaSeguroSOAT' => 3,
            'sghTrabajaSeguroConvenios' => 4,
            'sghTrabajaServicioSocial' => 9,
        ],
        
        'sghPuntosCargaBasicos' => [
            'sghPtoCargaAdmisionEmergencia' => 10,
            'sghPtoCargaAdmisionHospitalizacion' => 9,
            'sghPtoCargaAdmisionCE' => 6,
            'sghPtoCargaServicioHospitalizacion' => 1,
            'sghPtoCargaCaja' => 99,
            'sghPtoCargaRayosX' => 21,
            'sghPtoCargaTomografia' => 22,
            'sghPtoCargaEcogObstetrica' => 23,
            'sghPtoCargaEcogGeneral' => 20,
            'sghPtoCargaPatologiaClinica' => 2,
            'sghPtoCargaAnatomiaPatologica1' => 3,
            'sghPtoCargaAnatomiaPatologica2' => 32,
            'sghPtoCargaBancoSangre1' => 11,
            'sghPtoCargaBancoSangre2' => 38,
            'sghPtoCargaFarmacia' => 5,
            'sghPtoCargaCentroQx' => 622,
            'sghPtoCargaCtp' => 2500,
        ],
        
        
        'sghTipoPaquetes' => [
            'sghTipoPaqueteSoloServicio' => 1,
            'sghTipoPaqueteSolofarmacia' => 2,
            'sghTipoPaqueteServicioYfarmacia' => 3,
        ],
        
        'sghTipoPrecioFarmacia' => [
            'sghPrecioCompra' => 1,
            'sghPrecioDistribucion' => 2,
            'sghPrecioVentaContado' => 3,
            'sghPrecioDonacion' => 4,
        ],
        
        'sghTipoConceptoImagen' => [
            'sghImgTCingreso' => 1,
            'sghImgTCsalidaDeterioro' => 2,
            'sghImgTCsalida' => 3,
        ],
        
        'sghTipoDx' => [
            'sghTipoDxNINGUNO' => 0,
            'sghTipoDxDefinitivo' => 1,
            'sghTipoDxPresuntivo' => 2,
        ],
        
        'sghTipoSalidaItemFarmacia' => [
            'sghSoloVenta' => 1,
            'sghSoloEstrategico' => 2,
            'sghVentaEstrategico' => 3,
            'sghDonaciones' => 4,
        ],
        
        'sghBaseDatosExterna' => [
            'sghJamo' => 273,
            'sghSis' => 325,
            'visitasH' => 372, //JR
        ],
        
        //debb-24/03/2011
        'sghFiltraCpt' => [
            'sghMuestraTodosCpt' => 0,
            'sghCptSoloLaboratorio' => 1,
            'sghCptSoloRayosX' => 2,
            'sghCptSoloTomografia' => 3,
            'sghCptSoloEcografiaObstetrica' => 4,
            'sghCptSoloEcografiaGeneral' => 5,
        ],
        
        
        'sghPerinatalModulos' => [
            'sighHasta28Dias' => 1,
            'sighDesde29diasHasta1anio' => 2,
            'sighDesde1Hasta4anios' => 3,
            'sighDesde5Hasta9anios' => 4,
            'sighDesde10Hasta11anios' => 5,
            'sighDesde12Hasta17anios' => 6,
            'sighDesde18anios' => 7,
        ],
        
        'sghPerinatalListas' => [
            'sighInmunizaciones' => 1,
            'sighCptFrecuentes' => 2,
            'sighMorbilidadDesarrollo' => 3,
            'sighMorbilidadFrecuente' => 4,
        ],
        
        'sghDxDefinitivos' => [
            'sighDxCeDefinitivo' => 102,
            'sighDxHospEmergPrincipal' => 301,
            'sighDxHospEmergCausaFinal' => 303,
            'sighDxHospEmergDefinitivo' => 402,
        ],
        
        'sghRecetaEstados' => [
            'sighRecetaAnulada' => 0,
            'sighRecetaRegistrada' => 1,
            'sighRecetaDespachada' => 2,
            'sighRecetaConBoleta' => 3,
        ],
        
        'sghEstadosComprobante' => [
            'sighEstadosComprobantePagado' => 4,
            'sighEstadosComprobanteDevuelto' => 6,
            'sighEstadosComprobanteAnulado' => 9,
        ],
        'sghTipoConceptoFarmacia' => [
            'sghTipoConceptoSIS' => 13,
            'sghTipoConceptoSOAT' => 14,
            'sghTipoConceptoConvenios' => 23,
        ],
        'sghOpcionGalenHos' => [
            'sghRegistroCitaCE' => 102,
            'sghRegistroAtencionCE' => 103,
            'sghEstadoDeCuenta' => 613,
            'sghFormatoFUA' => 1345,
            'sghAdmisionEmergencia' => 202,
            'sghAdmisionHospitalizacion' => 302,
            'sghVentasFarmacia' => 1307,
            'sghConsumoEnServicio' => 601,
            'sghLaboratorioAP' => 1321,
            'sghLaboratorioPC' => 1312,
            'sghLaboratorioBS' => 1322,
            'sghImagenEcogO' => 1320,
            'sghImagenEcogG' => 1317,
            'sghImagenRayosX' => 1318,
            'sghImagenTomografia' => 1319,
            'sghPacienteExternoConSeguro' => 1339,
            'sghGestionGaja' => 702,
        ],
        'sghTipoCondicion' => [
            'sghTipoCondicionNuevo' => 1,
            'sghTipoCondicionReingresante' => 2,
            'sghTipoCondicionContinuador' => 3,
        ],
        'sghUltimaBusqueda' => [
            'sghEnBoleta' => 1,
            'sghEnNroCuenta' => 2,
        ],
        
        //JVG 02-04-2012 - Adicion de Enumeracion para el Modulo HIS GalenHos
        //Tipo de Actividades en HIS GalenHos
        'sghHISTipoActividad' => [
            'Atencion' => 1,
            'ActividadPreventivaPromocional' => 2,
            'ActividadMasiva' => 3,
            'ActividadConAnimales' => 4,
        ],
        
        'sghHISTipoEdades' => [
            'dias' => 1,
            'meses' => 2,
            'Años' => 3,
        ],
        
        'sghHISEstados' => [
            'Nuevo' => 1,
            'Reingreso' => 2,
            'Continuador' => 3,
        ],
        
        'sghCitaWebEstados' => [
            'CupoANULADO' => 0,
            'CupoLlenadoEnCitaGalenHos' => 1,
            'CupoDisponibleEnCitaWeb' => 2,
            'CupoConfirmadoEnCitaWeb' => 3,
            'CupoConfirmadoYconCitaEnGalenhos' => 4,
            
            'CupoDisponibleEnRefCon' => 5,
            'CupoConfirmadoEnRefCon' => 6,
        ],
        
        'sghSIScodigo' => [
            'sghAfiliacionLPISpago' => 1,
            'sghInscripcionLPIS' => 2,
            'sghAfiliacionLPISgratis' => 3,
            'sghAfiliacionLPISgratisAntiguo' => 4,
            'sghAfiliacionAUXgratis' => 7,
            'sghInscripcionAUX' => 8,
        ],
        
        'sghColores' => [
            'sghRojo' => 1,
            'sghAzul' => 2,
            'sghNegro' => 3,
            'sghVerde' => 4,
            'sghBlanco' => 5,
        ],
        
        
        'sghRecetasEstadosDetalle' => [
            'sghAnuladoPorMedico' => 0,
            'sghRecetado' => 1,
            'sghDespachado' => 2,
            'sghEnDosisAlPaciente' => 3,
            'sghConcluido' => 4,
        ],
        
        'sghVersionBD' => [
            'sighSql2000' => 0,
            'sighSql2008' => 1,
            'sighPosgreSql' => 2,
        ],
        
        'sghDefaultVentana' => [
            'sighApellidoPaterno' => 0,
            'sighDNI' => 1,
            'sighHistoria' => 2,
        ],
        
        'sghFuaTipo' => [
            'sghFuaTipoManual' => 1,
            'sghFuaTipoAutomatico' => 2,
        ],
        
        
        'sghTipoProceso' => [
            'sghProcesaYgraba' => 1,
            'sghSoloParaReporte' => 2,
        ],
        
        'sghCategoriaEstablecimiento' => [
            'sghOtros' => 0,
            'sghHospital' => 1,
            'sghCS' => 2,
            'sghPS' => 3,
        ],
        
        //mgaray
        'sighTriajeOrigen' => [
            'Triaje' => 1,
            'ConsultaExterna' => 2,
            'Emergencia' => 3,
            'Hospitalizacion' => 4,
        ],
        
        'sighTriajeVariable' => [
            'Peso' => 1,
            'Talla' => 2,
            'PerimCefalico' => 3,
            'PresArtSistolica' => 4,
            'PresArtDiastolica' => 5,
            'Temperatura' => 6,
            'FrecCardiaca' => 7,
            'FrecRespiratoria' => 8,
            'Pulso' => 9,
            //PAOLA
            'Saturacion' => 10,
        ],
        
        'sighTriajeEstadoPaciente' => [
            'NoRequerido' => 0,
            'Despierto' => 1,
            'Dormido' => 2,
        ],
        
        //atención integral
        'sighGrupoEdad' => [
            'Nino' => 1,
            'Adolescente' => 2,
            'Joven' => 3,
            'Adulto' => 4,
            'AdultoMayor' => 5,
        ],
        
        'sighTipoDatoRespuesta' => [
            'Texto' => 1,
            'Numerico' => 2,
            'fecha' => 3,
        ],
        
        'sighItemPlanIntegral' => [
            'Inmunizacion' => 1,
            'Crecimiento' => 2,
            'Desarrollo' => 3,
            'SuplementoNutricional' => 4,
            'Tamizaje' => 5,
        ],
        
        'sghOrdenServicio' => [
            'sghPorEspecialidad' => 0,
            'sghPorNombreServicio' => 1,
        ],
        
        'sghCitasWebEstados' => [
            'sghCWebAnulado' => 0,
            'sghCWebCitaEnGalenhos' => 1,
            'sghCWebCupoPCitaWeb' => 2,
            'sghCWebCitaWebConfirmado' => 3,
            'sghCWebCitaWebConfirmadoYcitado' => 4,
        ],
        'sghCitaDesde' => [
            'sghReprogramarFecha' => 1,
            'sghReprogramarMedico' => 2,
            'sghMantenimientoCita' => 3,
        ],
        
        //mgaray20141009
        'sghIntegracionTipoSistema' => [
            'sghRisPacs' => 1,
        ],
        
        'sghIntegracionProveedorSistema' => [
            'sghCarestream' => 1,
        ],
        
        'sghSexo' => [
            'Masculino' => 1,
            'Femenino' => 2,
        ],
        
        //DEBB2014a
        'sghInventarioTipo' => [
            'sghManual' => 1,
            'sghAutomatico' => 2,
        ],
        
        //mgaray201411e
        'sghDesviacion' => [
            'sghDesviacionMenos2' => -2,
            'sghDesviacionMenos1' => -1,
            'sghNormal' => 0,
            'sghDesviacion1' => 1,
            'sghDesviacion2' => 2,
        ],
        
        'sghDesviacionColor' => [
            'sghDesviacionMenos3' => '&H0&',
            'sghDesviacionMenos2' => '&HFF&',
            'sghDesviacionMenos1' => '&H80FF&',
            'sghNormal' => '&H8000&',
            'sghDesviacion1' => '&H80FF&',
            'sghDesviacion2' => '&HFF&',
            'sghDesviacion3' => '&H0&',
            'sghValorTriaje' => '&H400000',
        ],

        //mgaray201503
        'sghIdesTipoFinanciador' => [
            'PersonaNatural' => 1,
            'PersonaJuridica' => 2,
            'Extranjero' => 3,
        ],
        
        'sghRENAESFuente' => [
            'SIS' => 1,
            'SUNASA' => 2,
            'GALENHOS' => 3,
            'RENAESNORMA' => 4,
        ],
        
        'sghTipoEstablecimiento' => [
            'Hospital' => 1,
            'CentroSalud' => 2,
            'PuestoSalud' => 3,
        ],
        
        'sghEstadoPeticionHttp' => [
            'RespuestaOk' => 200,
            'PagNoEncontrada' => 404,
            'ErrorInternoServidor' => 500,
            'ServidorNoEncontrado' => 502,
            'TiempoEsperaAgotado' => 504,
            'SinConexion' => 12029,
        ],
        
        //FRANK 24082015
        'sghEstadoNotaCredito' => [
            'PorAprobar' => 0,
            'Aprobado' => 1,
            'anulado' => 2,
            'Canjeado' => 3,
        ],
        
        'sghTipoFiltroProcedimientosMQ' => [
            'sghFiltrarTodosMQ' => 10,
        ],
        
        'sghTipoFiltroMotivoAtencionEmergencia' => [
            'sghFiltrarTodosAtencionEmergencia' => 10,
        ],
        
        'sghCodigoRenaesHospitales' => [
            'sghHospitalLoayza' => 10,
        ],
        
    ];
}

    