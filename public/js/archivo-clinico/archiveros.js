var model="archiveros";
var misServicios = [];
var action = '';
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

function getPathCtrl()
{
    return $("input[name='"+model+"-path-ctrl']").val();
}

function openModalEmpleados()
{
    $.ajax({
        data: {}, url: basePath+'/controles?service=buscarEmpleados',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            // console.log(response);
            $('#mySubModalTitle').html('Buscar Empleado');
            $('#mySubModalSize').addClass('modal-lg'); //options: '', 'modal-lg'
            $('#mySubModalBody').html(response);
            $('#mySubModal').modal({backdrop: 'static', keyboard: false});
            

            $(".control-btn-select-item").click( function(e) {
                e.preventDefault();
                empleado = $(this).siblings('input').val();
                empleado = JSON.parse(empleado);
                // console.log(empleado);
                seleccionarEmpleado( empleado );
                $('#mySubModal').modal('hide');
            })

            $('#control-table-items').DataTable();

            $('#mySubModal').modal('show');
        }
    });
}

function openModalServicio()
{
    $.ajax({
        data: {}, url: basePath+'/controles?service=buscarServicios',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            // console.log(response);
            $('#mySubModalTitle').html('Buscar Servicio');
            $('#mySubModalSize').addClass('modal-lg'); //options: '', 'modal-lg'
            $('#mySubModalBody').html(response);
            $('#mySubModal').modal({backdrop: 'static', keyboard: false});
            

            $(".control-btn-select-item").click( function(e) {
                e.preventDefault();
                servicio = $(this).siblings('input').val();
                servicio = JSON.parse(servicio);
                // console.log(servicio);
                seleccionarServicio( servicio );
                $('#mySubModal').modal('hide');
            })

            $('#control-table-items').DataTable();

            $('#mySubModal').modal('show');
        }
    });
}

function seleccionarEmpleado( empleado )
{
    console.log(empleado);
    $("#idEmpleado").val( empleado.IdEmpleado);
    $("#codigoEmpleado").val( empleado.CodigoPlanilla);
    $("#nombreEmpleado").val( empleado.ApellidoPaterno+' '+empleado.ApellidoPaterno+' '+empleado.Nombres);
}

function seleccionarServicio( servicio )
{
    console.log(servicio);
    $("#idServicio").val( servicio.IdServicio);
    $("#codigoServicio").val( servicio.Codigo);
    $("#nombreServicio").val( servicio.Nombre);
}

function agregarServicio( )
{
    idServicio = $("#idServicio").val();
    codigoServicio = $("#codigoServicio").val();
    nombreServicio = $("#nombreServicio").val();

    if( idServicio == ''){
        toastr.warning('Seleccione un servicio', 'Alerta');
        return;
    }
    item = {
        id: idServicio,
        idServicio: idServicio,
        codigoServicio: codigoServicio,
        nombreServicio: nombreServicio,
    }
    itemExiste = misServicios.find( element => element.id === item.id);

    if(itemExiste == null){
        misServicios.push(item);
        verMisServicios();
    }else{
        toastr.warning("El servicio ya ha sido agregado");
    }

    console.log(misServicios);
}

function quitarServicio(id)
{
    index = misServicios.findIndex( element => element.id === id);
    misServicios.splice(index, 1);
    verMisServicios();
}

function verMisServicios()
{
    let hideBtnQuitar = ( action=='DELETE' || action=='SHOW')? 0: 1;
    let html = "";
    misServicios.forEach( (element, key) => {
        html += '<tr>';
            html += '<td>'+element.codigoServicio;
                html += '<input type="hidden" name="servicios['+key+'][idServicio]" value="'+element.id+'">';
                html += '<input type="hidden" name="servicios['+key+'][codigoServicio]" value="'+element.codigoServicio+'">';
            html +='</td>';
            html += '<td> '+element.nombreServicio+'</td>';
            html += '<td align="center">';
                if( hideBtnQuitar ){
                    html += '<input type="hidden" value="'+element.id+'">';
                    html += '<a href="#" class="btn btn-xs btn-default btn-quitar-servicio"> <i class="text-red fa fa-close"></i></a>';
                }
            html += '</td>';
        html += '</tr>';
    });

    $('.tbody-servicios').html(html);

    $(".btn-quitar-servicio").click( function (e) {
        e.preventDefault();
        quitarServicio( $(this).siblings('input').val() );
    });
}

function getDataItem(id)
{
    let url = getPathCtrl();
    $.ajax({
        data: {name: 'getDataItem', idEmpleado: id},
        url: url+'/api/service',
        type:  'GET', dataType: 'json',
        success:  function (response) {
            console.log(response);
            empleado = response.empleado;
            misServicios = response.misServicios;
            $("#idEmpleado").val( empleado.IdEmpleado);
            $("#codigoEmpleado").val( empleado.CodigoPlanilla);
            $("#nombreEmpleado").val( empleado.ApellidoPaterno+' '+empleado.ApellidoPaterno+' '+empleado.Nombres);
            verMisServicios();
        }
    });
}

//CURD
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
        }
    });
}

function createItem()
{
    let url = getPathCtrl();

    $.ajax({
        data: {}, url: url+'/create',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            action = 'CREATE'
            $('#myModalTitle').html('Crear '+model);
            // $('#myModalSize').addClass('modal-lg'); //options: '', 'modal-lg'
            $('#myModalBody').html(response);
            
            $('#'+model+'-form').submit( function (e) {
                e.preventDefault();
                storeItem();
            });

            $('.btn-archivero').click( function(e) {
                e.preventDefault();
                openModalEmpleados();
            });

            $('.btn-servicio').click( function(e) {
                e.preventDefault();
                openModalServicio();
            });

            misServicios = [];
            $('.btn-agregar-servicio').click( function(e) {
                e.preventDefault();
                agregarServicio();
            });


            $('#myModal').modal({backdrop: 'static', keyboard: false});
            $('#myModal').modal('show');
            
        }
    });
}

function editItem(id)
{
    let url = getPathCtrl();
    $.ajax({
        data: {}, url: url+'/'+id+'/edit',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            action = 'EDIT'
            $('#myModalTitle').html('Editar '+model);
            $('#myModalBody').html(response);

            $('#'+model+'-form').submit( function (e) {
                e.preventDefault();
                updateItem(id);
            });

            $('.btn-archivero').click( function(e) {
                e.preventDefault();
                openModalEmpleados();
            });

            $('.btn-servicio').click( function(e) {
                e.preventDefault();
                openModalServicio();
            });

            getDataItem(id);
            $('.btn-agregar-servicio').click( function(e) {
                e.preventDefault();
                agregarServicio();
            });

            $('#myModal').modal({backdrop: 'static', keyboard: false});
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
            action = 'DELETE'
            $('#myModalTitle').html('Eliminar '+model);
            $('#myModalBody').html(response);

            $("."+model+"-btn-destroy").click( function (e) {
                e.preventDefault();
                destroyItem(id);
            });
            getDataItem(id);
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

