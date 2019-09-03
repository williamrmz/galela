$(function(){
    verTablaGermenes();

    $("#germenes-form-filtro").submit( function(e) {
        e.preventDefault();
        verTablaGermenes();
    });

    $(".germenes-btn-limpiar").click( function(e) {
        e.preventDefault();
        $('#germenes-form-filtro').trigger("reset");
        verTablaGermenes();
    });

    $(".germenes-btn-create").click( function (e) {
        e.preventDefault();
        createGermen();
    });
});

function getPathGermen()
{
    return $("input[name='germenes-path-ctrl']").val();
}

function verTablaGermenes(page=1)
{
    url = getPathGermen();
    params  = $("#germenes-form-filtro").serialize();
    params += "&page="+page;

    $.ajax({
        data: params, url: url,
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $(".germenes-tabla").html(response);

            $(".germenes-paginator .pagination a").click( function (e) {
                e.preventDefault();
                $('.firma-paginator li').removeClass('active');
                $(this).parent('.firma-paginator li').addClass('active');
                let page=$(this).attr('href').split('page=')[1];
                verTablaGermenes(page);
            })

            $(".germenes-btn-edit").click( function (e) {
                e.preventDefault();
                id = $(this).siblings('input').val();
                editGermen(id);
            });
        
            $(".germenes-btn-delete").click( function (e) {
                e.preventDefault();
                id = $(this).siblings('input').val();
                deleteGermen(id);
            });
        }
    });
}

function createGermen()
{
    let url = getPathGermen();
    $.ajax({
        data: {}, url: url+'/create',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $("#myModalTitle").html('Crear Germen');
            $("#myModalBody").html(response);
            
            $("#germen-form").submit( function (e) {
                e.preventDefault();
                storeGermen();
            });

            $("#myModal").modal('show');
        }
    });
}

function editGermen(id)
{
    let url = getPathGermen();
    $.ajax({
        data: {}, url: url+'/'+id+'/edit',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $("#myModalTitle").html('Editar Germen');
            $("#myModalBody").html(response);
            $("#myModal").modal('show');

            $("#germen-form").submit( function (e) {
                e.preventDefault();
                updateGermen(id);
            });

            $("#myModal").modal('show');
        }
    });
}

function deleteGermen(id)
{
    let url = getPathGermen();
    $.ajax({
        data: {}, url: url+'/'+id+'/delete',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $("#myModalTitle").html('Eliminar Germen');
            $("#myModalBody").html(response);
            $("#myModal").modal('show');

            $("#germen-form").submit( function (e) {
                e.preventDefault();
                destroyGermen(id);
            });

            $("#myModal").modal('show');
        }
    });
}

function storeGermen()
{
    params = $("#germen-form").serialize();
    url = getPathGermen();

    $.ajax({
        data: params, url: url,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            if(response.success){
                toastr.success('Germen creado', 'Bien!');
                $('#germenes-form-filtro').trigger("reset");
                verTablaGermenes();
                $("#myModal").modal('hide');
            }
        },
        error: function (request, status, error) {
            showErrosValidator(request);
        }
    });
}

function updateGermen(id)
{
    params = $("#germen-form").serialize();
    url = getPathGermen();

    $.ajax({
        data: params, url: url+'/'+id,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            if(response.success){
                toastr.success('Germen actualizado', 'Bien!');
                verTablaGermenes();
                $("#myModal").modal('hide');
            }
        },
        error: function (request, status, error) {
            showErrosValidator(request);
        }
    });
}

function destroyGermen(id)
{
    params = $("#germen-form").serialize();
    url = getPathGermen();

    $.ajax({
        data: params, url: url+'/'+id,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            if( response.success ){
                toastr.success('Germen eliminado', 'Info!');
                $('#germenes-form-filtro').trigger("reset");
                verTablaGermenes();
                $("#myModal").modal('hide');
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

