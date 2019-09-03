$(function(){
    $("#items-form-buscar").submit( function (e) {
        e.preventDefault();
        vetTablaItems();
    });

    $(".items-btn-buscar").click( function (e) {
        e.preventDefault();
        vetTablaItems();
    });

    $(".items-btn-limpiar").click( function (e) {
        e.preventDefault();
        $(".items-input-buscar").val('');
        vetTablaItems();
    });


    $(".items-btn-create").click( function (e) {
        e.preventDefault();
        createItem();
    });

    vetTablaItems();
});

function getPath()
{
    return $("input[name='items-path-ctrl']").val();
}

function vetTablaItems(page=1)
{
    let url = getPath();
    let params = $("#items-form-buscar").serialize();
    params += '&page='+page;

    $.ajax({
        data: params, url: url,
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $(".items-tabla").html(response);

            $(".items-paginator .pagination a").click( function (e) {
                e.preventDefault();
                $('.items-paginator li').removeClass('active');
                $(this).parent('.items-paginator li').addClass('active');
                let page=$(this).attr('href').split('page=')[1];
                vetTablaItems(page);
            })

            $(".items-btn-show").click( function(e) {
                e.preventDefault();
                let id = $(this).siblings('input').val();
                showItem(id);
            });

            $(".items-btn-edit").click( function(e) {
                e.preventDefault();
                let id = $(this).siblings('input').val();
                editItem(id);
            });

            $(".items-btn-delete").click( function(e) {
                e.preventDefault();
                let id = $(this).siblings('input').val();
                deleteItem(id);
            });
        }
    });
}

function showItem(id)
{
    url = getPath();
    window.location.href = url + '/' + id;
}

function createItem()
{
    let url = getPath();
    $.ajax({
        data: {}, url: url+'/create',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $("#myModalTitle").html('Editar Item');
            $("#myModalBody").html(response);
            $("#myModal").modal('show');

            $("#item-form").submit( function (e) {
                e.preventDefault();
                storeItem();
            });
        }
    });
}

function editItem(id)
{
    let url = getPath();
    $.ajax({
        data: {}, url: url+'/'+id+'/edit',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $("#myModalTitle").html('Editar Item');
            $("#myModalBody").html(response);
            $("#myModal").modal('show');

            $("#item-form").submit( function (e) {
                e.preventDefault();
                updateItem(id);
            });
        }
    });
}

function deleteItem(id)
{
    let url = getPath();
    $.ajax({
        data: {}, url: url+'/'+id+'/delete',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $("#myModalTitle").html('Eliminar Item');
            $("#myModalBody").html(response);
            $("#myModal").modal('show');

            $("#item-form").submit( function (e) {
                e.preventDefault();
                destroyItem(id);
            });
        }
    });
}

function storeItem()
{
    params = $("#item-form").serialize();
    url = getPath();

    $.ajax({
        data: params, url: url,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            if(response.success){
                toastr.success('Item creado', 'Bien!');
                vetTablaItems();
                $("#myModal").modal('hide');
            }
        },
        error: function (request, status, error) {
            showErrosValidator(request);
        }
    });
}

function updateItem(id)
{
    params = $("#item-form").serialize();
    url = getPath();

    $.ajax({
        data: params, url: url+'/'+id,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            if(response.success){
                toastr.success('Item actualizado', 'Bien!');
                vetTablaItems();
                $("#myModal").modal('hide');
            }
        },
        error: function (request, status, error) {
            showErrosValidator(request);
        }
    });
}

function destroyItem(id)
{
    params = $("#item-form").serialize();
    url = getPath();

    $.ajax({
        data: params, url: url+'/'+id,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            if( response.success ){
                toastr.success('Item eliminado', 'Info!');
                vetTablaItems();
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

