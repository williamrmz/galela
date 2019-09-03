var model="catalogoPartidas";

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
            $('#myModalTitle').html('Crear '+model);
            $('#myModalSize').addClass('modal-lg'); //options: '', 'modal-lg'
            $('#myModalBody').html(response);
            
            $('#'+model+'-form').submit( function (e) {
                e.preventDefault();
                storeItem();
            });

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

