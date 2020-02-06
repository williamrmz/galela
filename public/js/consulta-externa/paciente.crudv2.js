var model   = "paciente";
var method  = "CREATE";
var urlBase = '';
var dataCmbPais = [];
var dateHTML = '';
var paciente = {};
var optionNull = "";

$(document).ready(function()
{
    initModuleConfig();
    initEventos();
    initImageConfig();
    initCargarCombos();

});

function initModuleConfig()
{
    urlBase     = $('meta[name="base-path"]').attr('content');
    optionNull  = { id: '', text: '...' };

    testing();
}

function cargarParametros(codigoParametro)
{
    $.ajax({
        data: {}, url: urlRoot+'/api/getParametroByCodigo/'+codigoParametro,
        type:  'GET', dataType: 'json',
        success:  function (data)
        {
            switch (codigoParametro)
            {
                case 'CODIGO': $('input[name="txtCodEstablecIAFA"]').val(data.ValorTexto); break;
                case 'COD RENAES': $('input[name="txtCodEstablecRENAES"]').val(data.ValorTexto); break;
                case 'CODIGO_DISA': $('input[name="txtNroAfiliacion1"]').val(data.ValorTexto); break;
            }
        }
    });
}

function initImageConfig()
{
    // Cuando el usuario carga una imagen
    $("#imagenPaciente").change(function()
    {
        readURL(this);
    });

    // Limpiar foto
    $("#imagenPacienteClear").click(function(e)
    {
        e.preventDefault();
        $('#imagenPaciente').val('');
        $("#foto_base64").val('');
        readURL(this);
    });
}


// Carga información inicial de combos, etc
function initCargarCombos()
{
    $.ajax({
        data: {}, url: getPathCtrl()+'/api/service?name=getData',
        type:  'GET', dataType: 'json',
        success:  function (data)
        {

            var form = data.forms;
            dateHTML = form.dateHTML;

            // Cargar opcion vacio( "..." ) a los combos en el inicio
            form.cmbTipoSexo.unshift(optionNull);
            form.cmbEtnia.unshift(optionNull);
            form.cmbIdioma.unshift(optionNull);
            form.cmbEstadoCivil.unshift(optionNull);
            form.cmbGradoInstruccion.unshift(optionNull);
            form.cmbProcedencia.unshift(optionNull);
            form.cmbTipoOcupacion.unshift(optionNull);


            // Mostrar informacion en los combos, y aplicar plugin select2
            $('select[name="cmbIdDocIndentidad"]').select2({data: form.cmbDocIdentidad});
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
            form.cmbParentescoTitular.unshift(optionNull);
            form.cmbRegimen.unshift(optionNull);
            form.cmbTipoAfiliacion.unshift(optionNull);
            form.cmbValidacionRegIden.unshift(optionNull);
            form.cmbEstadoSeguro.unshift(optionNull);
            form.cmbTipoOperacion.unshift(optionNull);

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
            $('select[name="cmbIdDocIndentidad"]').trigger('select2:select'); // Seleccionar DNI;
            $('select[name="cmbIdTipoSexo"]').val('1').trigger('select2:select'); // Seleccionar masculino
            $('select[name="cmbIdTipoGenHistoriaClinica"]').trigger('select2:select');

        }
    });
}

function initEventos()
{
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
        e.preventDefault(); cancelItem();
    });

    // :: Buscar en RENIEC
    $("input[name='txtNroDocumento']").focusout(function ()
    {
        var tipoDoc = $('select[name="cmbIdDocIndentidad"]').val();
        if (tipoDoc=="1")
        {
            var dni = $('input[name="txtNroDocumento"]').val();
            buscarPacientexDNI(dni);
        }
    });


    // :: txtdocumento <- SUNASA description ::
    $('select[name="cmbIdDocIndentidad"]').on('select2:select', function (e)
    {
        var valorComboSeleccionado = $('select[name="cmbIdDocIndentidad"]').select2('data')[0].Descripcion;
        console.log("VALOR: ",valorComboSeleccionado);
        $('input[name="txtDocumento"]').val(valorComboSeleccionado)
    });

    // :: txtSexo <- SUNASA description ::
    $('select[name="cmbIdTipoSexo"]').on('select2:select', function (e)
    {
        var valorComboSeleccionado = $('select[name="cmbIdTipoSexo"]').select2('data')[0].Descripcion;
        $('input[name="txtSexo"]').val(valorComboSeleccionado);
    });

    // :: Bloquear campos de fecha e historia en caso la historia es manual
    $('select[name="cmbIdTipoGenHistoriaClinica"]').on('select2:select', function (e)
    {
        var valorComboSeleccionado = $('select[name="cmbIdTipoGenHistoriaClinica"]').select2('data')[0].id;

        if( valorComboSeleccionado == 2)
        {
            disableHistoriaAndFecha( false );
        }else
        {
            disableHistoriaAndFecha( true );
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
        igualarCombos('Procedencia');
    });

    $('#btnIgualQueDomicilioN').click( function(e)
    {
        e.preventDefault();
        igualarCombos('Nacimiento');
    });

    // :: Copia nro documento a pestaña SUNADA mientras se teclea
    $('input[name="txtNroDocumento"]').keyup( function(e)
    {
        $('input[name="txtNdocumento"]').val( $(this).val() );
    });

    // :: Copia direccion a pestaña SUNASA mientras se teclea
    $('input[name="txtDireccionDomicilio"]').keyup( function(e) {
        $('input[name="txtUbigeo"]').val( $(this).val() );
    });

    // :: Cuando cambie fecha de nacimiento, calcular edad
    $('input[name="txtFechaNacimiento"]').change( function(e)
    {
        getEdad( $(this).val()  );
        $('input[name="txtFnacimiento"]').val( $(this).val() );
    });

    // :: Cada vez que se escriba el nombre llama al método writeFullName para SUNASA
    $('input[name="txtApellidoPaterno"]').keyup( e => writeFullname() );
    $('input[name="txtApellidoMaterno"]').keyup( e => writeFullname() );
    $('input[name="txtPrimerNombre"]').keyup( e => writeFullname() );
    $('input[name="txtSegundoNombre"]').keyup( e => writeFullname() );
    $('input[name="txtTercerNombre"]').keyup( e => writeFullname() );

    // :: Evento mostrar u ocultar formulario de SUNASA
    $('input[type=checkbox][name=chkNuevoSeguroSunasa]').change( function(e)
    {
        var sunasaActivo = this.checked;
        desactivarFormSunasa(!sunasaActivo);
    });

    $('input[type=checkbox][name=chkSinSeguroSunasa]').change( function(e)
    {
        var sunasaInactivo = this.checked;
        desactivarFormSunasa(sunasaInactivo);
    });
}

function actionSave()
{
    url = getPathCtrl();
    form = $('#'+model+'-form');
    data = new FormData(form[0]);

    accion = $("#accion").val().toUpperCase();
    if ( accion == 'EDIT')
    {
        url += '/'+$('#idPaciente').val();
        data.append('_method', 'PUT');
    } else if ( accion == 'DELETE')
    {
        url += '/'+$('#idPaciente').val();
        data.append('_method', 'DELETE');
        data.append('cmbIdTipoGenHistoriaClinica', $('select[name="cmbIdTipoGenHistoriaClinica"]').val() );
    }

    $.ajax({
        data: data, url: url, contentType: false, cache: false, processData:false,
        type:  'POST', dataType: 'json',
        beforeSend: function(){
            $(".btn-cancel").addClass('disabled');
            $(".btn-save").addClass('disabled');
            $(".btn-save").html('<i class="fa fa-spinner fa-spin"></i> ESPERE');
        },
        success:  function (response) {
            if( response.success)
            {
                toastr.success( response.message, 'Correcto!');
                paciente = {};

                // if( accion == 'EDIT') showListItems();

                openModalCrud('CANCEL');
                // showListItems();
                $('#'+model+'-form-search').trigger("reset");

                $('.'+model+'-tbody').html('<tr> <td colspan="12" class="text-center"> Sin resultados </td> </tr>');
            }else{
                toastr.error( response.message, 'Error');
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

function cancelItem()
{
    paciente = {};
    openModalCrud('CANCEL');
}

function testing()
{
    $("#ftxtDni").val("71068282");
    $('#paciente-form-search').trigger('submit');
}

function getPathCtrl()
{
    return $("input[name='"+model+"-path-ctrl']").val();
}

function writeFullname(){
    let fullname = $('input[name="txtApellidoPaterno"]').val();
    fullname += ' ' + $('input[name="txtApellidoMaterno"]').val();
    fullname += ' ' + $('input[name="txtPrimerNombre"]').val();
    fullname += ' ' + $('input[name="txtSegundoNombre"]').val();
    fullname += ' ' + $('input[name="txtTercerNombre"]').val();
    $('input[name="txtPaciente"]').val( fullname.trim() );
}


function resetForm()
{
    $('input[name="idPaciente"]').val('');
    $('input[name="accion"]').val('CANCEL');
    $('input[name="tipoNumeracionAnterior"]').val('');
    $('input[name="idSunasaPacienteHistorico"]').val('');
    $('input[name="yaNoTieneSeguroUltimoRegistroGrabado"]').val('');
    // PACIENTE
    //-- Datos de la Historia Clinica
    $('select[name="cmbIdDocIndentidad"]').val(1).trigger('change');
    $('input[name="txtNroDocumento"]').val('');
    $('input[name="txtFechaCreacion"]').val('');

    $('select[name="cmbIdTipoGenHistoriaClinica"]').val(1).trigger('change');
    $('input[name="txtIdNroHistoria"]').val('');
    //-- Datos del paciente
    $('input[name="txtApellidoPaterno"]').val('');
    $('input[name="txtApellidoMaterno"]').val('');
    $('input[name="txtPrimerNombre"]').val('');
    $('input[name="txtSegundoNombre"]').val('');
    $('input[name="txtTercerNombre"]').val('');
    $('input[name="txtFechaNacimiento"]').val('');
    $('select[name="cmbIdTipoSexo"]').val('').trigger('change');
    $('input[name="txtNroHijo"]').val('');
    $('select[name="cmbEtnia"]').val('').trigger('change');
    $('select[name="cmbIdIdioma"]').val('').trigger('change');
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
    readURL($('input[name="imagenPaciente"]').val(''));
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

    //SUNASA
    //-- info
    $('input[name="txtPaciente"]').val('');
    $('input[name="txtSexo"]').val('');
    $('input[name="txtDocumento"]').val('');
    $('input[name="txtNdocumento"]').val('');
    $('input[name="txtPais"]').val('Perú');
    $("#input[name='chkSinSeguroSunasa']").prop("checked", true);

    //-- Datos del paciente (Asegurado)
    $('input[name="txtApellidoCasada"]').val('');
    $('select[name="cmbParentescoTitular"]').val('').trigger('change');
    $('select[name="cmbDocumentoAnterior"]').val('').trigger('change');
    $('input[name="txtNroDocumentoAnterior"]').val('');
    $('input[name="txtFnacimiento"]').val('');
    $('input[name="txtUbigeo"]').val('');
    //-- Datos del titular
    $('select[name="cmbPaisTitular"]').val('166').trigger('change');
    $('select[name="cmbDocumentoTitular"]').val('1').trigger('change');
    $('input[name="txtNdocumentoTitular"]').val('');
    //-- Datos del seguro
    $('select[name="cmbRegimen"]').val('').trigger('change');
    $('input[name="txtNroAfiliacion1"]').val('-');
    $('input[name="txtNroAfiliacion2"]').val('');
    $('input[name="txtNroAfiliacion3"]').val('');
    $('input[name="txtCodEstablecIAFA"]').val('');
    $('input[name="txtProductoPlan1"]').val('');
    $('input[name="txtProductoPlan2"]').val('');
    $('select[name="cmbTipoAfiliacion"]').val('').trigger('change');
    $('input[name="txtCodEstablecRENAES"]').val('');
    $('input[name="txtFechaInicioAfiliacion"]').val('');
    $('input[name="txtFechaFinalAfiliacion"]').val('');
    $('input[name="txtCarnetIdentidad"]').val('');
    $('input[name="txtRUCempleador"]').val('');
    $('select[name="cmbValidacionRegIden"]').val('').trigger('change');
    $('input[name="txtCodigoIAFA"]').val('');
    $('select[name="cmbEstadoSeguro"]').val('').trigger('change');

    //-- Datos del encargado del sepelio (Asegurado)
    $('input[name="txtSepelioApellidosYnombre"]').val('');
    $('input[name="txtSepelioFnacimiento"]').val('');
    $('input[name="txtSpelioDNI"]').val('');
    $('select[name="cmbSepelioSexo"]').val('').trigger('change');
    //-- #
    $('input[name="txtDNIUsuario"]').val('');
    $('select[name="cmbTipoOperacion"]').val('').trigger('change');
    $('input[name="txtFechaEnvio"]').val('');
    $('input[name="txtHoraEnvio"]').val('');

    // Campos siempre desactivados
    $('input[name="txtPaciente"]').prop('readonly', true);
    $('input[name="txtSexo"]').prop('readonly', true);
    $('input[name="txtDocumento"]').prop('readonly', true);
    $('input[name="txtPais"]').prop('readonly', true);
    $('input[name="txtNdocumento"]').prop('readonly', true);
    $('input[name="txtFnacimiento"]').prop('readonly', true);
    $('input[name="txtUbigeo"]').prop('readonly', true);
    $('input[name="txtNroAfiliacion1"]').prop('readonly', true);
    $('input[name="txtCodEstablecIAFA"]').prop('readonly', true);
    $('input[name="txtCodEstablecRENAES"]').prop('readonly', true);

    // Inicializar campos
    cargarParametros("CODIGO");
    cargarParametros("COD RENAES");
    cargarParametros("CODIGO_DISA");

    // Eventos a llamar
    $('select[name="cmbIdDocIndentidad"]').trigger('select2:select'); // Seleccionar DNI;
    $('select[name="cmbIdTipoSexo"]').val('1').trigger('change').trigger('select2:select'); // Seleccionar masculino
    $('select[name="cmbIdTipoGenHistoriaClinica"]').val('1').trigger('select2:select');
}

function disableHistoriaAndFecha( state )
{
    $('input[name="txtIdNroHistoria"]').val('');
    $('input[name="txtIdNroHistoria"]').prop('readonly', state);
    $('input[name="txtFechaCreacion"]').val(dateHTML);
    $('input[name="txtFechaCreacion"]').prop('readonly', state);
}

function igualarCombos(context )
{
    idPaisDomicilio = $('select[name="cmbIdPaisDomicilio').val();
    idDepartamentoDomicilio = $('select[name="cmbIdDepartamentoDomicilio').val();
    idProvinciaDomicilio = $('select[name="cmbIdProvinciaDomicilio').val();
    idDistritoDomicilio = $('select[name="cmbIdDistritoDomicilio').val();
    idCentroPobladoDomicilio = $('select[name="cmbIdCentroPobladoDomicilio').val();

    $('select[name="cmbIdPais'+context).val(idPaisDomicilio).trigger('change');
    cargarCombosAnidados(idDepartamentoDomicilio, idProvinciaDomicilio, idDistritoDomicilio, idCentroPobladoDomicilio,context);
}

function reiniciarCombo(nombreCombo )
{
    let cmbData = [optionNull];
    // Agregar opción de vacío y aplicar plugin select2
    $('select[name="'+nombreCombo+'"]').html ('').select2({ data: cmbData });
}

function buscarPacientexDNI(dni)
{
    if(dni.length==8)
    {
        $.ajax({
            data: {'nro_documento': dni }, url: getPathCtrl()+'/api/service?name=get_by_nro_documento',
            type:  'GET', dataType: 'json',
            success:  function (response)
            {
                if(response.IdPaciente!=null || response.IdPaciente!=undefined)
                {
                    nombreCompleto = $.trim(response.ApellidoPaterno)+" "+$.trim(response.ApellidoMaterno)+" "+$.trim(response.PrimerNombre);
                    toastr.error( response.message, 'El nro. documento ya se encuentra registrado para el paciente '+nombreCompleto);
                    $("input[name='txtNroDocumento']").val("");
                    resetForm();
                    return;
                }


                $('input[name="txtDocumento"]').val( $('select[name="cmbIdDocIndentidad"]').select2('data')[0].Descripcion );
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

                // Generar nombre completo del paciente
                writeFullname();


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

        cargarCombosAnidados(ubigeoDepartamento, ubigeoProvincia, ubigeoDistrito, ubicentrop, context);
    }
    else
    {
        reiniciarCombo( 'cmbIdDepartamento'+context );
        reiniciarCombo( 'cmbIdProvincia'+context );
        reiniciarCombo( 'cmbIdDistrito'+context );
        reiniciarCombo( 'cmbIdCentroPoblado'+context );
        $('select[name="cmbIdPais'+context+'"]').trigger('change');

    }
}

function cargarCombosAnidados(ubidep, ubiprov, ubidis, ubicentrop, context)
{
    // Cargar departamentos
    $.ajax({
        data: {},
        url: urlBase+'/controles?service=getDepartamentosData',
        type:  'GET', dataType: 'json',
        success:  function (cmbDepartamentoData)
        {
            cmbDepartamentoData.unshift(optionNull);
            $('select[name="cmbIdDepartamento'+context+'"]').html ('').select2({ data: cmbDepartamentoData });
            reiniciarCombo( 'cmbIdProvincia'+context );
            reiniciarCombo( 'cmbIdDistrito'+context );
            reiniciarCombo( 'cmbIdCentroPoblado'+context );

            // Seleccionar departamento
            $('select[name="cmbIdDepartamento'+context+'"').val( ubidep).trigger('change');

            // Cargar provincias
            $.ajax({
                data: {service: 'getProvinciasData', idDepartamento: ubidep },
                url: urlBase+'/controles',
                type:  'GET', dataType: 'json',
                success:  function (cmbProvinciasData) {
                    cmbProvinciasData.unshift(optionNull);

                    $('select[name="cmbIdProvincia'+context+'"]').html ('').select2({ data: cmbProvinciasData });
                    reiniciarCombo( 'cmbIdDistrito'+context );
                    reiniciarCombo( 'cmbIdCentroPoblado'+context );

                    // Seleccionar provincia
                    $('select[name="cmbIdProvincia'+context+'"]').val( ubiprov).trigger('change');
                    $('select[name="cmbIdProvincia'+context+'"]').select2();

                    // Cargar distritos
                    $.ajax({
                        data: {service: 'getDistritosData', idProvincia: ubiprov },
                        url: urlBase+'/controles',
                        type:  'GET', dataType: 'json',
                        success:  function (cmbDistritosData) {
                            cmbDistritosData.unshift(optionNull);

                            $('select[name="cmbIdDistrito'+context+'"]').html ('').select2({ data: cmbDistritosData });
                            reiniciarCombo( 'cmbIdCentroPoblado'+context );

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
                                    cmbCentrosPobladosData.unshift(optionNull);
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
                cmbDepartamentoData.unshift(optionNull);
                $('select[name="cmbIdDepartamento'+context+'"]').html ('').select2({ data: cmbDepartamentoData });
                reiniciarCombo( 'cmbIdProvincia'+context );
                reiniciarCombo( 'cmbIdDistrito'+context );
                reiniciarCombo( 'cmbIdCentroPoblado'+context );
            }
        });
    }else
    {
        reiniciarCombo( 'cmbIdDepartamento'+context );
        reiniciarCombo( 'cmbIdProvincia'+context );
        reiniciarCombo( 'cmbIdDistrito'+context );
        reiniciarCombo( 'cmbIdCentroPoblado'+context );
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
                cmbProvinciasData.unshift(optionNull);

                $('select[name="cmbIdProvincia'+context+'"]').html ('').select2({ data: cmbProvinciasData });
                reiniciarCombo( 'cmbIdDistrito'+context );
                reiniciarCombo( 'cmbIdCentroPoblado'+context);
            }
        });
    }else{
        reiniciarCombo( 'cmbIdProvincia'+context );
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
                cmbDistritosData.unshift(optionNull);

                $('select[name="cmbIdDistrito'+context+'"]').html ('').select2({ data: cmbDistritosData });
                reiniciarCombo( 'cmbIdCentroPoblado'+context );
            }
        });
    }else{
        reiniciarCombo( 'cmbIdDistrito'+context );
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
                cmbCentrosPobladosData.unshift(optionNull);
                $('select[name="cmbIdCentroPoblado'+context+'"]').html ('').select2({ data: cmbCentrosPobladosData });
            }
        });
    }else{
        reiniciarCombo( 'cmbIdCentroPoblado'+context );
    }
}

// Muestra formulario de paciente / sunasa
function openModalCrud(accion, idPaciente = 0)
{
    accion = accion.toUpperCase();
    $('#accion').val(accion);
    $('#idPaciente').val(idPaciente);

    $('a[href="#tab_paciente"]').tab('show');
    $('a[href="#tab_docmicilio"]').tab('show');
    $('#partial-list').toggle();
    $('#partial-crud').toggle();

    btn_name = '';
    btn_class = '';

    if( accion == 'CREATE' ) {
        
        btn_class = 'btn-primary';
        btn_name = 'GUARDAR';
        visible = true;
    }

    if( accion == 'EDIT' ) {
        btn_class = 'btn-success';
        btn_name = 'ACTUALIZAR';
        visible = true;
    }

    if( accion == 'DELETE' ) {
        btn_class = 'btn-danger';
        btn_name = 'ELIMINAR';
        visible = true;
    }

    if( accion == 'SHOW' ) {
        btn_class = 'btn-default';
        btn_name = 'SHOW';
        visible = false;
    }

    if( accion == 'CANCEL' )
    {
        btn_class = 'btn-success';
        btn_name = 'CANCEL';
        visible = false;
    }
    $('.btn-save').removeClass( ['btn-primary', 'btn-default', 'btn-danger', 'btn-success'] ).addClass( [btn_class] ).html( btn_name);
    visible? $('.btn-save').show(): $('.btn-save').hide();
}

// :: Cargar info pacientes a controles
function loadPacienteData(idPaciente, operacion)
{
    $.ajax({
        data: {}, url: getPathCtrl()+'/'+idPaciente+'/edit',
        type:  'GET', dataType: 'json',
        success:  function (response)
        {
            paciente = response.paciente;
            let sunasa = response.sunasa;

            switch (operacion)
            {
                case 'SHOW': openModalCrud('SHOW', paciente.IdPaciente); break;
                case 'EDIT': openModalCrud('EDIT', paciente.IdPaciente); break;
                case 'DELETE': openModalCrud('DELETE', paciente.IdPaciente); break;
            }

            // PACIENTE
            $('select[name="cmbIdDocIndentidad"]').val( paciente.IdDocIdentidad ).trigger('change');
            $('input[name="txtNroDocumento"]').val( paciente.NroDocumento );
            $('select[name="cmbIdTipoGenHistoriaClinica"]').val( paciente.IdTipoNumeracion ).trigger('change');
            $('input[name="tipoNumeracionAnterior"]').val( paciente.IdTipoGenHistoriaClinica_tag);
            $('input[name="txtIdNroHistoria"]').val( paciente.NroHistoriaClinica );
            $('input[name="txtFechaCreacion"]').val( paciente.FechaCreacion );

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



            // SUNASA
            let txtPaciente = $.trim(paciente.ApellidoPaterno) + ' ' + $.trim(paciente.ApellidoMaterno) + ' ' +
                $.trim(paciente.PrimerNombre) + ' '+$.trim(paciente.SegundoNombre) + ' '+ $.trim(paciente.TercerNombre);
            $('input[name="txtPaciente"]').val( txtPaciente );
            $('input[name="txtSexo"]').val( $('select[name="cmbIdTipoSexo"]').select2('data')[0].text );
            $('input[name="txtDocumento"]').val( $('select[name="cmbIdDocIndentidad"]').select2('data')[0].text );
            $('input[name="txtNdocumento"]').val( $('input[name="txtNroDocumento"]').val() );
            $('input[name="txtPais"]').val( $('select[name="cmbIdPaisDomicilio"]').select2('data')[0].text );

            if( sunasa != null)
            {
                $('input[name="chkNuevoSeguroSunasa"]').prop('checked', false);
                $('input[name="chkSinSeguroSunasa"]').prop('checked', sunasa.YaNoTieneSeguroUltimoRegistroGrabado);

                $('input[name="idSunasaPacienteHistorico"]').val( sunasa.idSunasaPacienteHistorico );
                $('input[name="yaNoTieneSeguroUltimoRegistroGrabado"]').val( sunasa.YaNoTieneSeguroUltimoRegistroGrabado );

                //-- Datos del paciente (Asegurado)
                $('input[name="txtApellidoCasada"]').val( sunasa.ApellidoCasada);
                $('select[name="cmbParentescoTitular"]').val( sunasa.idParentesco ).trigger('change');
                $('select[name="cmbDocumentoAnterior"]').val( sunasa.AnteriorIdTipoDocumentoAsegurado ).trigger('change');
                $('input[name="txtNroDocumentoAnterior"]').val( sunasa.AnteriorNroDocumentoAsegurado );
                $('input[name="txtFnacimiento"]').val( $('input[name="txtFechaNacimiento"]').val() );
                $('input[name="txtUbigeo"]').val( $('input[name="txtDireccionDomicilio"]').val() );
                //-- Datos del titular
                $('select[name="cmbPaisTitular"]').val( sunasa.idPaisTitular ).trigger('change');
                $('select[name="cmbDocumentoTitular"]').val( sunasa.idTipoDocumentoTitular ).trigger('change');
                $('input[name="txtNdocumentoTitular"]').val(sunasa.NroDocumentoTitular );
                //-- Datos del seguro
                $('select[name="cmbRegimen"]').val( sunasa.idRegimen ).trigger('change');
                $('input[name="txtNroAfiliacion1"]').val( sunasa.NroAfiliacion1 );
                $('input[name="txtNroAfiliacion2"]').val( sunasa.NroAfiliacion2 );
                $('input[name="txtNroAfiliacion3"]').val( sunasa.NroAfiliacion3 );
                $('input[name="txtProductoPlan1"]').val( sunasa.ProductoPlan1 );
                $('input[name="txtProductoPlan2"]').val( sunasa.ProductoPlan1 );
                $('select[name="cmbTipoAfiliacion"]').val( sunasa.IdAfiliacion ).trigger('change');
                $('input[name="txtFechaInicioAfiliacion"]').val( sunasa.FechaInicioAfiliacion );
                $('input[name="txtFechaFinalAfiliacion"]').val( sunasa.FechaFinalAfiliacion );
                $('input[name="txtRUCempleador"]').val(sunasa.RUCempleador );
                $('select[name="cmbValidacionRegIden"]').val( sunasa.idRegimen ).trigger('change');
                $('input[name="txtCodigoIAFA"]').val( sunasa.CodigoIAFA );
                $('input[name="txtCodEstablecIAFA"]').val( sunasa.CodigoEstablecimientoIAFA );
                $('input[name="txtCodEstablecRENAES"]').val( sunasa.CodigoEstablecimientoRENAES );
                $('input[name="txtCarnetIdentidad"]').val( sunasa.NroCarnetIdentidad );
                $('select[name="cmbEstadoSeguro"]').val( sunasa.EstadoDelSeguro ).trigger('change');

                //-- Datos del encargado del sepelio (Asegurado)
                $('input[name="txtSepelioApellidosYnombre"]').val( sunasa.SisSepelioParienteEncargado );
                $('input[name="txtSepelioFnacimiento"]').val( sunasa.SisSepelioFnacimiento );
                $('input[name="txtSpelioDNI"]').val( sunasa.SisSepelioDni);
                $('select[name="cmbSepelioSexo"]').val( sunasa.SisSepelioSexo ).trigger('change');
                //-- #
                $('input[name="txtDNIUsuario"]').val( sunasa.DNIusarioOperacion );
                $('select[name="cmbTipoOperacion"]').val( sunasa.idOperacion ).trigger('change');
                $('input[name="txtFechaEnvio"]').val( sunasa.FechaEnvio );
                $('input[name="txtHoraEnvio"]').val( sunasa.HoraEnvio );

            }
        }
    });
}

// :: Formular: Crear
function form_create()
{
    paciente = {};
    resetForm();
    desactivarFormPaciente( false );
    desactivarFormSunasa( true );
    openModalCrud('CREATE');
}

// :: Formulario: Mostrar datos del paciente ::
function form_show(idPaciente )
{
    desactivarFormPaciente( true );
    desactivarFormSunasa( true );
    loadPacienteData(idPaciente, 'SHOW');
}

// :: Formulario: Eliminar paciente ::
function form_delete(idPaciente)
{
    desactivarFormPaciente( true );
    desactivarFormSunasa( true );
    loadPacienteData(idPaciente, 'DELETE');
}

// :: Formulario: Editar paciente ::
function form_edit(idPaciente)
{
    desactivarFormPaciente( false );
    desactivarFormSunasa( true );
    loadPacienteData(idPaciente, 'EDIT');
}

function desactivarFormPaciente(status = false)
{
    // Deshabilitar todos los elementos select afectados por el plugin Select2
    $('#tab_paciente .select2-hidden-accessible').each( function() { $(this).prop('disabled', status) });

    // Deshabilitar todos los INPUT existentes
    $('#tab_paciente  input').each( function() { $(this).prop('readonly', status) });

    // Ocultar los botoenes de carga de imagen
    status? $('label[for="imagenPaciente"]').hide(): $('label[for="imagenPaciente"]').show();
    status? $('#imagenPacienteClear').hide(): $('#imagenPacienteClear').show();

    if(!status)
    {
        $('select[name="cmbIdTipoGenHistoriaClinica"]').trigger('select2:select');
    }
}

function desactivarFormSunasa(status = false)
{
    $("input[name='chkNuevoSeguroSunasa']").prop("checked", !status);
    $("input[name='chkSinSeguroSunasa']").prop("checked", status);

    // desabilitar todos los select 2
    $('#tab_sunasa .select2-hidden-accessible').each( function() { $(this).prop('disabled', status) });

    // desabilita inputs
    $('#tab_sunasa  input').each( function() { $(this).prop('readonly', status) });

    // INPUTS SIEMPRE DESACTIVADOS
    $('input[name="txtPaciente"]').prop('readonly', true);
    $('input[name="txtSexo"]').prop('readonly', true);
    $('input[name="txtDocumento"]').prop('readonly', true);
    $('input[name="txtPais"]').prop('readonly', true);
    $('input[name="txtNdocumento"]').prop('readonly', true);
    $('input[name="txtFnacimiento"]').prop('readonly', true);
    $('input[name="txtUbigeo"]').prop('readonly', true);
    $('input[name="txtNroAfiliacion1"]').prop('readonly', true);
    $('input[name="txtCodEstablecIAFA"]').prop('readonly', true);
    $('input[name="txtCodEstablecRENAES"]').prop('readonly', true);
}

function getEdad( fechaNacimiento )
{
    $.ajax({
        data: {'fechaNacimiento': fechaNacimiento }, url: getPathCtrl()+'/api/service?name=getEdad',
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

function readURL(input)
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
  
  

