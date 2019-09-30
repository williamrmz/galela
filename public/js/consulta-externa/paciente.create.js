var model="paciente";

var urlBase = '';

var dataCmbPais = [];

var dateHTML = '';

var action = '';

$(function(){

    urlBase = $('meta[name="base-path"]').attr('content');
    optionNull = { id: '', text: '...' };

    $('#'+model+'-btn-store').click( function (e) {
        e.preventDefault();
        createItem();
    });

    $("#imagenPaciente").change(function() {
        readURL(this);
    });

    $("#imagenPacienteClear").click(function(e) {
        e.preventDefault();
        $('#imagenPaciente').val('');
        readURL(this);
    });

    if(  $(".current_action").val() == 'CREATE' ){
        enableFormSenasa( false );
    }
    
    


    setData();

    // trigger events
    eventManager();

});

function getPathCtrl()
{
    return $("input[name='"+model+"-path-ctrl']").val();
}

function eventManager()
{
    $('input[name="chkIgualQueDomicilio"]').change( function(){
        if( $(this).prop('checked') ){
            setCombosIgualDomicilio( 'Procedencia' );
        }else{
            initGruposCombos ( dataCmbPais, 'Procedencia');
        }
    });

    $('input[name="chkIgualQueDomicilioNac"]').change( function(){
        if( $(this).prop('checked') ){
            setCombosIgualDomicilio( 'Nacimiento' );
        }else{
            initGruposCombos ( dataCmbPais, 'Nacimiento');
        }
    });

    $('input[name="txtNroDocumento"]').keyup( function(e) {
        $('input[name="txtNdocumento"]').val( $(this).val() );
    });

    $('input[name="txtDireccionDomicilio"]').keyup( function(e) {
        $('input[name="txtUbigeo"]').val( $(this).val() );
    });

    $('input[name="txtFechaNacimiento"]').change( function(e) {
        console.log( $(this).val() );
        getEdad( $(this).val()  );

        $('input[name="txtFnacimiento"]').val( $(this).val() );
    });

    $('input[name="txtApellidoPaterno"]').keyup( e => writeFullname() );
    $('input[name="txtApellidoMaterno"]').keyup( e => writeFullname() );
    $('input[name="txtPrimerNombre"]').keyup( e => writeFullname() );
    $('input[name="txtSegundoNombre"]').keyup( e => writeFullname() );
    $('input[name="txtTercerNombre"]').keyup( e => writeFullname() );


    // SUNASA
    $('input[name="chkNuevoSeguro"]').change( function(e) {
        enableFormSenasa( $(this).prop('checked') );
    });

    $('input[name="chkNoTieneSeguro"]').change( function(e) {
        enableFormSenasa( !$(this).prop('checked') );
    });
    

    $(".btn-save").click( function(e){
        e.preventDefault(); saveItem();
    })
        
}

function enableFormSenasa( state )
{
    $('input[name="chkNuevoSeguro"]').prop('checked', state);
    $('input[name="chkNoTieneSeguro"]').prop('checked', !state);

    $('#forms-sunasa').find(':input').each(function( index, element ) {
        if( !(element.name == 'txtFnacimiento' || element.name == 'txtUbigeo' || element.name == 'txtNroAfiliacion1'
            ||element.name == 'txtCodEstablecIAFA' || element.name == 'txtCodEstablecRENAES') )
        {
            if( element.type == 'select-one'){
                $('select[name="'+element.name+'"]').val('');
                $('select[name="'+element.name+'"]').select2().trigger('change');
                $('select[name="'+element.name+'"]').attr('disabled', !state);
            }

            if( element.type == 'text' || element.type == 'date' || element.type == 'time'){

                if( element.name !== 'txtCodEstablecIAFA' && element.name !== 'txtCodEstablecRENAES' 
                    && element.name !== 'txtNroAfiliacion1' && element.name !== 'txtFnacimiento' && element.name !== 'txtUbigeo' ){
                    $('input[name="'+element.name+'"]').val('');
                    $('input[name="'+element.name+'"]').attr('disabled', !state);
                }
                
            }
        }
    });
}

function writeFullname(){
    let fullname = $('input[name="txtApellidoPaterno"]').val();
    fullname += ' ' + $('input[name="txtApellidoMaterno"]').val();
    fullname += ' ' + $('input[name="txtPrimerNombre"]').val();
    fullname += ' ' + $('input[name="txtSegundoNombre"]').val();
    fullname += ' ' + $('input[name="txtTercerNombre"]').val();
    $('input[name="txtPaciente"]').val( fullname.trim() );
}


function setData()
{
    $.ajax({
        data: {}, url: getPathCtrl()+'/api/service?name=getData',
        type:  'GET', dataType: 'json',
        success:  function (data) {
            console.log( data );

            var form = data.forms;
            var item = data.item;
            // console.log(data);
            dateHTML = form.dateHTML;
            // data.cmbDocIdentidad.unshift(optionNull);
            // data.cmbTipoGenHistoriaClinica.unshift(optionNull);
            form.cmbTipoSexo.unshift(optionNull);
            form.cmbEtnia.unshift(optionNull);
            form.cmbIdioma.unshift(optionNull);
            form.cmbEstadoCivil.unshift(optionNull);
            form.cmbGradoInstruccion.unshift(optionNull);
            form.cmbProcedencia.unshift(optionNull);
            form.cmbTipoOcupacion.unshift(optionNull);

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


            form.cmbParentescoTitular.unshift(optionNull);
            form.cmbRegimen.unshift(optionNull);
            form.cmbTipoAfiliacion.unshift(optionNull);
            form.cmbValidacionRegIden.unshift(optionNull);
            form.cmbEstadoSeguro.unshift(optionNull);
            form.cmbTipoOperacion.unshift(optionNull);


            $('select[name="cmbParentescoTitular"]').select2({data: form.cmbParentescoTitular});
            $('select[name="cmbDocumentoAnterior"]').select2({data: form.cmbDocIdentidad});
            $('select[name="cmbPaisTitular"]').select2({data: form.cmbPais});
            $('select[name="cmbDocumentoTitular"]').select2({data: form.cmbDocIdentidad});
            $('select[name="cmbRegimen"]').select2({data: form.cmbRegimen});
            $('select[name="cmbTipoAfiliacion"]').select2({data: form.cmbTipoAfiliacion});
            $('select[name="cmbValidacionRegIden"]').select2({data: form.cmbValidacionRegIden});
            $('select[name="cmbEstadoSeguro"]').select2({data: form.cmbEstadoSeguro});
            $('select[name="cmbSepelioSexo"]').select2({data: form.cmbTipoSexo});
            $('select[name="cmbTipoOperacion"]').select2({data: form.cmbTipoOperacion});


            dataCmbPais = form.cmbPais;
            initGruposCombos ( dataCmbPais, 'Domicilio');
            initGruposCombos ( dataCmbPais, 'Procedencia');
            initGruposCombos ( dataCmbPais, 'Nacimiento');

            // trigger events
            $('input[name="txtDocumento"]').val( $('select[name="cmbIdDocIndentidad"]').select2('data')[0].Descripcion );
            $('select[name="cmbIdDocIndentidad"]').on('select2:select', function (e) {
                $('input[name="txtDocumento"]').val( e.params.data.Descripcion );
            });

            $('input[name="txtSexo"]').val( $('select[name="cmbIdTipoSexo"]').select2('data')[0].text );
            $('select[name="cmbIdTipoSexo"]').on('select2:select', function (e) {
                $('input[name="txtSexo"]').val( e.params.data.Descripcion );
            });

            disableHistoriaAndFecha( true );
            $('select[name="cmbIdTipoGenHistoriaClinica"]').on('select2:select', function (e) {
                if( e.params.data.id == 2) { // HISTORIA 'MANUAL'
                    disableHistoriaAndFecha( false );
                }else{
                    disableHistoriaAndFecha( true );
                }
            });

        }
    });
}

function disableHistoriaAndFecha( state )
{
    $('input[name="txtNumeroHistoria"]').val('');
    $('input[name="txtNumeroHistoria"]').prop('readonly', state);
    $('input[name="txtFechaCreacion"]').val(dateHTML);
    $('input[name="txtFechaCreacion"]').prop('readonly', state);
}

function setCombosIgualDomicilio( context )
{
    dataPais = $('select[name="cmbIdPaisDomicilio').find(':selected')[0];
    dataDepartamento = $('select[name="cmbIdDepartamentoDomicilio').find(':selected')[0];
    dataProvincia = $('select[name="cmbIdProvinciaDomicilio').find(':selected')[0];
    dataDistrito = $('select[name="cmbIdDistritoDomicilio').find(':selected')[0];
    dataCentroPoblado = $('select[name="cmbIdCentroPobladoDomicilio').find(':selected')[0];

    optionPais = [ {id: dataPais.value, 'text': dataPais.innerHTML } ];
    optionDepartamento = [ {id: dataDepartamento.value, 'text': dataDepartamento.innerHTML } ];
    optionProvincia = [ {id: dataProvincia.value, 'text': dataProvincia.innerHTML } ];
    optionDistrito = [ {id: dataDistrito.value, 'text': dataDistrito.innerHTML } ];
    optionCentroPoblado= [ {id: dataCentroPoblado.value, 'text': dataCentroPoblado.innerHTML } ];

    $('select[name="cmbIdPais'+context).html('').select2({ data: optionPais });
    $('select[name="cmbIdDepartamento'+context).html('').select2({ data: optionDepartamento });
    $('select[name="cmbIdProvincia'+context).html('').select2({ data: optionProvincia });
    $('select[name="cmbIdDistrito'+context).html('').select2({ data: optionDistrito });
    $('select[name="cmbIdCentroPoblado'+context).html('').select2({ data: optionCentroPoblado });

    // console.log(optionPais);
    // console.log(optionDepartamento);
    // console.log(optionProvincia);
    // console.log(optionDistrito);
    // console.log(optionCentroPoblado);
}

function resetCombo( classSelector )
{
    let cmbData = [];
    cmbData.unshift(optionNull);
    $('select[name="'+classSelector+'"]').html ('').select2({ data: cmbData });
}

function initGruposCombos( dataPais, context )
{
    $('select[name="cmbIdPais'+context+'"]').select2({data: dataPais});
    $('select[name="cmbIdPais'+context+'"]').val( 166 );
    $('select[name="cmbIdPais'+context+'"]').select2().trigger('change');

    cargarComboDepartamentos( 166, context );
    $('select[name="cmbIdPais'+context+'"]').change( function () {
        cargarComboDepartamentos( $(this).val(), context );
    });

    // trigger events
    if( context == 'Domicilio' ){
        $('input[name="txtPais"]').val( $('select[name="cmbIdPaisDomicilio"]').select2('data')[0].text );
        $('select[name="cmbIdPaisDomicilio"]').on('select2:select', function (e) {
            $('input[name="txtPais"]').val( e.params.data.text );
        });
    }

}

function cargarComboDepartamentos( idPais, context )
{
    if( idPais == 166){//PERU
        $.ajax({
            data: {}, 
            url: urlBase+'/controles?service=getDepartamentosData',
            type:  'GET', dataType: 'json',
            success:  function (cmbDepartamentoData) {

                cmbDepartamentoData.unshift(optionNull);

                $('select[name="cmbIdDepartamento'+context+'"]').html ('').select2({ data: cmbDepartamentoData });
                resetCombo( 'cmbIdProvincia'+context );
                resetCombo( 'cmbIdDistrito'+context );
                resetCombo( 'cmbIdCentroPoblado'+context );

                $('select[name="cmbIdDepartamento'+context+'"]').change( function () {
                    cargarComboProvincias( $(this).val(), context );
                });

            }
        });
    }else{
        resetCombo( 'cmbIdDepartamento'+context );
        resetCombo( 'cmbIdProvincia'+context );
        resetCombo( 'cmbIdDistrito'+context );
        resetCombo( 'cmbIdCentroPoblado'+context );
    }
}

function cargarComboProvincias( idDepartamento, context )
{
    if( idDepartamento != ''){
        $.ajax({
            data: {service: 'getProvinciasData', idDepartamento: idDepartamento }, 
            url: urlBase+'/controles',
            type:  'GET', dataType: 'json',
            success:  function (cmbProvinciasData) {
                cmbProvinciasData.unshift(optionNull);

                $('select[name="cmbIdProvincia'+context+'"]').html ('').select2({ data: cmbProvinciasData });
                resetCombo( 'cmbIdDistrito'+context );
                resetCombo( 'cmbIdCentroPoblado'+context );
    
                $('select[name="cmbIdProvincia'+context+'"]').change( function () {
                    cargarComboDistritos( $(this).val(), context );
                });
            }
        });
    }else{
        resetCombo( 'cmbIdProvincia'+context );
    }
}

function cargarComboDistritos( idProvincia, context )
{
    if( idProvincia != ''){
        $.ajax({
            data: {service: 'getDistritosData', idProvincia: idProvincia }, 
            url: urlBase+'/controles',
            type:  'GET', dataType: 'json',
            success:  function (cmbDistritosData) {
                cmbDistritosData.unshift(optionNull);

                $('select[name="cmbIdDistrito'+context+'"]').html ('').select2({ data: cmbDistritosData });
                resetCombo( 'cmbIdCentroPoblado'+context );
    
                $('select[name="cmbIdDistrito'+context+'"]').change( function () {
                    cargarComboCentrosPoblados( $(this).val(), context );
                });
            }
        });
    }else{
        resetCombo( 'cmbIdDistrito'+context );
    }
}

function cargarComboCentrosPoblados( idDistrito, context )
{
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
        resetCombo( 'cmbIdCentroPoblado'+context );
    }
}

function createItem()
{
    
    let url = getPathCtrl();

    $.ajax({
        data: {}, url: url+'/create',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $('#myModalTitle').html('Crear '+model);
            $('#myModalSize').addClass('modal-lg'); //options: '', 'modal-lg'
            $('#myModalBody').html(response);
            
            $('#'+model+'-form').submit( function (e) {
                e.preventDefault();
                storeItem();
            });

            $('#myModal').modal('show');
        }
    });
}

function saveItem()
{
    params = $('#'+model+'-form').serialize();

    url = getPathCtrl();

    form = $('#'+model+'-form');

    data = new FormData(  form[0] );

    $.ajax({
        data: data, url: url, contentType: false, cache: false, processData:false,
        type:  'POST', dataType: 'json',
        success:  function (response) {

            if( response.success){
                console.log('redirect to...');
            }else{
                toastr.error( response.message, 'Error');
            }
            
        },
        error: function (request, status, error) {
            showErrosValidator(request);
        }
    });
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


function readURL(input) {
    var url = input.value;

    if( typeof url !== 'undefined'){
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
  
  

