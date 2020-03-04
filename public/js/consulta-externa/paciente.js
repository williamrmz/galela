var model   = "paciente";
var method  = "CREATE";
var urlBase = '';
var dataCmbPais = [];
var dateHTML = '';
var paciente = {};


$(document).ready(function()
{
    ajaxConfig();
    initEventos();
    initImageConfig();
    cargarCombosPaciente();

});

function initImageConfig()
{
    // Cuando el usuario carga una imagen
    $("#imagenPaciente").change(function()
    {
        readURLPaciente(this);
    });

    // Limpiar foto
    $("#imagenPacienteClear").click(function(e)
    {
        e.preventDefault();
        $('#imagenPaciente').val('');
        $("#foto_base64").val('');
        readURLPaciente(this);
    });
}


// Carga información inicial de combos, etc
function cargarCombosPaciente()
{
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
            $('select[name="cmbIdDocIdentidad"]').select2({data: form.cmbDocIdentidad});
            $('select[name="cmbIdTipoGenHistoriaClinica"]').select2({data: form.cmbTipoGenHistoriaClinica});
            $('select[name="cmbIdTipoSexo"]').select2({data: form.cmbTipoSexo});
            $('select[name="cmbEtnia"]').select2({data: form.cmbEtnia});
            $('select[name="cmbIdIdioma"]').select2({data: form.cmbIdioma});
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
            $('select[name="cmbPaisTitular"]').select2({data: form.cmbPais});
            $('select[name="cmbDocumentoTitular"]').select2({data: form.cmbDocIdentidad});
            $('select[name="cmbDocumentoTitular"]').val('').trigger('change');
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
                $('select[name="cmbIdPais'+contexto+'"]').html('').select2( {'data': dataCmbPais });
                $('select[name="cmbIdPais'+contexto+'"]').select2('val', '166');
            });

            $('select[name="cmbPaisTitular"]').val('166').trigger('change');
            $('select[name="cmbIdDocIdentidad"]').trigger('select2:select'); // Seleccionar DNI;
            $('select[name="cmbIdTipoSexo"]').val('1').trigger('select2:select'); // Seleccionar masculino
            $('select[name="cmbIdTipoGenHistoriaClinica"]').trigger('select2:select');

        }
    });
}

function initEventos()
{
    // Botón buscar
    $('#'+model+'-form-search').submit( function(e)
    {
        e.preventDefault();
        listarPaciente();
    });

    // Botón limpiar
    $('#'+model+'-btn-clear').click( function(e)
    {
        e.preventDefault();
        $('#'+model+'-form-search').trigger("reset");
        $(".paciente-paginator").html("");
        $('.'+model+'-tbody').html('<tr> <td colspan="12" class="text-center"> Sin resultados </td> </tr>');
    });

    // :: Botón crear <- Muestra el formulario para crear un paciente
    $('#'+model+'-btn-create').click( function (e)
    {
        e.preventDefault();
        form_create();
    });

    // :: Guarda o actualiza el registro del paciente
    $(".btn-save").click( function(e)
    {
        e.preventDefault();
        actionSave();
    });

    // :: Cerrar formulario de vista previa de datos
    $(".btn-cancel").click( function(e){
        e.preventDefault(); cancelForm();
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
        var valorComboSeleccionado = $('select[name="cmbIdTipoGenHistoriaClinica"]').select2('data')[0].id;

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
    $('input[name="txtFechaNacimiento"]').change( function(e)
    {
        getEdadPaciente( $(this).val()  );
        $('input[name="txtFnacimiento"]').val( $(this).val() );
    });
}

function actionSave()
{
    var urlTemp = url;
    form = $('#'+model+'-form');
    data = new FormData(form[0]);

    accion = $("#accion").val().toUpperCase();
    if ( accion == 'EDIT')
    {
        urlTemp += '/'+$('#idPaciente').val();
        data.append('_method', 'PUT');
    } else if ( accion == 'DELETE')
    {
        urlTemp += '/'+$('#idPaciente').val();
        data.append('_method', 'DELETE');
        data.append('cmbIdTipoGenHistoriaClinica', $('select[name="cmbIdTipoGenHistoriaClinica"]').val() );
    }

    $.ajax({
        data: data, url: urlTemp, contentType: false, cache: false, processData:false,
        type:  'POST', dataType: 'json',
        beforeSend: function(){
            $(".btn-cancel").addClass('disabled');
            $(".btn-save").addClass('disabled');
            $(".btn-save").html('<i class="fa fa-spinner fa-spin"></i> ESPERE');
        },
        success:  function (response)
        {
            if( response.estado)
            {
                toastr.success( response.mensaje, 'Correcto!');
                paciente = {};
                openModalCrudPaciente('CANCEL');
                $('#'+model+'-form-search').trigger("reset");
                $('.'+model+'-tbody').html('<tr> <td colspan="12" class="text-center"> Sin resultados </td> </tr>');
            }else
            {
                toastr.error( response.mensaje, 'Error');
            }

        },
        error: function (request, status, error) {
            showErrosValidator(request);
        },
        complete: function( jqXHR, textStatus ){
            $(".btn-cancel").removeClass('disabled');
            $(".btn-save").removeClass('disabled');
            $(".btn-save").html('GUARDAR');
        }
    });
}

function cancelForm()
{
    paciente = {};
    openModalCrudPaciente('CANCEL');
}

function testing()
{
    $("#ftxtDni").val("71068282");
    $('#paciente-form-search').trigger('submit');
}


function initFormPaciente()
{
    $('input[name="idPaciente"]').val('');
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

function desactivarHistoriaFechaPaciente(state )
{
    $('input[name="txtIdNroHistoria"]').val('');
    $('input[name="txtIdNroHistoria"]').prop('readonly', state);
    $('input[name="txtFechaCreacion"]').val(dateHTML);
    $('input[name="txtFechaCreacion"]').prop('readonly', state);
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

function reiniciarComboPaciente(nombreCombo )
{
    let cmbData = [opcionBlanco];
    // Agregar opción de vacío y aplicar plugin select2
    $('select[name="'+nombreCombo+'"]').html ('').select2({ data: cmbData });
}

function buscarPacientexDNI(dni)
{
    if(dni.length==8)
    {
        overlay_title = "&nbsp; Consultando en RENIEC";
        $.ajax({
            data: {'nro_documento': dni }, url: url+'/api/service?name=get_by_nro_documento',
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

function cargarCombosAnidadosPaciente(ubidep, ubiprov, ubidis, ubicentrop, context)
{
    // Cargar departamentos
    $.ajax({
        data: {},
        url: urlBase+'/controles?service=getDepartamentosData',
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
                url: urlBase+'/controles',
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
                        url: urlBase+'/controles',
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
                                url: urlBase+'/controles',
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
            data: {},
            url: urlBase+'/controles?service=getDepartamentosData',
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
            url: urlBase+'/controles',
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
            url: urlBase+'/controles',
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
            url: urlBase+'/controles',
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

// Muestra formulario de paciente / sunasa
function openModalCrudPaciente(accion, idPaciente = 0)
{
    accion = accion.toUpperCase();
    $('#accion').val(accion);
    $('#idPaciente').val(idPaciente);
    $('a[href="#tab_docmicilio"]').tab('show');
    $('#partial-list').toggle();
    $('#partial-crud').toggle();

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

// :: Cargar info pacientes a controles
function loadPacienteData(idPaciente, operacion)
{
    $.ajax({
        data: {}, url: url+'/'+idPaciente+'/edit',
        type:  'GET', dataType: 'json',
        success:  function (response)
        {
            paciente = response.paciente;
            let sunasa = response.sunasa;

            switch (operacion)
            {
                case 'SHOW': openModalCrudPaciente('SHOW', paciente.IdPaciente); break;
                case 'EDIT': openModalCrudPaciente('EDIT', paciente.IdPaciente); break;
                case 'DELETE': openModalCrudPaciente('DELETE', paciente.IdPaciente); break;
            }

            // PACIENTE
            $('select[name="cmbIdDocIdentidad"]').val( paciente.IdDocIdentidad ).trigger('change');
            $('input[name="txtNroDocumento"]').val( paciente.NroDocumento );
            $('input[name="txtFechaCreacion"]').val( paciente.FechaCreacion );
            $('select[name="cmbIdTipoGenHistoriaClinica"]').val( paciente.IdTipoNumeracion ).trigger('change');
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

// :: Formular: Crear
function form_create()
{
    paciente = {};
    initFormPaciente();
    desactivarFormPaciente( false );
    openModalCrudPaciente('CREATE');
}

// :: Formulario: Mostrar datos del paciente ::
function form_show(idPaciente )
{
    desactivarFormPaciente( true );
    loadPacienteData(idPaciente, 'SHOW');
}

// :: Formulario: Eliminar paciente ::
function form_delete(idPaciente)
{
    desactivarFormPaciente( true );
    loadPacienteData(idPaciente, 'DELETE');
}

// :: Formulario: Editar paciente ::
function form_edit(idPaciente)
{
    desactivarFormPaciente( false );
    loadPacienteData(idPaciente, 'EDIT');
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

function showErrosValidator(request)
{
    errors = request.responseJSON.errors;
    html = '<ul>';
    for (var key in errors) {
        html += "<li>" + key + ": " + errors[key] + "</li>";
    }
    html += '</ul>';
    toastr.error(html, 'Error')
}

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

// ::: METODOS PARA LISTAR :::

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
        params  = $('#'+model+'-form-search').serialize();
        params += "&page="+pagina;

        $.ajax({
            data: params, url: url,
            type:  'GET', dataType: 'html',
            beforeSend: function() {
                $('.'+model+'-tbody').html('<tr> <td colspan="12" class="text-center"> <i class="text-blue fa fa-refresh fa-spin"></i> buscando... </td> </tr>');
            },
            success:  function (response)
            {
                $('.'+model+'-table').html(response);

                $('.'+model+'-paginator .pagination a').click( function (e) {
                    e.preventDefault();
                    $('.firma-paginator li').removeClass('active');
                    $(this).parent('.firma-paginator li').addClass('active');
                    let page=$(this).attr('href').split('page=')[1];
                    listarPaciente(page);
                })

                $('.'+model+'-btn-edit').click( function (e) {
                    e.preventDefault();
                    id = $(this).siblings('input').val();
                    form_edit(id);
                });

                $('.'+model+'-btn-delete').click( function (e) {
                    e.preventDefault();
                    id = $(this).siblings('input').val();
                    form_delete(id);
                });

                $('.'+model+'-btn-show').click( function (e) {
                    e.preventDefault();
                    id = $(this).siblings('input').val();
                    form_show(id);
                });

            }
        });
    }
}