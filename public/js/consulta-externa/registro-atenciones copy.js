var model="registroAtenciones";
var item = {};

$(function(){
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
            showErrosValidator(request);
        }
    });
}

function createItem()
{
    // $('#modalBuscarDiagnosticoBody').html('Registro de antencion');
    $("#modalRegistroAtencion").modal('show');


    $(".btn-seleccionar-diagnostico").click( function (e) {
        e.preventDefault();
        openModalBuscarDiagnostico();
    })

    $(".registroAtenciones-btn-seleccionar_procedimiento").click( function (e) {
        e.preventDefault();
        openModalBuscarProcedimiento();
    });

    return;
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


            getDataItem();
            $('.'+model+'-btn-seleccionar_procedimiento').click( function (e) {
                e.preventDefault();
                context = $(this).siblings('input.context').val();
                openModalSeleccionProcedimientos( context );
            });

            $(".btn-seleccionar-diagnostico").click( function (e) {
                e.preventDefault();
                openModalBuscarDiagnostico();
            })


            $('#myModal').modal({backdrop: 'static', keyboard: false});
            $('#myModal').modal('show');
        }
    });
}

// SUB MODALES
function openModalBuscarDiagnostico()
{
    // $('#modalBuscarDiagnostico').modal({backdrop: 'static', keyboard: false});
    $('#modalBuscarDiagnostico').modal('show');
}

function openModalBuscarProcedimiento()
{
    $('#modalBuscarProcedimiento').modal('show');
}

function openModalBuscarFarmacia()
{
    $('#modalBuscarFarmacia').modal('show');
}

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
    alert('aki');
    console.log(request);
    errors = request.responseJSON.errors;
    html = '<ul>';
    for (var key in errors) {
        html += "<li>" + key + ": " + errors[key] + "</li>";
    }
    html += '</ul>';
    toastr.error(html, 'Error')
}

