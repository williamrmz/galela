var model="paciente";

var urlBase = '';

var dataCmbPais = [];

var dateHTML = '';

var action = '';

var paciente = {};

var departamentosData = [];
var provinciasData = [];
var distritosData = [];
var centrosPoblados = [];

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
    });

    $(".btn-cancel").click( function(e){
        e.preventDefault(); cancelItem();
    });
        
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
            $('select[name="cmbPaisTitular"]').val('166').trigger('change');
            $('select[name="cmbDocumentoTitular"]').select2({data: form.cmbDocIdentidad});
            $('select[name="cmbDocumentoTitular"]').val('').trigger('change');
            $('select[name="cmbRegimen"]').select2({data: form.cmbRegimen});
            $('select[name="cmbTipoAfiliacion"]').select2({data: form.cmbTipoAfiliacion});
            $('select[name="cmbValidacionRegIden"]').select2({data: form.cmbValidacionRegIden});
            $('select[name="cmbEstadoSeguro"]').select2({data: form.cmbEstadoSeguro});
            $('select[name="cmbSepelioSexo"]').select2({data: form.cmbTipoSexo});
            $('select[name="cmbTipoOperacion"]').select2({data: form.cmbTipoOperacion});

            dataCmbPais = form.cmbPais;



            setCombosEventos ( dataCmbPais, 'Domicilio');

            // initGruposCombos ( dataCmbPais, 'Domicilio');
            // initGruposCombos ( dataCmbPais, 'Procedencia');
            // initGruposCombos ( dataCmbPais, 'Nacimiento');

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


function resetForm()
{
    // PACIENTE
    //-- Datos de la Historia Clinica
    $('select[name="cmbIdDocIndentidad"').val(1).trigger('change');
    $('input[name="txtNroDocumento"]').val('');
    $('select[name="cmbIdTipoGenHistoriaClinica"').val(1).trigger('change');
    $('input[name="tipoNumeracionAnterior"]').val('');
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
    readURL( $('input[name="imagenPaciente"]').val('') );
    //-- Datos de la madre o tutor
    $('select[name="cmbMadreTipoDocumento"]').val('1').trigger('change');
    $('input[name="txtMadreDocumento"]').val('');
    $('input[name="txtMadreApellidoP"]').val('');
    $('input[name="txtMadreApellidoM"]').val('');
    $('input[name="txtMadreNombre"]').val('');
    $('input[name="txtMadreSnombre"]').val('');
    //-- Ubigeo
    $('select[name="cmbIdPaisDomicilio"]').val('166').trigger('change');
    $('input[name="chkIgualQueDomicilio"]').prop('checked', false);
    $('select[name="cmbIdPaisProcedencia"]').val('166').trigger('change');
    $('input[name="chkIgualQueDomicilioNac"]').prop('checked', false);
    $('select[name="cmbIdPaisNacimiento"]').val('166').trigger('change');
    $('input[name="txtDireccionDomicilio"]').val('');

    //SUNASA
    //-- info
    $('input[name="txtPaciente"]').val('');
    $('input[name="txtSexo"]').val('');
    $('input[name="txtDocumento"]').val('');
    $('input[name="txtNdocumento"]').val('');
    $('input[name="txtPais"]').val('Peru');
    $('input[name="chkNuevoSeguro"]').prop('checked', false);
    $('input[name="chkNoTieneSeguro"]').val('checked', true);
    $('input[name="yaNoTieneSeguroUltimoRegistroGrabado"]').val('');
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
    $('input[name="txtNroAfiliacion1"]').val('19');
    $('input[name="txtNroAfiliacion2"]').val('');
    $('input[name="txtNroAfiliacion3"]').val('');
    $('input[name="txtProductoPlan1"]').val('');
    $('input[name="txtProductoPlan2"]').val('');
    $('select[name="cmbTipoAfiliacion"]').val('').trigger('change');
    $('input[name="txtFechaInicioAfiliacion"]').val('');
    $('input[name="txtFechaFinalAfiliacion"]').val('');
    $('input[name="txtRUCempleador"]').val('');
    $('select[name="cmbValidacionRegIden"]').val('').trigger('change');
    $('input[name="txtCodigoIAFA"]').val('');
    $('input[name="txtCodEstablecIAFA"]').val('');
    $('input[name="txtCodEstablecRENAES"]').val('');
    $('input[name="txtCarnetIdentidad"]').val('');
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
}

function setPaciente()
{

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
    $('select[name="cmbIdPais'+context+'"]').val( 166 ).trigger('change');

    cargarComboDepartamentos( 166, context );
    $('select[name="cmbIdPais'+context+'"]').off('change');
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

                
                if( typeof paciente['IdDepartamento'+context] !== 'undefined'){ // para seleccionar automaticamente los combos anidados
                    $('select[name="cmbIdDepartamento'+context+'"]').val( paciente['IdDepartamento'+context] ).trigger( 'change' );
                }

                $('select[name="cmbIdDepartamento'+context+'"]').off('change');
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

                if( typeof paciente['IdProvincia'+context] !== 'undefined'){ // para seleccionar automaticamente los combos anidados
                    $('select[name="cmbIdProvincia'+context+'"]').val( paciente['IdProvincia'+context] ).trigger( 'change' );
                }

                $('select[name="cmbIdProvincia'+context+'"]').off('change');
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

                if( typeof paciente['IdDistrito'+context] !== 'undefined'){ // para seleccionar automaticamente los combos anidados
                    $('select[name="cmbIdDistrito'+context+'"]').val( paciente['IdDistrito'+context] ).trigger( 'change' );
                    console.log( 'seleccionando distrito');
                }

                $('select[name="cmbIdDistrito'+context+'"]').off('change');
                $('select[name="cmbIdDistrito'+context+'"]').change( function () {
                    console.log( 'configurando centros');
                    cargarComboCentrosPoblados( $(this).val(), context );
                });
            }
        });
    }else{
        resetCombo( 'cmbIdDistrito'+context );
    }
}



function setCombosEventos( paisesData, context )
{

    $('select[name="cmbIdPais'+context+'"]').html('').select2( {'data': paisesData });
    $('select[name="cmbIdPais'+context+'"]').change( function () {
        if( $(this).val() == 166 ){
            cargarComboDepartamentos( 166, context);
        }else{
            $('select[name="cmbIdPais'+context+'"]').html('').select2( {'data': [] });
        }
    });

    $('select[name="cmbIdDepartamento'+context+'"]').change( function () {
        console.log( 'cargar departamentos...');
    });

    // $('select[name="cmbIdProvincia'+context+'"]').change( function () {
    //     // console.log( 'configurando centros');
    //     // cargarComboCentrosPoblados( $(this).val(), context );
    // });
}

function seleccionarDepartamento(){

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


                if( typeof paciente['IdCentroPoblado'+context] !== 'undefined'){ // para seleccionar automaticamente los combos anidados
                    console.log( 'centro poblado: '+paciente['IdCentroPoblado'+context] );
                    $('select[name="cmbIdCentroPoblado'+context+'"]').val( paciente['IdCentroPoblado'+context] ).trigger( 'change' );
                }
            }
        });
    }else{
        resetCombo( 'cmbIdCentroPoblado'+context );
    }
}

function openModalCrud(accion, idPaciente = 0)
{
    resetForm();
    accion = accion.toUpperCase();
    $('#accion').val( accion );
    $('#idPaciente').val( idPaciente );
    $('#partial-list').toggle();
    $('#partial-crud').toggle();
    btn_name = '';
    btn_class = '';

    if( accion == 'CREATE' ) {
        btn_class = 'btn-primary';
        btn_name = 'GUARDAR';
    }

    if( accion == 'EDIT' ) {
        btn_class = 'btn-success';
        btn_name = 'ACTUALIZAR';
    }

    if( accion == 'CANCEL' ) {
        btn_class = 'btn-success';
        btn_name = '...';
    }
    $('.btn-save').removeClass( ['btn-primary', 'btn-default', 'btn-danger', 'btn-success'] ).addClass( btn_class ).html( btn_name);
}

function cancelItem()
{
    paciente = {};
    openModalCrud('CANCEL');
} 

function createItem()
{
    paciente = {};
    openModalCrud('CREATE');
}

function editItem( idPaciente )
{
    let url = getPathCtrl();
    $.ajax({
        data: {}, url: url+'/'+idPaciente+'/edit',
        type:  'GET', dataType: 'json',
        success:  function (response) {
            console.log( response );
            paciente = response.paciente;
            let sunasa = response.sunasa;

            openModalCrud('EDIT', paciente.IdPaciente);

            // PACIENTE
            $('select[name="cmbIdDocIndentidad"').val( paciente.IdDocIdentidad ).trigger('change');
            $('input[name="txtNroDocumento"]').val( paciente.NroDocumento );
            $('select[name="cmbIdTipoGenHistoriaClinica"').val( paciente.IdTipoNumeracion ).trigger('change');
            $('input[name="tipoNumeracionAnterior"').val( paciente.IdTipoGenHistoriaClinica_tag);
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
            $('select[name="cmbIdPaisDomicilio"]').val (paciente.IdPaisDomicilio ).trigger('change');
            $('input[name="chkIgualQueDomicilio"]').prop('checked', false);




            $('select[name="cmbIdPaisProcedencia"]').val('166').trigger('change');
            $('input[name="chkIgualQueDomicilioNac"]').prop('checked', false);
            $('select[name="cmbIdPaisNacimiento"]').val('166').trigger('change');
            $('input[name="txtDireccionDomicilio"]').val( paciente.DireccionDomicilio );

            // SUNASA
            let txtPaciente = $.trim(paciente.ApellidoPaterno) + ' ' + $.trim(paciente.ApellidoMaterno) + ' ' + 
            $.trim(paciente.PrimerNombre) + ' '+$.trim(paciente.SegundoNombre) + ' '+ $.trim(paciente.TercerNombre);
            $('input[name="txtPaciente"]').val( txtPaciente );
            $('input[name="txtSexo"]').val( $('select[name="cmbIdTipoSexo"]').select2('data')[0].text );
            $('input[name="txtDocumento"]').val( $('select[name="cmbIdDocIndentidad"]').select2('data')[0].text );
            $('input[name="txtNdocumento"]').val( $('input[name="txtNroDocumento"]').val() );
            $('input[name="txtPais"]').val( $('select[name="cmbIdPaisDomicilio"]').select2('data')[0].text );
            $('input[name="chkNuevoSeguro"]').prop('checked', false);
            $('input[name="chkNoTieneSeguro"]').prop('checked', false);

            if( sunasa != null) {
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
            // ------------
            
        }
    });
}

function saveItem()
{
    url = getPathCtrl();

    

    form = $('#'+model+'-form');
    data = new FormData(  form[0] );

    accion = $("#accion").val().toUpperCase();
    if ( accion == 'EDIT'){
        url += '/'+$('#idPaciente').val();
        data.append('_method', 'PUT');
    } else if ( accion == 'DELETE') {
        url += '/'+$('#idPaciente').val();
        data.append('_method', 'DELETE');
    }

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
  
  

