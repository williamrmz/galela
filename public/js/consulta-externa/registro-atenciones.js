var model="registroAtenciones";
var item = {};

$(function(){
    $('.select2').select2();

    showListItems();

    $('#'+model+'-form-search').submit( function(e) {
        e.preventDefault();
        showListItems();
    });

    $('#'+model+'-btn-clear').click( function(e) {
        e.preventDefault();
        $('#'+model+'-form-search').trigger("reset");
        showListItems();
    });

    $('#'+model+'-btn-create').click( function (e) {
        e.preventDefault();
        createItem();
    });


    $(".btn-seleccionar-diagnostico").click( function (e) {
        e.preventDefault();
        
        openModalBuscarDiagnostico();
    })

    $(".registroAtenciones-btn-buscar-procedimiento").click( function (e) {
        e.preventDefault();
        openModalBuscarProcedimiento( $(this).siblings('input.context').val() );
    });

    $(".registroAtenciones-btn-buscar-establecimiento").click( function (e) {
        e.preventDefault();
        openModalBuscarEstablecimiento( "minsa" );
    });

    $(".btn-open-modal").click( function (e) {
        e.preventDefault();
        openModalBuscarDiagnostico();
    });

    
});

function openModalSeleccionProcedimientos( context  )
{
    
    item_new = {
        id: 15,
        nombre: 'Nuevo procedimiento',
        cant: 2,
        dosis: "3",
        hay: 54,
    }
    agregarProcedimiento( context, item_new );
}

function getPathCtrl()
{
    return $("input[name='"+model+"-path-ctrl']").val();
}

function getDataItem( idEmpleado = 0 )
{
    url = getPathCtrl();
    $.ajax({
        data: { name: 'getItemData', 'idEmpleado': idEmpleado }, url: url+'/api/service',
        type:  'GET', dataType: 'json',
        success:  function (data) {
            console.log(data);
            item = data.item;
            triaje = item.triaje;
            examenes = item.examenes;
            tratamiento = item.tratamiento;
            destino = item.destino;

            $('input[name="frecuencia_respiratoria"]').val(triaje.frecuencia_respiratoria);
            $('input[name="peso"]').val(triaje.peso);
            $('input[name="presion"]').val(triaje.presion);
            $('input[name="pulso"]').val(triaje.pulso);
            $('input[name="talla"]').val(triaje.talla);
            $('input[name="temperatura"]').val(triaje.temperatura);

            $('textarea[name="antecedentes_alergias"]').val(examenes.antecedentes_alergias);
            $('textarea[name="antecedentes_consulta"]').val(examenes.antecedentes_consulta);
            $('textarea[name="antecedentes_familiares"]').val(examenes.antecedentes_familiares);
            $('textarea[name="antecedentes_obstetricos"]').val(examenes.antecedentes_obstetricos);
            $('textarea[name="antecedentes_patologicos"]').val(examenes.antecedentes_patologicos);
            $('textarea[name="antecedentes_quirurgicos"]').val(examenes.antecedentes_quirurgicos);
            $('textarea[name="antecedentes_otros"]').val(examenes.antecedentes_otros);
            $('textarea[name="examen_fisico"]').val(examenes.examen_fisico);
            $('textarea[name="motivo_consulta"]').val(examenes.motivo_consulta);

            $('textarea[name="tratamiento_indicaciones"]').val(tratamiento.tratamiento_indicaciones);
            $('textarea[name="tratamiento_observaciones"]').val(tratamiento.tratamiento_observaciones);

            $('input[name="cita_alta_definitiva"]').prop('checked', destino.cita_alta_definitiva);
            $('select[name="cita_destino"]').val(destino.cita_destino);
            $('input[name="cita_proxima"]').val(destino.cita_proxima);
            $('input[name="cita_fecha"]').val(destino.cita_fecha);
            $('select[name="referencia_tipo"]').val(destino.referencia_tipo); //Referencias
            $('input[name="referencia_estado"]').val(destino.referencia_estado);
            $('select[name="episodio_clinico"]').val(destino.episodio_clinico); //Episodio
            $('input[name="episodio_nuevo"]').prop('checked', destino.episodio_nuevo);
            $('input[name="episodio_cierre"]').prop('checked', destino.episodio_cierre);

            verProcedimientos( 'farmacia' );
            verProcedimientos( 'anatomia_patologica' );
            verProcedimientos( 'banco_sangre' );
            verProcedimientos( 'ecografia_general' );
            verProcedimientos( 'ecografia_obstetrica' );
            verProcedimientos( 'patologia_clinica' );
            verProcedimientos( 'rayos' );
            verProcedimientos( 'tomografia' );

            cargarCombox(data.cbx_data);

        }
    }); 
}


function cargarCombox( data )
{
    $("select[name='cbx_lab_his']").select2({ data: data.cbx_lab_his});
    $("select[name='cbx_id_tipo_diagnostico']").select2({ data: data.cbx_id_tipo_diagnostico});
    $("select[name='cbx_id_condicion_establecimiento']").select2({ data: data.cbx_id_condicion_establecimiento});
    $("select[name='cbx_id_condicion_servicio']").select2({ data: data.cbx_id_condicion_servicio});
    $("select[name='cbx_id_destino_atencion']").select2({ data: data.cbx_id_destino_atencion});

    $("select[name='cbx_id_tipo_referencia_destino']").select2({ data: data.cbx_id_tipo_referencia_destino});
    $("select[name='cbx_episodios_historicos']").select2({ data: data.cbx_episodios_historicos});
}

function verProcedimientos( context )
{
    lista = item.ordenes[ context ];
    tbody = '';
    lista.forEach( function( row, index, array)  {
        tbody += '<tr>';
            tbody += '<td>'+row.nombre+'</td>';
            tbody += '<td>'+row.cant+'</td>';
            if( context == 'farmacia') tbody += '<td>'+row.dosis+'</td>';
            tbody += '<td>'+row.hay+'</td>';
            tbody += '<td>';
                tbody += '<input type="hidden" class="context" value="'+context+'">';
                tbody += '<input type="hidden" class="id" value="'+row.id+'">';
                tbody += '<a href="#" class="btn btn-xs btn-default btn-quitar-proc-'+context+'"> <i class="fa fa-close"></i></a>';
            tbody += '</td>';
        tbody += '</tr>';
    });
    $('.tbody_'+context).html(tbody);

    $(".btn-quitar-proc-"+context).click( function (e) {
        e.preventDefault();
        context = $(this).siblings( 'input.context').val();
        id = $(this).siblings( 'input.id').val();
        quitarProcedimiento( context, id);
    })

}

function agregarProcedimiento( context, item_new)
{
    itemExiste = item.ordenes[ context ].find( element => element.id === item_new.id);
    if(itemExiste == null){
        item.ordenes[ context ].push(item_new);
        // console.log(item.ordenes[ context ]);
        verProcedimientos( context );
    }else{
        toastr.warning("El procedimiento ya ha sido agregado");
    }
}

function quitarProcedimiento( context, id)
{
    index = item.ordenes[ context ].findIndex( element => element.id === id);
    item.ordenes[ context ].splice(index, 1);
    verProcedimientos( context );
}

function showListItems(page=1)
{
    url = getPathCtrl();
    params  = $('#'+model+'-form-search').serialize();
    params += "&page="+page;

    $.ajax({
        data: params, url: url,
        type:  'GET', dataType: 'html',
        beforeSend: function() {
            // setting a timeout
            $('.'+model+'-table').html('<div class="text-center"> <span class="text-blue fa fa-refresh fa-spin"></span> loading...</div>');
        },
        success:  function (response) {
            $('.'+model+'-table').html(response);

            $('.'+model+'-paginator .pagination a').click( function (e) {
                e.preventDefault();
                $('.firma-paginator li').removeClass('active');
                $(this).parent('.firma-paginator li').addClass('active');
                let page=$(this).attr('href').split('page=')[1];
                showListItems(page);
            })

            $('.'+model+'-btn-edit').click( function (e) {
                e.preventDefault();
                id = $(this).siblings('input').val();
                editItem(id);
            });
        
            $('.'+model+'-btn-delete').click( function (e) {
                e.preventDefault();
                id = $(this).siblings('input').val();
                deleteItem(id);
            });
        },
        error: function (request, status, error) {
            $('.'+model+'-table').html('<div class="text-center"> <span class="text-red fa fa-close"></span> error !</div>');
            if( request.responseText){
               data = JSON.parse( request.responseText );
                if( data.alert_type && data.alert_message){
                    if( data.alert_type == 'WARNING') toastr.warning( data.alert_message, 'Alert');
                }
            }
        }
    });
}

function createItem()
{
    // $('#modalBuscarDiagnosticoBody').html('Registro de antencion');
    $("#modalRegistroAtencion").modal('show');


    
}


// MODAL BUSCAR DIAGNOSTICOS
function openModalBuscarDiagnostico()
{
    $(".ctrlDiagnosticosDescipcion").unbind( "keypress" );
    $(".ctrlDiagnosticosDescipcion").on('keypress', function(e) {
        if(e.which == 13) buscarDiagnosticos();
    });

    $(".ctrlDiagnosticosCodigo").unbind( "keypress" );
    $(".ctrlDiagnosticosCodigo").on('keypress', function(e) {
        if(e.which == 13) buscarDiagnosticos();
    });

    $(".ctrlDiagnosticosBtnSearch").unbind( "click" );
    $(".ctrlDiagnosticosBtnSearch").click( function(e) {
        buscarDiagnosticos();
    });

    $(".ctrlDiagnosticosBtnClear").unbind( "click" );
    $(".ctrlDiagnosticosBtnClear").click( function(e) {
        limpiarDiagnosticos();
    });

    $("#modalRegistroAtencion").modal('hide');

    $("#modalBuscarDiagnostico").modal('toggle');
    $('#modalBuscarDiagnostico').on('hidden.bs.modal', function(e){
        $("#modalRegistroAtencion").modal('show');
    });
}

function buscarDiagnosticos( page = 1)
{
    $.ajax({
        data: {
            codigo: $(".ctrlDiagnosticosCodigo").val(),
            descripcion: $(".ctrlDiagnosticosDescipcion").val(),
            page: page
        }, 
        url: basePath+'/controles?service=getDiagnosticosData',
        type:  'GET', dataType: 'html',
        beforeSend: function() {
            $('.ctrlDiagnosticosTable').html('<br><div class="text-center"><i class="text-blue fa fa-refresh fa-spin"></i> buscando... </div>');
        },
        success:  function ( data ) {
            $('.ctrlDiagnosticosTable').html( data );

            $('.ctrlDiagnosticosTable .pagination a').click( function (e) {
                e.preventDefault();
                $('.ctrlDiagnosticosTable li').removeClass('active');
                $(this).parent('.ctrlDiagnosticosTable li').addClass('active');
                let page=$(this).attr('href').split('page=')[1];
                buscarDiagnosticos( page );
            })

            $('.ctrlDiagnosticosTable .btn-select').click( function (e) {
                let item = JSON.parse( $(this).siblings('input').val() );
                seleccionarDiagnostico(item);
            })

        },
        error: function (request, status, error) {
            $('.ctrlDiagnosticosTable').html('<br><div class="text-center"><i class="text-red fa fa-close"></i> Se ha producido un error </div>');
        }
    })
}

function limpiarDiagnosticos()
{
    $(".ctrlDiagnosticosCodigo").val('');
    $(".ctrlDiagnosticosDescipcion").val('');
    buscarDiagnosticos( );
}


function seleccionarDiagnostico( item )
{
    console.log(item);
}

//-- MODAL BUSCAR DIAGNOSTICOS

// MODAL BUSCAR ESTABLECIMIENTOS
function openModalBuscarProcedimiento( context )
{
    $("#modalRegistroAtencion").modal('hide');
    $('#modalBuscarProcedimiento').modal('show');
    $('#modalBuscarProcedimiento').on('hidden.bs.modal', function(e){
        $("#modalRegistroAtencion").modal('show');
    });
}

//-- MODAL BUSCAR ESTABLECIMIENTOS


// MODAL BUSCAR ESTABLECIMIENTOS
function openModalBuscarEstablecimiento( esMinsa )
{
    $(".ctrlEstablecimientosBtnSearch").unbind( "click" );
    $(".ctrlEstablecimientosBtnSearch").click( function(e) {
        buscarEstablecimientos();
    });

    $(".ctrlEstablecimientosBtnClear").unbind( "click" );
    $(".ctrlEstablecimientosBtnClear").click( function(e) {
        limpiarEstablecimientos();
    });


    $("#modalRegistroAtencion").modal('hide');
    $('#modalBuscarEstablecimiento').modal('show');
    $('#modalBuscarEstablecimiento').on('hidden.bs.modal', function(e){
        $("#modalRegistroAtencion").modal('show');
    });

    // soloMinsa = false;
    // if( !soloMinsa ) {
    //     $(".ctrlProcedimientosCodReanes").prop('disabled', true);
    // }
    cargarCbxDepartamentos();
}

function cargarCbxDepartamentos()
{
    $.ajax({
        data: {}, url: basePath+'/controles?service=getDepartamentosData',
        type:  'GET', dataType: 'json',
        success:  function (departamentosData) {
            departamentosData.unshift({id:'', text:'Seleccione...'});
            $(".ctrlEstablecimientosDepartamento").html('').select2({ data: departamentosData });
            $(".ctrlEstablecimientosProvincia").html('');
            $(".ctrlEstablecimientosDistrito ").html('');
            // $('.ctrlEstablecimientosDepartamento').select2().trigger('change');

            cargarCbxProvincias( $('.ctrlEstablecimientosDepartamento').val() );
            $(".ctrlEstablecimientosDepartamento").change( function() {
                cargarCbxProvincias( $('.ctrlEstablecimientosDepartamento').val() );
            })
        }
    });
}

function cargarCbxProvincias( idDepartamento )
{
    if( idDepartamento === '') return;

    $.ajax({
        data: {}, url: basePath+'/controles?service=getProvinciasData&idDepartamento='+idDepartamento,
        type:  'GET', dataType: 'json',
        success:  function (provinciasData) {
            provinciasData.unshift({id:'', text:'Seleccione...'});
            $(".ctrlEstablecimientosProvincia").html('').select2({ data: provinciasData });
            $(".ctrlEstablecimientosDistrito ").html('');

            cargarCbxDistritos( $('.ctrlEstablecimientosProvincia').val() );
            $(".ctrlEstablecimientosProvincia").change( function() {
                cargarCbxDistritos( $('.ctrlEstablecimientosProvincia').val() );
            })
        }
    })
}

function cargarCbxDistritos( idDistrito )
{
    if( idDistrito === '') return;

    $.ajax({
        data: {}, url: basePath+'/controles?service=getDistritosData&idProvincia='+idDistrito,
        type:  'GET', dataType: 'json',
        success:  function (distritosData) {
            distritosData.unshift({id:'', text:'Seleccione...'});
            $(".ctrlEstablecimientosDistrito").html('').select2({ data: distritosData });
        }
    })
}

function buscarEstablecimientos()
{
    $.ajax({
        data: {
            codRenaes: $(".ctrlEstablecimientosCodReanes").val(),
            nombre: $(".ctrlEstablecimientosNombre").val(),
            idDepartamento: $(".ctrlEstablecimientosDepartamento").val(),
            idProvincia: $(".ctrlEstablecimientosProvincia").val(),
            idDistrito: $(".ctrlEstablecimientosDistrito").val(),
        }, 
        url: basePath+'/controles?service=getEstablecimientosData',
        type:  'GET', dataType: 'json',
        beforeSend: function() {
            $('.ctrlEstablecimientosTbody').html('<tr class="text-center"><td colspan="6"> <i class="text-blue fa fa-refresh fa-spin"></i> buscando... </td></tr>');
        },
        success:  function ( data ) {
            let tbody = '';
            if( data.length > 0){
                data.forEach( function(element){
                    tbody += '<tr>';
                        tbody += '<td>'+element.codigo+'</td>';
                        tbody += '<td>'+element.Nombre+'</td>';
                        tbody += '<td>'+element.Distrito+'</td>';
                        tbody += '<td>'+element.Provincia+'</td>';
                        tbody += '<td>'+element.Departamento+'</td>';
                        tbody += '<td>'; 
                            tbody += '<input type="hidden" value=\''+JSON.stringify(element)+'\'>';
                            tbody += '<a href="#" class="btn btn-default btn-xs ctrlEstablecimientosTbody-btn-select"> <i class="fa fa-plus"></i></a>';
                        tbody += '</td>';
                    tbody += '</tr>';
                });
            }else{
                tbody = '<tr class="text-center"><td colspan="6"> No se encontraron resultados </td></tr>';
            }
            $('.ctrlEstablecimientosTbody').html( tbody );
            $(".ctrlEstablecimientosTbody-btn-select").click( function(e) {
                e.preventDefault();
                item = $(this).siblings('input').val();
                item = JSON.parse(item);
                seleccionarEstablecimiento( item );
            });
        }
    })
}

function limpiarEstablecimientos()
{
    $(".ctrlEstablecimientosCodReanes").val(""),
    $(".ctrlEstablecimientosNombre").val(""),
    $(".ctrlEstablecimientosDepartamento").val(""),
    $('.ctrlEstablecimientosDepartamento').select2().trigger('change');
    $(".ctrlEstablecimientosProvincia").html(""),
    $(".ctrlEstablecimientosDistrito").html(""),
    console.log('limpiar....');
}

function seleccionarEstablecimiento( $item )
{
    console.log(item);
    // manager result...
}
//-- MODAL BUSCAR ESTABLECIMIENTOS


function editItem(id)
{
    let url = getPathCtrl();
    $.ajax({
        data: {}, url: url+'/'+id+'/edit',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $('#myModalTitle').html('Editar '+model);
            $('#myModalBody').html(response);
            $('#myModal').modal('show');

            $('#'+model+'-form').submit( function (e) {
                e.preventDefault();
                updateItem(id);
            });

            $('#myModal').modal('show');
        }
    });
}

function deleteItem(id)
{
    let url = getPathCtrl();
    $.ajax({
        data: {}, url: url+'/'+id+'/delete',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $('#myModalTitle').html('Eliminar '+model);
            $('#myModalBody').html(response);
            $('#myModal').modal('show');

            $('#'+model+'-form').submit( function (e) {
                e.preventDefault();
                destroyItem(id);
            });

            $('#myModal').modal('show');
        }
    });
}

function storeItem()
{
    params = $('#'+model+'-form').serialize();
    url = getPathCtrl();

    $.ajax({
        data: params, url: url,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            if(response.success){
                toastr.success(model+' creado', 'OK!');
                $('#'+model+'-form-search').trigger("reset");
                showListItems();
                $('#myModal').modal('hide');
            }
        },
        error: function (request, status, error) {
            showErrosValidator(request);
        }
    });
}

function updateItem(id)
{
    params = $('#'+model+'-form').serialize();
    url = getPathCtrl();

    $.ajax({
        data: params, url: url+'/'+id,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            if(response.success){
                toastr.success(model+' actualizado', 'OK!');
                showListItems();
                $('#myModal').modal('hide');
            }
        },
        error: function (request, status, error) {
            showErrosValidator(request);
        }
    });
}

function destroyItem(id)
{
    params = $('#'+model+'-form').serialize();
    url = getPathCtrl();

    $.ajax({
        data: params, url: url+'/'+id,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            if( response.success ){
                toastr.success(model+' eliminado', 'OK!');
                $('#'+model+'-form-search').trigger("reset");
                showListItems();
                $('#myModal').modal('hide');
            }else {
                toastr.error(response.message, 'Error');
            }
        }
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

