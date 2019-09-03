$(function(){
    verTablaRefs();

    $(".refs-btn-create").click( function (e) {
        e.preventDefault();
        createRef();
    });
});

function getPath()
{
    return $("input[name='refs-path-ctrl']").val();
}

function verTablaRefs(page=1)
{
    let url = getPath();
    params = 'id_item='+$("#id_item").val();
    $.ajax({
        data: params, url: url,
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $(".refs-tabla").html(response);

            $(".refs-btn-edit").click( function (e) {
                e.preventDefault();
                id = $(this).siblings('input').val();
                editRef(id);
            });
        
            $(".refs-btn-delete").click( function (e) {
                e.preventDefault();
                id = $(this).siblings('input').val();
                deleteRef(id);
            });
        }
    });
}

function createRef()
{
    let url = getPath();
    $.ajax({
        data: {}, url: url+'/create',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $("#myModalSize").addClass('modal-lg');
            $("#myModalTitle").html('Crear Referencia');
            $("#myModalBody").html(response);
            
            $("#ref-form").submit( function (e) {
                e.preventDefault();
                storeRef();
            });

            buildForms();
            $("#valor_tipo").change( function () {
                buildForms()
            });

            $("#myModal").modal('show');
        }
    });
}

function editRef(id)
{
    let url = getPath();
    $.ajax({
        data: {}, url: url+'/'+id+'/edit',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $("#myModalSize").addClass('modal-lg');
            $("#myModalTitle").html('Editar Referencia');
            $("#myModalBody").html(response);
            $("#myModal").modal('show');

            $("#ref-form").submit( function (e) {
                e.preventDefault();
                updateRef(id);
            });

            buildForms();
            $("#valor_tipo").change( function () {
                buildForms()
            });

            $("#myModal").modal('show');
        }
    });
}

function deleteRef(id)
{
    let url = getPath();
    $.ajax({
        data: {}, url: url+'/'+id+'/delete',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $("#myModalSize").addClass('modal-lg');
            $("#myModalTitle").html('Eliminar Referencia');
            $("#myModalBody").html(response);
            $("#myModal").modal('show');

            $("#ref-form").submit( function (e) {
                e.preventDefault();
                destroyRef(id);
            });

            buildForms();
            $("#valor_tipo").change( function () {
                buildForms()
            });

            $("#myModal").modal('show');
        }
    });
}

function storeRef()
{
    params = $("#ref-form").serialize();
    params += "&id_item="+$("#id_item").val();
    url = getPath();

    $.ajax({
        data: params, url: url,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            if(response.success){
                toastr.success('Item creado', 'Bien!');
                verTablaRefs();
                $("#myModal").modal('hide');
            }
        },
        error: function (request, status, error) {
            showErrosValidator(request);
        }
    });
}

function updateRef(id)
{
    params = $("#ref-form").serialize();
    params += "&id_item="+$("#id_item").val();
    url = getPath();

    $.ajax({
        data: params, url: url+'/'+id,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            if(response.success){
                toastr.success('Item actualizado', 'Bien!');
                verTablaRefs();
                $("#myModal").modal('hide');
            }
        },
        error: function (request, status, error) {
            showErrosValidator(request);
        }
    });
}

function destroyRef(id)
{
    params = $("#ref-form").serialize();
    params += "&id_item="+$("#id_item").val();
    url = getPath();

    $.ajax({
        data: params, url: url+'/'+id,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            if( response.success ){
                toastr.success('Referencia eliminada', 'Info!');
                verTablaRefs();
                $("#myModal").modal('hide');
            }else {
                toastr.error(response.message, 'Error');
            }
        }
    });
}

//configura(show, hide) los formularios de acuerdo a la opcion tipo
function buildForms(){

    tipo = $("#valor_tipo").val();
    if(tipo == 'N'){
        $(".rango-valor-numero").show();
        $(".rango-valor-texto").hide();

        $(".rango-alerta-numero").show();
        $(".rango-alerta-texto").hide();
    }else{
        $(".rango-valor-numero").hide();
        $(".rango-valor-texto").show();

        $(".rango-alerta-numero").hide();
        $(".rango-alerta-texto").show();
    }
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

