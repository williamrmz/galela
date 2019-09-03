$(function(){
    verTablaAntibioticos();

    $("#antibioticos-form-filtro").submit( function(e) {
        e.preventDefault();
        verTablaAntibioticos();
    });

    $(".antibioticos-btn-limpiar").click( function(e) {
        e.preventDefault();
        $('#antibioticos-form-filtro').trigger("reset");
        verTablaAntibioticos();
    });

    $(".antibioticos-btn-create").click( function (e) {
        e.preventDefault();
        createAntibiotico();
    });
});

function getPathAntibiotico()
{
    return $("input[name='antibioticos-path-ctrl']").val();
}

function verTablaAntibioticos(page=1)
{
    url = getPathAntibiotico();
    params  = $("#antibioticos-form-filtro").serialize();
    params += "&page="+page;

    $.ajax({
        data: params, url: url,
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $(".antibioticos-tabla").html(response);

            $(".antibioticos-paginator .pagination a").click( function (e) {
                e.preventDefault();
                $('.firma-paginator li').removeClass('active');
                $(this).parent('.firma-paginator li').addClass('active');
                let page=$(this).attr('href').split('page=')[1];
                verTablaAntibioticos(page);
            })

            $(".antibioticos-btn-edit").click( function (e) {
                e.preventDefault();
                id = $(this).siblings('input').val();
                editAntibiotico(id);
            });
        
            $(".antibioticos-btn-delete").click( function (e) {
                e.preventDefault();
                id = $(this).siblings('input').val();
                deleteAntibiotico(id);
            });
        }
    });
}

function createAntibiotico()
{
    let url = getPathAntibiotico();
    $.ajax({
        data: {}, url: url+'/create',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $("#myModalTitle").html('Crear Antibiotico');
            $("#myModalBody").html(response);
            
            $("#antibiotico-form").submit( function (e) {
                e.preventDefault();
                storeAntibiotico();
            });

            $("#myModal").modal('show');
        }
    });
}

function editAntibiotico(id)
{
    let url = getPathAntibiotico();
    $.ajax({
        data: {}, url: url+'/'+id+'/edit',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $("#myModalTitle").html('Editar Antibiotico');
            $("#myModalBody").html(response);
            $("#myModal").modal('show');

            $("#antibiotico-form").submit( function (e) {
                e.preventDefault();
                updateAntibiotico(id);
            });

            $("#myModal").modal('show');
        }
    });
}

function deleteAntibiotico(id)
{
    let url = getPathAntibiotico();
    $.ajax({
        data: {}, url: url+'/'+id+'/delete',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $("#myModalTitle").html('Eliminar Antibiotico');
            $("#myModalBody").html(response);
            $("#myModal").modal('show');

            $("#antibiotico-form").submit( function (e) {
                e.preventDefault();
                destroyAntibiotico(id);
            });

            $("#myModal").modal('show');
        }
    });
}

function storeAntibiotico()
{
    params = $("#antibiotico-form").serialize();
    url = getPathAntibiotico();

    $.ajax({
        data: params, url: url,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            if(response.success){
                toastr.success('Antibiotico creado', 'Bien!');
                $('#antibioticos-form-filtro').trigger("reset");
                verTablaAntibioticos();
                $("#myModal").modal('hide');
            }
        },
        error: function (request, status, error) {
            showErrosValidator(request);
        }
    });
}

function updateAntibiotico(id)
{
    params = $("#antibiotico-form").serialize();
    url = getPathAntibiotico();

    $.ajax({
        data: params, url: url+'/'+id,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            if(response.success){
                toastr.success('Antibiotico actualizado', 'Bien!');
                verTablaAntibioticos();
                $("#myModal").modal('hide');
            }
        },
        error: function (request, status, error) {
            showErrosValidator(request);
        }
    });
}

function destroyAntibiotico(id)
{
    params = $("#antibiotico-form").serialize();
    url = getPathAntibiotico();

    $.ajax({
        data: params, url: url+'/'+id,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            if( response.success ){
                toastr.success('Antibiotico eliminado', 'Info!');
                $('#antibioticos-form-filtro').trigger("reset");
                verTablaAntibioticos();
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

