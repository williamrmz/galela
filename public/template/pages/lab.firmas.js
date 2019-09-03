$(function(){
    $("#firmas-form-buscar").submit( function (e) {
        e.preventDefault();
        verTablaFirmas();
    });

    $(".firmas-btn-buscar").click( function (e) {
        e.preventDefault();
        verTablaFirmas();
    });

    $(".firmas-btn-limpiar").click( function (e) {
        e.preventDefault();
        $(".firmas-input-buscar").val('');
        verTablaFirmas();
    });

    verTablaFirmas();
});

function getPath()
{
    return $("input[name='firmas-path-ctrl']").val();
}

function verTablaFirmas(page=1)
{
    let url = getPath();
    let params = $("#firmas-form-buscar").serialize();
    params += '&page='+page;

    $.ajax({
        data: params, url: url,
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $(".firmas-tabla").html(response);

            $(".firma-paginator .pagination a").click( function (e) {
                e.preventDefault();
                $('.firma-paginator li').removeClass('active');
                $(this).parent('.firma-paginator li').addClass('active');
                let page=$(this).attr('href').split('page=')[1];
                verTablaFirmas(page);
            })

            $(".firmas-btn-edit").click( function(e) {
                e.preventDefault();
                let id = $(this).siblings('input').val();
                editFirma(id);
            });

            $(".firmas-btn-delete").click( function(e) {
                e.preventDefault();
                let id = $(this).siblings('input').val();
                deleteFirma(id);
            });
        }
    });
}

function editFirma(id)
{
    let url = getPath();
    $.ajax({
        data: {}, url: url+'/'+id+'/edit',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $("#myModalTitle").html('Editar Firma');
            $("#myModalBody").html(response);
            $("#myModal").modal('show');

            $("input[name='firma']").change((e) => { addImage(e); });

            $("#firma-form").submit( function (e) {
                e.preventDefault();
                updateFirma(id);
            });
        }
    });
}

function deleteFirma(id)
{
    let url = getPath();
    $.ajax({
        data: {}, url: url+'/'+id+'/delete',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $("#myModalTitle").html('Editar Firma');
            $("#myModalBody").html(response);
            $("#myModal").modal('show');

            $("#firma-form").submit( function (e) {
                e.preventDefault();
                destroyFirma(id);
            });
        }
    });
}

function updateFirma(id)
{
    let firma = $("input[name='firma']")[0].files[0];
    var formData = new FormData();
    formData.append('firma', firma);
    formData.append('_method', 'PUT');
    let url = getPath();

    $.ajax({
        headers: {
            'X-CSRF-Token': $('input[name=_token]').val(),
        },
        data: formData, url: url+'/'+id,
        type:  'POST', dataType: 'json',
        contentType: false, processData: false,
        success:  function (response) {
            if(response.success){
                toastr.success('Firma actualizada', 'Bien!');
                verTablaFirmas();
                $("#myModal").modal('hide');
            }
        },
        error: function (request, status, error) {
            errors = request.responseJSON.errors;
            html = '<ul>';
            for (var key in errors) {
                html += "<li>" + key + ": " + errors[key] + "</li>";
            }
            html += '</ul>';
            toastr.error(html, 'Error')
        }
    });
}

function destroyFirma(id)
{
    params = $("#firma-form").serialize();
    url = getPath();

    $.ajax({
        data: params, url: url+'/'+id,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            if( response.success ){
                toastr.success('Firma eliminada', 'Info!');
                verTablaFirmas();
                $("#myModal").modal('hide');
            }
        }
    });
}

function addImage(e){
    var file = e.target.files[0],
    imageType = /image.*/;

    if (!file.type.match(imageType))
        return;

    var reader = new FileReader();
        reader.onload = fileOnload;
        reader.readAsDataURL(file);
}

function fileOnload(e) {
    var result=e.target.result;
    $('#photo-preview').attr("src",result);
}
