var dateHTML = "";
var CONFIG_IDPACIENTE = "";
var CONFIG_IDCITA = "";
var CONFIG_IDATENCION = "";

$(document).ready(function ()
{
    //:: Eventos
    initEventosPaciente();
    initEventosCita();
    initEventosEstablecimiento();

    //:: Combos
    cargarCombosEstablecimiento();
    cargarCombosPaciente(true);
    initFormPaciente();
});

// INICIO: PACIENTE
// Descripcion: JS relacioando a paciente
function readURLPaciente(input)
{
    var url = input.value;

    if( typeof url !== 'undefined')
    {
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();

        if( (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg") ){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagenPacientePreview').attr('src', e.target.result);
                    $('#imagenPacientePreview').attr('title', input.files[0].name );
                }

                reader.readAsDataURL(input.files[0]);
            }else{
                toastr.error('A ocurrido un error en la seleccion de la imagen', 'Error');
            }
        }else{
            toastr.warning('El archivo seleccionado debe ser una imagen', 'Alerta');
        }
    }else{
        $('#imagenPacientePreview').attr('src', basePath+'/storage/images/config/SIN_IMAGEN.PNG');
        $('#imagenPacientePreview').attr('title', 'Sin imagen' );
    }
}

function desactivarFormPaciente(status = false)
{
    // Deshabilitar todos los elementos select afectados por el plugin Select2
    $('#paciente-form-div .select2-hidden-accessible').each( function() { $(this).prop('disabled', status) });

    // Deshabilitar todos los INPUT existentes
    $('#paciente-form-div input').each( function() { $(this).prop('readonly', status) });
    $('#paciente-form-div textarea').each( function() { $(this).prop('readonly', status) });
    $('#btnIgualQueDomicilioP').prop('disabled', status);
    $('#btnIgualQueDomicilioN').prop('disabled', status);


    // Ocultar los botoenes de carga de imagen
    status? $('label[for="imagenPaciente"]').hide(): $('label[for="imagenPaciente"]').show();
    status? $('#paciente-form-div #imagenPacienteClear').hide(): $('#imagenPacienteClear').show();

    if(!status)
    {
        $('#paciente-form-div select[name="cmbIdTipoGenHistoriaClinica"]').trigger('select2:select');
    }
}

function initEventosPaciente()
{
    // Boton agregar paciente
    $("#paciente-btn-add").click(function ()
    {
        desactivarBusquedaPaciente(true);
        desactivarFormPaciente(false);
    });

    // Botón buscar
    $('#paciente-form-search').submit( function(e)
    {
        e.preventDefault();
        listarPaciente();
    });

    // Botón limpiar
    $('#paciente-btn-clear').click( function(e)
    {
        e.preventDefault();
        initFormPaciente();
        desactivarBusquedaPaciente(false);
        desactivarFormPaciente(true);
        $('#paciente-form-search').trigger("reset");
        $(".paciente-paginator").html("");
        $('.paciente-tbody').html('<tr> <td colspan="12" class="text-center"> Sin resultados </td> </tr>');
        $("#paciente-consultas-anteriores").html("");
    });

    // :: Buscar en RENIEC
    $("input[name='txtNroDocumento']").focusout(function ()
    {
        var tipoDoc = $('select[name="cmbIdDocIdentidad"]').val();
        if (tipoDoc=="1")
        {
            var dni = $('input[name="txtNroDocumento"]').val();
            buscarPacientexDNI(dni);
        }
    });

    // :: Bloquear campos de fecha e historia en caso la historia es manual
    $('select[name="cmbIdTipoGenHistoriaClinica"]').on('select2:select', function (e)
    {
        var valorComboSeleccionado = $('select[name="cmbIdTipoGenHistoriaClinica"]').val();

        if( valorComboSeleccionado == 2)
        {
            desactivarHistoriaFechaPaciente( false );
        }else
        {
            desactivarHistoriaFechaPaciente( true );
        }
    });

    // :: Inicializar evento de cambio para combos de ubigeo
    var contextArray = ["Domicilio", "Procedencia", "Nacimiento"];
    contextArray.forEach( function(contexto, indice, array)
    {
        // Inicializar evento de cambio
        $('select[name="cmbIdPais'+contexto+'"]').change( function ()
        {
            console.log("PAIS EJECUCION DEL CONTEXTO", contexto, "VALOR", $(this).val());
            cargarComboDepartamentos(contexto);
        });

        $('select[name="cmbIdDepartamento'+contexto+'"]').change( function ()
        {
            cargarComboProvincias(contexto);
        });

        $('select[name="cmbIdProvincia'+contexto+'"]').change( function ()
        {
            cargarComboDistritos(contexto);
        });

        $('select[name="cmbIdDistrito'+contexto+'"]').change( function ()
        {
            cargarComboCentrosPoblados(contexto);
        });
    });

    // :: Botón que permite copiar información de ubigeo a otros combos
    $('#btnIgualQueDomicilioP').click( function(e)
    {
        e.preventDefault();
        igualarCombosPaciente('Procedencia');
    });

    $('#btnIgualQueDomicilioN').click( function(e)
    {
        e.preventDefault();
        igualarCombosPaciente('Nacimiento');
    });

    // :: Cuando cambie fecha de nacimiento, calcular edad
    $('input[name="txtFechaNacimiento"]').focusout( function(e)
    {
        getEdadPaciente( $(this).val()  );
        $('input[name="txtFnacimiento"]').val( $(this).val() );
    });
}

function initFormPaciente()
{
    CONFIG_IDPACIENTE = "";

    //-- Datos de la Historia Clinica
    $('select[name="cmbIdDocIdentidad"]').val(1).trigger('change');
    $('input[name="txtNroDocumento"]').val('');
    $('input[name="txtFechaCreacion"]').val('');

    $('select[name="cmbIdTipoGenHistoriaClinica"]').val(1).trigger('change').trigger('select2:select');
    $('input[name="txtIdNroHistoria"]').val('');
    //-- Datos del paciente
    $('input[name="txtApellidoPaterno"]').val('');
    $('input[name="txtApellidoMaterno"]').val('');
    $('input[name="txtPrimerNombre"]').val('');
    $('input[name="txtSegundoNombre"]').val('');
    $('input[name="txtTercerNombre"]').val('');
    $('input[name="txtFechaNacimiento"]').val('');
    $('select[name="cmbIdTipoSexo"]').val('1').trigger('change');
    $('input[name="txtNroHijo"]').val('');
    $('select[name="cmbEtnia"]').val('80').trigger('change');
    $('select[name="cmbIdIdioma"]').val('101').trigger('change');
    $('textarea[name="txtObservacion"]').val('');
    $('select[name="cmbIdEstadoCivil"]').val('').trigger('change');
    $('input[name="txtIdPaciente"]').val('');
    $('select[name="cmbIdGradoInstruccion"]').val('').trigger('change');
    $('input[name="txtEdadActual"]').val('');
    $('input[name="txtTelefono"]').val('');
    $('select[name="cmbIdProcedencia"]').val('').trigger('change');
    $('select[name="cmbIdTipoOcupacion"]').val('').trigger('change');
    $('input[name="txtEmail"]').val('');
    $('input[name="txtNombrePadre"]').val('');
    $('input[name="foto_base64"]').val('');
    readURLPaciente($('input[name="imagenPaciente"]').val(''));
    //-- Datos de la madre o tutor
    $('select[name="cmbMadreTipoDocumento"]').val('1').trigger('change');
    $('input[name="txtMadreDocumento"]').val('');
    $('input[name="txtMadreApellidoP"]').val('');
    $('input[name="txtMadreApellidoM"]').val('');
    $('input[name="txtMadreNombre"]').val('');
    $('input[name="txtMadreSnombre"]').val('');
    //-- Ubigeo
    $('select[name="cmbIdPaisDomicilio"]').val('166').trigger('change');
    $('select[name="cmbIdPaisProcedencia"]').val('166').trigger('change');
    $('select[name="cmbIdPaisNacimiento"]').val('166').trigger('change');
    $('textarea[name="grdEpicrisis"]').val('');
    $('input[name="txtDireccionDomicilio"]').val('');
}

function buscarPacientexDNI(dni)
{
    if(dni.length==8)
    {
        overlay_title = "&nbsp; Consultando en RENIEC";
        $.ajax({
            data: {'nro_documento': dni }, url: urlPaciente+'/api/service?name=get_by_nro_documento',
            type:  'GET', dataType: 'json',
            success:  function (response)
            {
                if(response.IdPaciente!=null || response.IdPaciente!=undefined)
                {
                    nombreCompleto = $.trim(response.ApellidoPaterno)+" "+$.trim(response.ApellidoMaterno)+" "+$.trim(response.PrimerNombre);
                    toastr.error( response.message, 'El nro. documento ya se encuentra registrado para el paciente '+nombreCompleto);
                    $("input[name='txtNroDocumento']").val("");
                    initFormPaciente();
                    return;
                }

                $('input[name="txtDocumento"]').val( $('select[name="cmbIdDocIdentidad"]').select2('data')[0].Descripcion );
                $("input[name='txtApellidoPaterno']").val( response.ApellidoPaterno);
                $("input[name='txtApellidoMaterno']").val( response.ApellidoMaterno);
                $("input[name='txtPrimerNombre']").val( response.PrimerNombre);
                $("input[name='txtSegundoNombre']").val( response.SegundoNombre);
                $("input[name='txtTercerNombre']").val( response.TercerNombre);
                $("input[name='txtDireccionDomicilio']").val( response.DireccionDomicilio);
                $("input[name='txtNombrePadre']").val( response.NombrePadre);
                $("input[name='txtMadreNombre']").val( response.NombreMadre);
                $("input[name='txtFechaNacimiento']").val( response.FechaNacimiento);
                $('input[name="txtFechaNacimiento"]').trigger('change');
                $("select[name='cmbIdTipoSexo']").val( response.IdTipoSexo);
                $("select[name='cmbIdTipoSexo']").select2();
                $('input[name="txtSexo"]').val( $('select[name="cmbIdTipoSexo"]').select2('data')[0].text );


                $("select[name='cmbIdPaisDomicilio']").val( response.IdPaisDomicilio);
                $("select[name='cmbIdPaisDomicilio']").select2();
                $("select[name='cmbEtnia']").val( response.IdEtnia);
                $("select[name='cmbEtnia']").select2();
                $("select[name='cmbIdIdioma']").val( response.IdIdioma);
                $("select[name='cmbIdIdioma']").select2();

                // Cargar foto
                $('#imagenPacientePreview').attr('src', "data:image/jpeg;base64,"+response.foto_base64);
                $('#imagenPacientePreview').attr('title', response.NroDocumento);


                // Obtener códigos de departamentos
                verificarUbigeoParaCargarCombos(response.IdDistritoDomicilio, 'Domicilio');

                // Cargar combos anidados nacimiento
                verificarUbigeoParaCargarCombos(response.IdDistritoNacimiento, 'Nacimiento');


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                if(jqXHR.status == 500)
                {
                    toastr.error("El servicio RENIEC no responde. <br> Ingrese los datos manualmente", 'Error');
                }
            }
        });
    }
}

function cargarCombosPaciente(desactivaForm = false)
{
    // :: INICIO: PACIENTE ::
    $.ajax({
        data: {}, url: url+'/api/service?name=getData',
        type:  'GET', dataType: 'json',
        success:  function (data)
        {

            var form = data.forms;
            dateHTML = form.dateHTML;

            // Cargar opcion vacio( "..." ) a los combos en el inicio
            form.cmbTipoSexo.unshift(opcionBlanco);
            form.cmbEtnia.unshift(opcionBlanco);
            form.cmbIdioma.unshift(opcionBlanco);
            form.cmbEstadoCivil.unshift(opcionBlanco);
            form.cmbGradoInstruccion.unshift(opcionBlanco);
            form.cmbProcedencia.unshift(opcionBlanco);
            form.cmbTipoOcupacion.unshift(opcionBlanco);


            // Mostrar informacion en los combos, y aplicar plugin select2
            $('select[name="cmbIdDocIdentidad"]').select2({data: form.cmbDocIdentidad}).trigger('change');
            $('select[name="cmbIdTipoGenHistoriaClinica"]').select2({data: form.cmbTipoGenHistoriaClinica}).val(1).trigger('change').trigger('select2:select');;
            $('select[name="cmbIdTipoSexo"]').select2({data: form.cmbTipoSexo}).val('1').trigger('change');;
            $('select[name="cmbEtnia"]').select2({data: form.cmbEtnia}).val("80").trigger('change');
            $('select[name="cmbIdIdioma"]').select2({data: form.cmbIdioma}).val("101").trigger('change');
            $('select[name="cmbIdEstadoCivil"]').select2({data: form.cmbEstadoCivil});
            $('select[name="cmbIdGradoInstruccion"]').select2({data: form.cmbGradoInstruccion});
            $('select[name="cmbIdProcedencia"]').select2({data: form.cmbProcedencia});
            $('select[name="cmbIdTipoOcupacion"]').select2({data: form.cmbTipoOcupacion});
            $('select[name="cmbMadreTipoDocumento"]').select2({data: form.cmbDocIdentidad});

            // Cargar opcion vacio( "..." ) a los combos en el inicio
            form.cmbParentescoTitular.unshift(opcionBlanco);
            form.cmbRegimen.unshift(opcionBlanco);
            form.cmbTipoAfiliacion.unshift(opcionBlanco);
            form.cmbValidacionRegIden.unshift(opcionBlanco);
            form.cmbEstadoSeguro.unshift(opcionBlanco);
            form.cmbTipoOperacion.unshift(opcionBlanco);

            // Mostrar informacion en los combos, y aplicar plugin select2
            $('select[name="cmbParentescoTitular"]').select2({data: form.cmbParentescoTitular});
            $('select[name="cmbDocumentoAnterior"]').select2({data: form.cmbDocIdentidad});
            $('select[name="cmbPaisTitular"]').select2({data: form.cmbPais}).val('166').trigger('change');
            $('select[name="cmbDocumentoTitular"]').select2({data: form.cmbDocIdentidad}).val('').trigger('change');
            $('select[name="cmbRegimen"]').select2({data: form.cmbRegimen});
            $('select[name="cmbTipoAfiliacion"]').select2({data: form.cmbTipoAfiliacion});
            $('select[name="cmbValidacionRegIden"]').select2({data: form.cmbValidacionRegIden});
            $('select[name="cmbEstadoSeguro"]').select2({data: form.cmbEstadoSeguro});
            $('select[name="cmbSepelioSexo"]').select2({data: form.cmbTipoSexo});
            $('select[name="cmbTipoOperacion"]').select2({data: form.cmbTipoOperacion});

            // Cargar paises de los combos
            dataCmbPais = form.cmbPais;
            let contextArray = ["Domicilio", "Procedencia", "Nacimiento"];
            contextArray.forEach( function(contexto, indice, array)
            {
                console.log('select[name="cmbIdPais'+contexto+'"]', "EXECUTED");
                $('select[name="cmbIdPais'+contexto+'"]').html('').select2( {'data': dataCmbPais }).val('166').trigger('change').trigger('select2:select');
            });

            if(desactivaForm)
            {
                desactivarFormPaciente(desactivaForm);
            }

        }
    });
}

function igualarCombosPaciente(context )
{
    idPaisDomicilio = $('select[name="cmbIdPaisDomicilio').val();
    idDepartamentoDomicilio = $('select[name="cmbIdDepartamentoDomicilio').val();
    idProvinciaDomicilio = $('select[name="cmbIdProvinciaDomicilio').val();
    idDistritoDomicilio = $('select[name="cmbIdDistritoDomicilio').val();
    idCentroPobladoDomicilio = $('select[name="cmbIdCentroPobladoDomicilio').val();

    $('select[name="cmbIdPais'+context).val(idPaisDomicilio).trigger('change');
    cargarCombosAnidadosPaciente(idDepartamentoDomicilio, idProvinciaDomicilio, idDistritoDomicilio, idCentroPobladoDomicilio,context);
}

function cargarCombosAnidadosPaciente(ubidep, ubiprov, ubidis, ubicentrop, context)
{
    // Cargar departamentos
    $.ajax({
        data: {service: 'getDepartamentosData'},
        url: urlControles,
        type:  'GET', dataType: 'json',
        success:  function (cmbDepartamentoData)
        {
            cmbDepartamentoData.unshift(opcionBlanco);
            $('select[name="cmbIdDepartamento'+context+'"]').html ('').select2({ data: cmbDepartamentoData });
            reiniciarComboPaciente( 'cmbIdProvincia'+context );
            reiniciarComboPaciente( 'cmbIdDistrito'+context );
            reiniciarComboPaciente( 'cmbIdCentroPoblado'+context );

            // Seleccionar departamento
            $('select[name="cmbIdDepartamento'+context+'"').val( ubidep).trigger('change');

            // Cargar provincias
            $.ajax({
                data: {service: 'getProvinciasData', idDepartamento: ubidep },
                url: urlControles,
                type:  'GET', dataType: 'json',
                success:  function (cmbProvinciasData) {
                    cmbProvinciasData.unshift(opcionBlanco);

                    $('select[name="cmbIdProvincia'+context+'"]').html ('').select2({ data: cmbProvinciasData });
                    reiniciarComboPaciente( 'cmbIdDistrito'+context );
                    reiniciarComboPaciente( 'cmbIdCentroPoblado'+context );

                    // Seleccionar provincia
                    $('select[name="cmbIdProvincia'+context+'"]').val( ubiprov).trigger('change');
                    $('select[name="cmbIdProvincia'+context+'"]').select2();

                    // Cargar distritos
                    $.ajax({
                        data: {service: 'getDistritosData', idProvincia: ubiprov },
                        url: urlControles,
                        type:  'GET', dataType: 'json',
                        success:  function (cmbDistritosData) {
                            cmbDistritosData.unshift(opcionBlanco);

                            $('select[name="cmbIdDistrito'+context+'"]').html ('').select2({ data: cmbDistritosData });
                            reiniciarComboPaciente( 'cmbIdCentroPoblado'+context );

                            // Seleccionar distrito
                            $('select[name="cmbIdDistrito'+context+'"]').val( ubidis).trigger('change');
                            $('select[name="cmbIdDistrito'+context+'"]').select2();

                            // Cargar centros poblados
                            $.ajax({
                                data: {service: 'getCentrosPobladosData', idDistrito: ubidis },
                                url: urlControles,
                                type:  'GET', dataType: 'json',
                                success:  function (cmbCentrosPobladosData)
                                {
                                    cmbCentrosPobladosData.unshift(opcionBlanco);
                                    $('select[name="cmbIdCentroPoblado'+context+'"]').html ('').select2({ data: cmbCentrosPobladosData });
                                    // Seleccionar centro poblado
                                    $('select[name="cmbIdCentroPoblado'+context+'"]').val( ubicentrop).trigger('change');
                                    console.log('select[name="cmbIdCentroPoblado'+context+'"]', "Ubigeo: ", ubicentrop);
                                }
                            });
                        }
                    });
                }
            });
        }
    });
}

function cargarComboDepartamentos(context )
{
    var idPais = $('select[name="cmbIdPais'+context+'"]').val(); // 166 = PERU
    if( idPais == 166)
    {
        $.ajax({
            data: {service: 'getDepartamentosData'},
            url: urlControles,
            type:  'GET', dataType: 'json',
            success:  function (cmbDepartamentoData)
            {
                // Cargar combo departamento, del contexto
                cmbDepartamentoData.unshift(opcionBlanco);
                $('select[name="cmbIdDepartamento'+context+'"]').html ('').select2({ data: cmbDepartamentoData });
                reiniciarComboPaciente( 'cmbIdProvincia'+context );
                reiniciarComboPaciente( 'cmbIdDistrito'+context );
                reiniciarComboPaciente( 'cmbIdCentroPoblado'+context );
            }
        });
    }else
    {
        reiniciarComboPaciente( 'cmbIdDepartamento'+context );
        reiniciarComboPaciente( 'cmbIdProvincia'+context );
        reiniciarComboPaciente( 'cmbIdDistrito'+context );
        reiniciarComboPaciente( 'cmbIdCentroPoblado'+context );
    }
}

function cargarComboProvincias(context )
{
    var idDepartamento = $('select[name="cmbIdDepartamento'+context+'"]').val();
    if( idDepartamento != '')
    {
        $.ajax({
            data: {service: 'getProvinciasData', idDepartamento: idDepartamento },
            url: urlControles,
            type:  'GET', dataType: 'json',
            success:  function (cmbProvinciasData) {
                cmbProvinciasData.unshift(opcionBlanco);

                $('select[name="cmbIdProvincia'+context+'"]').html ('').select2({ data: cmbProvinciasData });
                reiniciarComboPaciente( 'cmbIdDistrito'+context );
                reiniciarComboPaciente( 'cmbIdCentroPoblado'+context);
            }
        });
    }else{
        reiniciarComboPaciente( 'cmbIdProvincia'+context );
    }
}

function cargarComboDistritos(context )
{
    var idProvincia = $('select[name="cmbIdProvincia'+context+'"]').val();
    console.log("COMBO PROVINCIA DEL idProvincia", idProvincia, 'select[name="cmbIdProvincia'+context+'"]');

    if( idProvincia != '')
    {
        $.ajax({
            data: {service: 'getDistritosData', idProvincia: idProvincia },
            url: urlControles,
            type:  'GET', dataType: 'json',
            success:  function (cmbDistritosData) {
                cmbDistritosData.unshift(opcionBlanco);

                $('select[name="cmbIdDistrito'+context+'"]').html ('').select2({ data: cmbDistritosData });
                reiniciarComboPaciente( 'cmbIdCentroPoblado'+context );
            }
        });
    }else{
        reiniciarComboPaciente( 'cmbIdDistrito'+context );
    }
}

function cargarComboCentrosPoblados(context )
{
    var idDistrito = $('select[name="cmbIdDistrito'+context+'"]').val();
    if( idDistrito != ''){
        $.ajax({
            data: {service: 'getCentrosPobladosData', idDistrito: idDistrito },
            url: urlControles,
            type:  'GET', dataType: 'json',
            success:  function (cmbCentrosPobladosData) {
                cmbCentrosPobladosData.unshift(opcionBlanco);
                $('select[name="cmbIdCentroPoblado'+context+'"]').html ('').select2({ data: cmbCentrosPobladosData });
            }
        });
    }else{
        reiniciarComboPaciente( 'cmbIdCentroPoblado'+context );
    }
}

function reiniciarComboPaciente(nombreCombo )
{
    let cmbData = [opcionBlanco];
    // Agregar opción de vacío y aplicar plugin select2
    $('select[name="'+nombreCombo+'"]').html ('').select2({ data: cmbData });
}

function getEdadPaciente(fechaNacimiento )
{
    $.ajax({
        data: {'fechaNacimiento': fechaNacimiento }, url: url+'/api/service?name=getEdad',
        type:  'GET', dataType: 'json',
        success:  function (response) {
            $("input[name='txtEdadActual']").val( response.edad );
        },
    });
}

function desactivarHistoriaFechaPaciente(state )
{
    $('input[name="txtIdNroHistoria"]').val('');
    $('input[name="txtIdNroHistoria"]').prop('readonly', state);
    $('input[name="txtFechaCreacion"]').val(dateHTML);
    $('input[name="txtFechaCreacion"]').prop('readonly', state);
}

function validarFiltroBusquedaPaciente()
{
    dni = $.trim( $('input[name="ftxtDni"]').val() );
    historia = $.trim( $('input[name="ftxtNroHistoria"]').val() );
    aPaterno = $.trim( $('input[name="ftxtApellidoPaterno"]').val() );
    aMaterno = $.trim( $('input[name="ftxtApellidoMaterno"]').val() );
    ficha1 = $.trim( $('input[name="ftxtFichaFamiliar1"]').val() );
    ficha2 = $.trim( $('input[name="ftxtFichaFamiliar2"]').val() );
    ficha3 = $.trim( $('input[name="ftxtFichaFamiliar3"]').val() );

    errors = [];
    if ( (aPaterno== "" && aMaterno == ""  && historia == "" && dni == "") && (ficha1 == "" && ficha2 == "" && ficha3 == "") )
    {
        toastr.error("Por favor ingrese algunos de los filtros (Ap. Paterno ,Ap. Materno, DNI, Ficha Familiar o Nro Historia)", "Error");
        return false;
    }else
    {
        if (historia == "" && dni == "" && (ficha1 == "" && ficha2 == "" && ficha3 == "") )
        {
            if (aPaterno == "")
            {
                toastr.error("Por favor ingrese Ap. Paterno", "Error");
                return false;
            }
        }
    }
    return true;
}

function listarPaciente(pagina=1)
{
    if( validarFiltroBusquedaPaciente() )
    {
        params  = $('#paciente-form-search').serialize();
        params += "&page="+pagina+"&origen=citas";

        $.ajax({
            data: params, url: urlPaciente,
            type:  'GET', dataType: 'html',
            beforeSend: function() {
                $('.paciente-tbody').html('<tr> <td colspan="12" class="text-center"> <i class="text-blue fa fa-refresh fa-spin"></i> buscando... </td> </tr>');
            },
            success:  function (response)
            {
                $('.paciente-table').html(response);

                $('.paciente-paginator .pagination a').click( function (e) {
                    e.preventDefault();
                    $('.firma-paginator li').removeClass('active');
                    $(this).parent('.firma-paginator li').addClass('active');
                    let page=$(this).attr('href').split('page=')[1];
                    listarPaciente(page);
                })

                $('.paciente-btn-seleccionar').click( function (e) {
                    e.preventDefault();
                    id = $(this).siblings('input').val();
                    form_editPaciente(id);
                });
            }
        });
    }
}

function desactivarBusquedaPaciente(estado)
{
    if(estado)
    {
        $('#paciente-form-search').trigger("reset");
        $(".paciente-paginator").html("");
        $('.paciente-tbody').html('<tr> <td colspan="12" class="text-center"> Sin resultados </td> </tr>');
    }
    $("input[name=ftxtDni]").prop('readonly', estado);
    $("input[name=ftxtNroHistoria]").prop('readonly', estado);
    $("input[name=ftxtApellidoPaterno]").prop('readonly', estado);
    $("input[name=ftxtApellidoMaterno]").prop('readonly', estado);
    $("#paciente-btn-search").attr('disabled', estado);
    $("#paciente-btn-add").attr('disabled', estado);

}

function form_editPaciente(idPaciente)
{
    // Desactivar campos de busqueda de historias

    desactivarBusquedaPaciente(true);
    desactivarFormPaciente( false );
    loadPacienteData(idPaciente, 'EDIT');
    getCitasAnteriores(idPaciente);
}

function openModalCrudPaciente(accion, idPaciente = 0)
{
    accion = accion.toUpperCase();
    CONFIG_IDPACIENTE = idPaciente;

    $('#accion-paciente').val(accion);
    $('a[href="#tab_docmicilio"]').tab('show');

    btn_name = '';
    btn_class = '';

    switch (accion)
    {
        case 'CREATE'   :  { btn_class = 'btn-primary'; btn_name = 'GUARDAR'; visible = true; } break;
        case 'EDIT'     :  { btn_class = 'btn-success'; btn_name = 'ACTUALIZAR'; visible = true; } break;
        case 'DELETE'   :  { btn_class = 'btn-danger'; btn_name = 'ELIMINAR'; visible = true; } break;
        case 'SHOW'     :  { btn_class = 'btn-default'; btn_name = ''; visible = false; } break;
        case 'CANCEL'   :  { btn_class = 'btn-default'; btn_name = ''; visible = false; } break;
    };

    $('.btn-save').removeClass(['btn-primary', 'btn-default', 'btn-danger', 'btn-success']).addClass([btn_class]).html(btn_name);
    visible ? $('.btn-save').show() : $('.btn-save').hide();
}

function loadPacienteData(idPaciente, operacion)
{
    $.ajax({
        data: {}, url: urlPaciente+'/'+idPaciente+'/edit',
        type:  'GET', dataType: 'json',
        success:  function (response)
        {
            paciente = response.paciente;

            switch (operacion)
            {
                case 'SHOW': openModalCrudPaciente('SHOW', paciente.IdPaciente); break;
                case 'EDIT': openModalCrudPaciente('EDIT', paciente.IdPaciente); break;
                case 'DELETE': openModalCrudPaciente('DELETE', paciente.IdPaciente); break;
            }

            // PACIENTE
            $('select[name="cmbIdDocIdentidad"]').val( paciente.IdDocIdentidad ).trigger('change');
            $('select[name="cmbIdDocIdentidad"]').prop('disabled', true);
            $('input[name="txtNroDocumento"]').val( paciente.NroDocumento );
            $('input[name="txtNroDocumento"]').prop('readonly', true);
            $('input[name="txtFechaCreacion"]').val( paciente.FechaCreacion );
            $('select[name="cmbIdTipoGenHistoriaClinica"]').val( paciente.IdTipoNumeracion ).trigger('change');
            $('select[name="cmbIdTipoGenHistoriaClinica"]').prop('disabled', true)
            $('input[name="tipoNumeracionAnterior"]').val( paciente.IdTipoGenHistoriaClinica_tag);
            $('input[name="txtIdNroHistoria"]').val( paciente.NroHistoriaClinica );

            //-- Datos del paciente
            $('input[name="txtApellidoPaterno"]').val( paciente.ApellidoPaterno);
            $('input[name="txtApellidoMaterno"]').val( paciente.ApellidoMaterno );
            $('input[name="txtPrimerNombre"]').val( paciente.PrimerNombre );
            $('input[name="txtSegundoNombre"]').val( paciente.SegundoNombre );
            $('input[name="txtTercerNombre"]').val( paciente.TercerNombre );
            $('input[name="txtFechaNacimiento"]').val( paciente.FechaNacimiento );
            $('select[name="cmbIdTipoSexo"]').val( paciente.IdTipoSexo ).trigger('change');
            $('input[name="txtNroHijo"]').val( paciente.NroOrdenHijo );
            $('select[name="cmbEtnia"]').val( paciente.IdEtnia ).trigger('change');
            $('select[name="cmbIdIdioma"]').val( paciente.IdIdioma ).trigger('change');
            $('textarea[name="txtObservacion"]').val( paciente.Observacion );
            $('select[name="cmbIdEstadoCivil"]').val( paciente.IdEstadoCivil ).trigger('change');
            $('input[name="txtIdPaciente"]').val( paciente.IdPaciente );
            $('input[name="txtIdPaciente"]').prop('readonly', true);
            $('select[name="cmbIdGradoInstruccion"]').val( paciente.IdGradoInstruccion ).trigger('change');
            $('input[name="txtEdadActual"]').val( paciente.Edad );
            $('input[name="txtTelefono"]').val( paciente.Telefono );
            $('select[name="cmbIdProcedencia"]').val( paciente.IdProcedencia ).trigger('change');
            $('select[name="cmbIdTipoOcupacion"]').val( paciente.IdTipoOcupacion ).trigger('change');
            $('input[name="txtEmail"]').val( paciente.Email );
            $('input[name="txtNombrePadre"]').val( paciente.NombrePadre );
            $('#imagenPacientePreview').attr('src', paciente.imagenPaciente );
            $('#imagenPacientePreview').attr('title', paciente.IdPaciente+'.PNG' );

            //-- Datos de la madre o tutor
            $('select[name="cmbMadreTipoDocumento"]').val( paciente.madreTipoDocumento ).trigger('change');
            $('input[name="txtMadreDocumento"]').val( paciente.madreDocumento);
            $('input[name="txtMadreApellidoP"]').val( paciente.madreApellidoPaterno);
            $('input[name="txtMadreApellidoM"]').val( paciente.madreApellidoMaterno);
            $('input[name="txtMadreNombre"]').val( paciente.madrePrimerNombre);
            $('input[name="txtMadreSnombre"]').val( paciente.madreSegundoNombre);

            //-- Ubigeo
            $('select[name="cmbIdPaisDomicilio"]').val (paciente.IdPaisDomicilio).trigger('change');
            paciente.IdPaisProcedencia = (paciente.IdPaisProcedencia==null || paciente.IdPaisProcedencia == undefined) ? '166':paciente.IdPaisProcedencia;
            $('select[name="cmbIdPaisProcedencia"]').val(paciente.IdPaisProcedencia).trigger('change');
            paciente.IdPaisNacimiento = (paciente.IdPaisNacimiento==null || paciente.IdPaisNacimiento == undefined) ? '166':paciente.IdPaisNacimiento;
            $('select[name="cmbIdPaisNacimiento"]').val(paciente.IdPaisNacimiento).trigger('change');
            verificarUbigeoParaCargarCombos(paciente.IdDistritoDomicilio, 'Domicilio', paciente.IdCentroPobladoDomicilio);
            verificarUbigeoParaCargarCombos(paciente.IdDistritoProcedencia, 'Procedencia', paciente.IdCentroPobladoProcedencia);
            verificarUbigeoParaCargarCombos(paciente.IdDistritoNacimiento, 'Nacimiento', paciente.IdCentroPobladoNacimiento);
            $('input[name="txtDireccionDomicilio"]').val( paciente.DireccionDomicilio );
        }
    });
}

function verificarUbigeoParaCargarCombos(IdDistrito, context, ubicentrop="")
{
    var ubigeoDistrito = IdDistrito;
    var ubigeoProvincia = "";
    var ubigeoDepartamento = "";

    if (ubigeoDistrito != null || ubigeoDistrito != undefined)
    {
        if(ubigeoDistrito.length==5)
        {
            ubigeoProvincia     = ubigeoDistrito.substr(0,3);
            ubigeoDepartamento  = ubigeoProvincia.substr(0,1);
        }
        else
        {
            ubigeoProvincia     = ubigeoDistrito.substr(0,4);
            ubigeoDepartamento  = ubigeoProvincia.substr(0,2);
        }

        cargarCombosAnidadosPaciente(ubigeoDepartamento, ubigeoProvincia, ubigeoDistrito, ubicentrop, context);
    }
    else
    {
        reiniciarComboPaciente( 'cmbIdDepartamento'+context );
        reiniciarComboPaciente( 'cmbIdProvincia'+context );
        reiniciarComboPaciente( 'cmbIdDistrito'+context );
        reiniciarComboPaciente( 'cmbIdCentroPoblado'+context );
        $('select[name="cmbIdPais'+context+'"]').trigger('change');

    }
}

// *********************************************************************************************************************
// *************************************************** CITAS ***********************************************************
// *********************************************************************************************************************

function desactivarFormCita(status = false)
{
    // Deshabilitar todos los INPUT existentes
    $('#cita-form-div input').each( function() { $(this).prop('readonly', status) });
    $('#cita-form-div button').each( function() { $(this).prop('disabled', status) });
    $('#cita-form-div select').each( function() { $(this).prop('disabled', status) });

    // Siempre desactivados
    $("select[name=cita_cmbIdTipoServicio]").prop("disabled", true);
    $("select[name=cita_cmbIdEspecialidad]").prop("disabled", true);
    $("select[name=cita_cmbIdServicio]").prop("disabled", true);
    $("input[name=cita_txtFecha]").prop("disabled", true);
    $("input[name=cita_txtHoraInicio]").prop("disabled", true);
    $("input[name=cita_txtHoraFin]").prop("disabled", true);
    $("input[name=cita_txtMedico]").prop("readonly", true);
    $("input[name=cita_txtEdad]").prop("readonly", true);
    $("select[name=cita_cmbIdTipoEdad]").prop("disabled", true);
    $("input[name=cita_txtCodigoEstablecimiento]").prop("readonly", true);
    $("input[name=cita_txtNombreEstablecimiento]").prop("readonly", true);
    $("input[name=cita_txtNroCuenta]").prop("readonly", true);
    $("input[name=cita_txtOrdenPago]").prop("readonly", true);
    $("input[name=cita_txtNroReferencia]").prop("readonly", true);
    $("select[name=cita_cmbIdOrigenReferencia]").prop("disabled", true);
}

function puedeAgregarseCita()
{
    $.ajax({
        data: {fecha: fechaSeleccion}, url: url + '/api/service?name=puedeAgregarse',
        type: 'GET', dataType: 'json',
        success: function (data)
        {
            if(data.estado == false)
            {
                toastr.error("No puede registrar CITAS de días menores a: "+data.mensaje);
                return;
            }
            
            formCreate();
        }
    });
}

function initEventosCita()
{
    // :: Botón crear <- Muestra el formulario para crear un paciente
    $("body").on('click', '.citas-admision-btn-create',function (e)
    {
        e.preventDefault();
        let info = JSON.parse($(this).attr("data-info"));
        $(".cita_nro_cita").html(info.nro_cita);
        $(".cita_nro_cita").attr('data-horainicio', info.hora_inicio);
        $(".cita_nro_cita").attr('data-horafin', info.hora_fin);
        puedeAgregarseCita();
    });

    // :: Botón cancelar
    $(".btn-cancel").click(function (e) {
        e.preventDefault();
        openModalCrud('CANCEL');
    });

    // :: Cada vez que cambia cita
    $("select[name=cita_cmbIdTipoReferencia]").change(function (e)
    {
        let valor = $("select[name=cita_cmbIdTipoReferencia]").select2("data")[0].id;
        let statusDesactivado = (valor==10);
        $("select[name=cita_cmbIdOrigenReferencia]").prop('disabled', statusDesactivado);
        $(".btn-establecimiento-buscar").prop('disabled', statusDesactivado);
        $(".btn-establecimiento-limpiar").prop('disabled', statusDesactivado);
        $("input[name=cita_txtNroReferencia]").prop('readonly', statusDesactivado);

        if(statusDesactivado)
        {
            $("select[name=cita_cmbIdOrigenReferencia]").val("").trigger('change');
            $("input[name=cita_txtCodigoEstablecimiento]").val("");
            $("input[name=cita_txtNombreEstablecimiento]").val("");
            $("input[name=cita_txtNroReferencia]").val("");
        }
    });

    // Cada vez que cambia fuente de financiamiento
    $("select[name=cita_cmbIdFuenteFinanciamiento]").change(function (e)
    {
        let valor = $("select[name=cita_cmbIdFuenteFinanciamiento]").val();
        console.log("Valor", valor);
        cargarComboTipoFinanciamientoCita(valor);
    });
}

function cargarCombosCita(desactivaForm = false)
{
    idServicio = $("select[name=cmbIdServicio]").val();
    idMedico = CONFIG_IDMEDICO;
    $.ajax({
        data: {idServicio, idMedico}, url: url+'/api/service?name=getCombosCita',
        type:  'GET', dataType: 'json',
        success:  function (data)
        {
            var form = data;

            // Cargar opcion vacio( "..." ) a los combos en el iniciob
            form.cmbIdTipoEdad.unshift(opcionBlanco);
            form.cmbIdFuenteFinanciamiento.unshift(opcionBlanco);
            form.cmbIdOrigenReferencia.unshift(opcionBlanco);

            // Mostrar informacion en los combos, y aplicar plugin select2
            $('select[name="cita_cmbIdTipoReferencia"]').select2({data: form.cmbIdTipoReferencia}).trigger('change');
            $('select[name="cita_cmbIdTipoEdad"]').select2({data: form.cmbIdTipoEdad}).trigger('change');
            $('select[name="cita_cmbIdTipoServicio"]').select2({data: form.cmbIdTipoServicio}).trigger('change');
            $('select[name="cita_cmbIdFuenteFinanciamiento"]').select2({data: form.cmbIdFuenteFinanciamiento}).trigger('change');
            $('select[name="cita_cmbIdEspecialidad"]').select2({data: form.cmbIdEspecialidad}).trigger('change');
            $('select[name="cita_cmbIdServicio"]').select2({data: form.cmbIdServicio}).trigger('change');
            $('select[name="cita_cmbIdOrigenReferencia"]').select2({data: form.cmbIdOrigenReferencia}).trigger('change');
            $('select[name="cita_cmbIdTipoConsulta"]').select2({data: form.cmbIdTipoConsulta}).trigger('change');

            // Medico
            let nombreMedico = "";
            if(form.medico != null)
            {
                nombreMedico+=form.medico.ApellidoPaterno + " " + form.medico.ApellidoMaterno + " " + form.medico.Nombres;
                nombreMedico+=" ("+form.medico.CodigoPlanilla+")";
            }
            $("input[name=cita_txtMedico]").val(nombreMedico);


            // Cargar otros datos
            $("input[name=cita_txtFecha]").val(fechaSeleccion);
            $("input[name=cita_txtHoraInicio]").val($(".cita_nro_cita").attr("data-horainicio"));
            $("input[name=cita_txtHoraFin]").val($(".cita_nro_cita").attr("data-horafin"));

            desactivarFormCita(desactivaForm);
        }
    });
}

function sleep(ms)
{
    return new Promise(resolve => setTimeout(resolve, ms));
}

function getCitasAnteriores(idPaciente)
{
    if(idPaciente != "")
    {
        $.ajax({
            data: {'idPaciente': idPaciente }, url: url+'/api/service?name=getCitasAnteriores',
            type:  'GET', dataType: 'json',
            success:  function (response)
            {
                if(response.estado == true)
                {
                    let filas = "";
                    let banderaPosterior = false;
                    let contadorPosterior = 0;
                    let datos = response.datos;
                    for(let i = 0; i<datos.length; i++)
                    {
                        if(datos[i].diasDiferencia>0)
                        {
                            banderaPosterior = true;
                            contadorPosterior += 1;
                        }

                        let estiloTexto = (datos[i].diasDiferencia>0)?"bg-danger":"";

                        filas+= "<tr class='"+estiloTexto+"'>";
                        filas+= "<td>" + datos[i].Fecha + "</td>";
                        filas+= "<td>" + datos[i].Consultorio + "</td>";
                        filas+= "<td>" + datos[i].Plan + "</td>";
                        filas+= "<td>" + datos[i].CE + "</td>";
                        filas+= "<td>" + datos[i].CS + "</td>";
                        filas+= "</tr>";
                    }

                    $("#paciente-consultas-anteriores").html("").append(filas);
                    mensajeConfirmacionCitaAnterior(contadorPosterior);
                }
                else
                {
                    toastr.error(response.mensaje, "Error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                if(jqXHR.status == 500)
                {
                    toastr.error("Hubo un problema al cargar los datos de citas anteriores del servidor, recargue la página e intente nuevamente");
                }
            }
        });
    }
}

async function mensajeConfirmacionCitaAnterior(contadorPosterior = 0)
{
    if(contadorPosterior>0)
    {
        await sleep(300);
        // Mostrar mensaje de advertencia, en caso existan citas en fechas posteriores
        let mensaje  = "Existen "+contadorPosterior +" CITAS mayores a HOY del PACIENTE elegido \n";
        mensaje     += "(color ROJO en la LISTA superior derecha de la ventana actual) \n";
        mensaje     += "¿Desea continuar? \n";
        if(!confirm(mensaje))
        {
            $('#paciente-btn-clear').click();
        }
    }
}


function formCreate()
{
    cargarCombosCita(false);
    //initForm();
    openModalCrud('CREATE');
}

function openModalCrud(accion, IdCita = "")
{
    $('#form-citas-admision').toggle();
    $('#citas-listado').toggle();
    $('#accion-' + model).val(accion);
    $('#id-' + model).val(IdCita);

    btn_name = '';
    btn_class = '';

    switch (accion)
    {
        case 'CREATE'   :  { btn_class = 'btn-primary'; btn_name = 'GUARDAR'; visible = true; } break;
        case 'EDIT'     :  { btn_class = 'btn-success'; btn_name = 'ACTUALIZAR'; visible = true; } break;
        case 'DELETE'   :  { btn_class = 'btn-danger'; btn_name = 'ELIMINAR'; visible = true; } break;
        case 'SHOW'     :  { btn_class = 'btn-default'; btn_name = ''; visible = false; } break;
        case 'CANCEL'   :  { btn_class = 'btn-default'; btn_name = ''; visible = false; } break;
    };

    $('.btn-save').removeClass(['btn-primary', 'btn-default', 'btn-danger', 'btn-success']).addClass([btn_class]).html(btn_name);
    visible ? $('.btn-save').show() : $('.btn-save').hide();
}

function cargarComboTipoFinanciamientoCita(idFuenteFinanciamiento)
{
    $.ajax({
        data: {idFuenteFinanciamiento}, url: url+'/api/service?name=getTiposFinanciamiento',
        type:  'GET', dataType: 'json',
        success:  function (data)
        {
            data.unshift(opcionBlanco);
            $('select[name="cita_cmbIdProducto"]').html("").select2({data: data}).trigger('change');
        }
    });
}

function actionSave()
{

}

// *********************************************************************************************************************
// *********************************************** ESTABLECIMIENTO *****************************************************
// *********************************************************************************************************************
function initEventosEstablecimiento()
{
    $('#establecimiento-form-search').submit( function(e)
    {
        e.preventDefault();
        listarBusquedaEstablecimientos();
    });

    $("body").on("click", ".establecimiento-seleccionar", function(e)
    {
        e.preventDefault();
        let codigoEstablecimiento = $(this).attr("data-codigo");
        let nombre = $(this).attr("data-nombre");
        $("input[name=cita_txtCodigoEstablecimiento]").val(codigoEstablecimiento);
        $("input[name=cita_txtNombreEstablecimiento]").val(nombre);
        $("#modal_establecimiento").modal('toggle');
    });

    $("body").on("click", ".btn-establecimiento-limpiar", function (e)
    {
        e.preventDefault();
        $("input[name=cita_txtCodigoEstablecimiento]").val("");
        $("input[name=cita_txtNombreEstablecimiento]").val("");
    });

    $('#establecimiento-btn-clear').click( function(e)
    {
        e.preventDefault();
        $('#establecimiento-form-search').trigger("reset");
        $("select[name=establecimiento_cmbIdDepartamento]").trigger('change');
        $('.establecimiento-table tbody').html('<tr> <td colspan="6" class="text-center"> Sin resultados </td> </tr>');
    });


    // :: Modal ::
    $('#modal_establecimiento').on('show.bs.modal', function (e)
    {
        $('#establecimiento-btn-clear').click();
    });


}

function cargarCombosEstablecimiento()
{
    $.ajax({
        data: {}, url: url+'/api/service?name=getDepartamentos',
        type:  'GET', dataType: 'json',
        success:  function (data)
        {
            data.unshift(opcionBlanco);
            $('select[name="establecimiento_cmbIdDepartamento"]').select2({data: data}).trigger('change');
        }
    });
}


// Listar resultados de establecimiento
function listarBusquedaEstablecimientos()
{
    let idDepartamento = $('select[name="establecimiento_cmbIdDepartamento"]').val();
    let nombre = $("input[name=establecimiento_ftxNombre]").val();

    if(idDepartamento == "" && nombre == "")
    {
        toastr.error("Debe seleccionar un departamento, e indicar al menos un caracter en nombre", "Error");
        return;
    }

    $.ajax({
        data: {idDepartamento, nombre}, url: url+'/api/service?name=getEstablecimientos',
        type:  'GET', dataType: 'html',
        success:  function (data)
        {
            $('.establecimiento-table').html(data);
        }
    });
}
