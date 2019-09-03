$(function(){
    verTablaPeriodos();

    $("#periodos-form-filtro").submit( function (e) {
        e.preventDefault();
        verTablaPeriodos();
    });

    $(".periodos-btn-limpiar").click( function (e) {
        e.preventDefault();
        $('#periodos-form-filtro').trigger("reset");
        verTablaPeriodos();
    });

    $(".periodos-btn-create").click( function (e) {
        e.preventDefault();
        createPeriodo();
    });
});

function getPathPeriodo()
{
    return $("input[name='periodos-path-ctrl']").val();
}

function verTablaPeriodos(page=1)
{
    url = getPathPeriodo();
    params  = $("#periodos-form-filtro").serialize();
    params += "&page="+page;

    $.ajax({
        data: params, url: url,
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $(".periodos-tabla").html(response);

            $(".periodos-paginator .pagination a").click( function (e) {
                e.preventDefault();
                $('.firma-paginator li').removeClass('active');
                $(this).parent('.firma-paginator li').addClass('active');
                let page=$(this).attr('href').split('page=')[1];
                verTablaPeriodos(page);
            })

            $(".periodos-btn-show").click( function (e) {
                e.preventDefault();
                id = $(this).siblings('input').val();
                showPeriodo(id);
            });

            $(".periodos-btn-sumary").click( function (e) {
                e.preventDefault();
                id = $(this).siblings('input').val();
                sumaryPeriodo(id);
            });

            $(".periodos-btn-edit").click( function (e) {
                e.preventDefault();
                id = $(this).siblings('input').val();
                editPeriodo(id);
            });
        
            $(".periodos-btn-delete").click( function (e) {
                e.preventDefault();
                id = $(this).siblings('input').val();
                deletePeriodo(id);
            });
        }
    });
}

function showPeriodo(id)
{
    url = getPathPeriodo();
    window.location.href = url + '/' + id;
}

function sumaryPeriodo(id)
{
    url = getPathPeriodo();
    window.location.href = url + '/' + id + '/sumary';
}

function createPeriodo()
{
    url = getPathPeriodo();
    $.ajax({
        data: {}, url: url+'/create',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $("#myModalTitle").html('Crear Periodo');
            $("#myModalBody").html(response);
            
            $("#periodo-form").submit( function (e) {
                e.preventDefault();
                storePeriodo();
            });

            $("#myModal").modal('show');
        }
    });
}

function editPeriodo(id)
{
    let url = getPathPeriodo();
    $.ajax({
        data: {}, url: url+'/'+id+'/edit',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $("#myModalTitle").html('Editar Periodo');
            $("#myModalBody").html(response);
            $("#myModal").modal('show');

            $("#periodo-form").submit( function (e) {
                e.preventDefault();
                updatePeriodo(id);
            });

            $("#myModal").modal('show');
        }
    });
}

function deletePeriodo(id)
{
    let url = getPathPeriodo();
    $.ajax({
        data: {}, url: url+'/'+id+'/delete',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $("#myModalTitle").html('Eliminar Periodo');
            $("#myModalBody").html(response);
            $("#myModal").modal('show');

            $("#periodo-form").submit( function (e) {
                e.preventDefault();
                destroyPeriodo(id);
            });

            $("#myModal").modal('show');
        }
    });
}

function storePeriodo()
{
    params = $("#periodo-form").serialize();
    url = getPathPeriodo();

    $.ajax({
        data: params, url: url,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            if(response.success){
                toastr.success('Periodo creado', 'Bien!');
                $('#periodos-form-filtro').trigger("reset");
                verTablaPeriodos();
                $("#myModal").modal('hide');
            }else{
                toastr.error(response.message, 'Error');
            }
        },
        error: function (request, status, error) {
            showErrosValidator(request);
        }
    });
}

function updatePeriodo(id)
{
    params = $("#periodo-form").serialize();
    url = getPathPeriodo();

    $.ajax({
        data: params, url: url+'/'+id,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            if(response.success){
                toastr.success('Periodo actualizado', 'Bien!');
                verTablaPeriodos();
                $("#myModal").modal('hide');
            }else {
                toastr.error(response.message, 'Error');
            }
        },
        error: function (request, status, error) {
            showErrosValidator(request);
        }
    });
}

function destroyPeriodo(id)
{
    params = $("#periodo-form").serialize();
    url = getPathPeriodo();

    $.ajax({
        data: params, url: url+'/'+id,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            if( response.success ){
                toastr.success('Periodo eliminado', 'Info!');
                $('#periodos-form-filtro').trigger("reset");
                verTablaPeriodos();
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

