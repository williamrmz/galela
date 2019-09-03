
var antibioticos = [];

var muestras = ['Orina', 'Heces', 'Sangre'];

var idtem = 0;

var antibiograma = { };

var germenes = [];

$(function(){
    getDataAntibioticos();

    $(".germen-btn-limpiar").click( function (e) {
        e.preventDefault();
        $(".germen-input-filtro").val('');
        verDataGermenes();
    });

    $(".germen-btn-buscar").click( function (e) {
        e.preventDefault();
        verDataGermenes();
    });

    $(".germen-input-filtro").keyup( function(e) {
        // if(e.which == 13) verDataGermenes();
        verDataGermenes();
    })

    $(".btn-aceptar-antibiograma").click( function(e) {
        agregarAlItem();
    });

    $(".btn-antibiograma").click( function(e) {
        e.preventDefault();

        verDataGermenes();

        let a = $(this);
        itemId = a.siblings('input.item-id').val();
        let itemNombre = a.siblings('input.item-nombre').val();
        let jsonText = $("#antibiograma-"+itemId).val();
        if (jsonText==="") jsonText = '[]';

        antibiograma = JSON.parse(jsonText);

        germenes = (typeof antibiograma.germenes == 'undefined')? []: antibiograma.germenes;
        verGermenes();

        let muestra = (typeof antibiograma.muestra == 'undefined')? '': antibiograma.muestra;
        setSelectMuestra(muestra);

        $("#modal-title").html(itemNombre);
        $("#modal-antibiograma").modal('show');
    });
});


//OK
function agregarGermen(newGermen){
    let add = true;
    germenes.forEach( germen => {
        if(newGermen.id == germen.id){
            add = false; return;
        }
    });

    if(add){
        newGermen.cantidad = 0;
        newGermen.antibioticos = JSON.parse( JSON.stringify( antibioticos ) );
        germenes.push(newGermen);
        console.log(germenes);
        verGermenes();
    }else{
        toastr.warning('El germen ya se encuntra agregado.', 'Error!');
    }
}

//OK
function quitarGermen(index){
    germenes.splice(index, 1);
    verGermenes();
}

//OK
function getDataAntibioticos()
{
    $.ajax({
        data: {service: 'getDataAntibioticos'}, url:   basePath+"/api",
        type:  'GET', dataType: 'json',
        success:  function (response) {
            antibioticos = response;
        }
    }); 
}

//OK
function verDataGermenes(page=1)
{
    let params = {
        service: 'getTablaGermenes', 
        page:page,
        filtro: $(".germen-input-filtro").val(),
    };

    $.ajax({
        data: params, url:   basePath+"/api",
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $("#tabla-germenes").html(response);

            $(".pagination a").click( function (e) {
                e.preventDefault();
                $('li').removeClass('active');
                $(this).parent('li').addClass('active');
                let page=$(this).attr('href').split('page=')[1];
                verDataGermenes(page);
            })

            $(".btn-select-germen").click( function(e) {
                e.preventDefault();
                let germen = $(this).siblings('input').val();
                germen = JSON.parse(germen);
                agregarGermen(germen);
            });
        }
    });
}

//OK
function verGermenes()
{
    let navs = '';
    let content = '';
    let select = true;
    let clase = '';
    germenes.forEach( (value, index, array) => {
        clase = (select)? ' active':'';
        
        navs += '<li class="'+clase+'">'
            navs += '<a href="#tab_'+index+'" data-toggle="tab">'+value.nombre+'</a>';
        navs += '</li>';
        content += buildContent(value, index, select)
        select = false;
    });
    $("#tab-navs").html(navs);
    $("#tab-contents").html(content);

    $(".custom-datatable").DataTable({
        'paging': false, 'info': false, 'ordering': false,
        "language": { "search": "Buscar:",}
    });


    $(".select-estado").change(function(){ updateEstadoMedicina($(this)); });

    $(".med-mic").focusout(function(){ updateMicMedicina($(this)); });

    $(".add-cantidad").focusout(function(){ updateCantidadGermen($(this)); });
}

function setSelectMuestra(muestraSelected)
{
    let html = '';
    let selected = '';
    muestras.forEach( (muestra, index, array) => {
        selected = (muestra == muestraSelected)? 'selected': '';
        html += '<option value="'+muestra+'" '+selected+'>'+muestra+'</option>'
    });
    $("#muestras").html(html);
}

//OK
function updateCantidadGermen(input)
{
    let cantidad = input.val();
    let germenId = input.siblings('input.germen-id').val();

    let find = false;
    germenes.forEach( (germen, index, array) => {
        if(germen.id == germenId){
            germen.cantidad = cantidad;
            find = true;
            console.log(germen);
            return;
        }
    });

    if(!find)  toastr.error('Error de operacion: No se encontro la bacteria para editar la cantidad');
}

//OK
function updateEstadoMedicina(select)
{
    let estado = select.val();
    let antibioticoId = select.siblings('input.antibioticoId').val();
    let germenId = select.siblings('input.germenId').val();

    let find = false;
    germenes.forEach( (germen, index, array) => {
        if(germen.id == germenId){
            germen.antibioticos.forEach( (antibiotico, index1, array1)=> {
                if(antibiotico.id == antibioticoId){
                    antibiotico.estado = estado;
                    find = true;
                    console.log(antibiotico);
                    return;
                }
            });
            return;
        }
    });

    if(!find)  toastr.error('Error de operacion: No se encontro el medicamento para editar su estado');
}

//OK
function updateMicMedicina(textarea)
{
    let mic = textarea.val();
    let antibioticoId = textarea.siblings('input.antibioticoId').val();
    let germenId = textarea.siblings('input.germenId').val();

    let find = false;
    germenes.forEach( (germen, index, array) => {
        if(germen.id == germenId){
            germen.antibioticos.forEach( (antibiotico, index1, array1)=> {
                if(antibiotico.id == antibioticoId){
                    antibiotico.mic = mic;
                    find = true;
                    console.log(antibiotico)
                    return;
                }
            });
            return;
        }
    });

    if(!find)  toastr.error('Error de operacion: No se encontro el medicamento para editar su estado');
}

//OK
function buildContent(germen, index, select){
    let content = '';

    let clase = (select)? ' active':'';

    content += '<div class="tab-pane '+clase+'" id="tab_'+index+'">';

        content += '<div class="form-inline pull-right" style="margin-top:17px;">';
            content += '<input type="text" class="form-control input-sm add-cantidad" value="'+germen.cantidad+'" placeholder="cantidad" style="width:100px; margin-right:5px;">';
            content += '<input type="hidden" class="germen-id" value="'+germen.id+'">';
            content += '<a href="javascript:quitarGermen('+index+')" class="badge "> Eliminar</a>';
        content += '</div>';

        content += '<table class="table table-condensed table-bordered custom-datatable">';
            content += '<thead>';
                content += '<tr> <th>Antibiotico</th> <th>Sensibilidad</th> <th>MIC</th> </tr>';
            content += '</thead>';
            content += '<tbody>';
            germen.antibioticos.forEach( (value, index, array) => {
                content += '<tr>';
                    content += '<td>'+value.nombre+'</td>';
                    content += '<td>';
                        content += '<input type="hidden" class="germenId" value="'+germen.id+'" >';
                        content += '<input type="hidden" class="antibioticoId" value="'+value.id+'" >';
                        content += '<select class=" select-estado">';

                            let estado = (value.estado == '')? 'selected': '';  
                            content += '<option value="" '+estado+'>NINGUNO</option>';

                            estado = (value.estado == 'SENSIBLE')? 'selected': '';  
                            content += '<option value="SENSIBLE" '+estado+'>SENSIBLE</option>';

                            estado = (value.estado == 'INTERMEDIO')? 'selected': '';
                            content += '<option value="INTERMEDIO" '+estado+'>INTERMEDIO</option>';

                            estado = (value.estado == 'RESISTENTE')? 'selected': '';
                            content += '<option value="RESISTENTE" '+estado+'>RESISTENTE</option>';

                        content += '</select>';
                    content += '</td>';

                    content += '<td>';
                        content += '<input type="hidden" class="germenId" value="'+germen.id+'" >';
                        content += '<input type="hidden" class="antibioticoId" value="'+value.id+'" >';
                        content += '<input placeholder="mic" style="width: 54px;" class="med-mic" value="'+value.mic+'">';
                    content += '</td>';
                    
                content += '</tr>';
            });
            content += '</tbody>';
        content += '</table>';

    content += '</div>';
    return content;
}

//OK
function agregarAlItem()
{
    let jsonText = '';
    if(germenes.length) {
        let antibiograma = {
            muestra: $("#muestras").val(),
            germenes: JSON.parse( JSON.stringify(germenes) ),
        };
        jsonText = JSON.stringify(antibiograma);
    }

    $("#antibiograma-"+itemId).html(jsonText);
    $("#modal-antibiograma").modal('hide');
    
    console.log('antibiograma-'+itemId);
    console.log('Tamaño del texto json: '+jsonText.length);
}