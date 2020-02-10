// Se ejecuta cuando carga la página
$(document).ready(function ()
{
    ajaxConfig();
    listar();
    initEventos();
    initForm();
});

function initEventos()
{
    // :: Se ejecuta al presionar en el boton de busqueda
    $('#'+model+'-form-search').submit( function(e)
    {
        e.preventDefault();
        listar();
    });

    // :: Limpiar búsqueda
    $('#'+model+'-btn-clear').click( function(e)
    {
        e.preventDefault();
        $("input[name=search]").val("");
        listar();
    });

    // :: Botón crear <- Muestra el formulario para crear un paciente
    $('#'+model+'-btn-create').click( function (e)
    {
        e.preventDefault();
        formCreate();
    });

    // :: Botón mostrar
    $('body').on('click', '.'+model+'-btn-show', function (e)
    {
        e.preventDefault();
        idTurno = $(this).siblings('input').val();
        formShow(idTurno);
    });

    // :: Botón cancelar
    $(".btn-cancel").click( function(e)
    {
        e.preventDefault();
        openModalCrud('CANCEL');
    });

    // :: Guarda o actualiza el registro del paciente
    $('body').on('click', '.btn-save', function (e)
    {
        e.preventDefault();
        actionSave();
    });

    // :: Editar
    $('body').on('click', '.'+model+'-btn-edit', function (e)
    {
        e.preventDefault();
        idTurno = $(this).siblings('input').val();
        formEdit(idTurno);
    });

    // :: Eliminar
    $('body').on('click', '.'+model+'-btn-delete', function (e)
    {
        e.preventDefault();
        idTurno = $(this).siblings('input').val();
        formDelete(idTurno);
    });
}

function actionSave()
{
    form = $('#'+model+'-form');
    data = new FormData(form[0]);
    idTurno = ($("#id-"+model).val()=="0")?undefined:$("#id-"+model).val();
    accion = $("#accion-"+model).val().toUpperCase();
    var urlTemp = url;
    if ( accion == 'EDIT')
    {
        urlTemp += '/'+idTurno;
        data.append('_method', 'PUT');
    } else if ( accion == 'DELETE')
    {
        urlTemp += '/'+idTurno;
        data.append('_method', 'DELETE');
    }

    $.ajax({
        data: data, url: urlTemp, contentType: false, cache: false, processData:false,
        type:  'POST', dataType: 'json',
        beforeSend: function(){
            $(".btn-cancel").addClass('disabled');
            $(".btn-save").addClass('disabled');
            $(".btn-save").html('<i class="fa fa-spinner fa-spin"></i> ESPERE');
        },
        success:  function (response)
        {
            if( response.estado)
            {
                toastr.success( response.mensaje, 'Información');
                $('#'+model+'-btn-clear').trigger("click");
                openModalCrud('CANCEL');
            }else
            {
                toastr.error( response.mensaje, 'Error');
            }

        },
        error: function (request, status, error)
        {
            mostrarErrores(request);
        },
        complete: function( jqXHR, textStatus ){
            $(".btn-cancel").removeClass('disabled');
            $(".btn-save").removeClass('disabled');
            $(".btn-save").html('GUARDAR');
        }
    });
}

function mostrarErrores(request)
{
    errors = request.responseJSON.errors;
    html = '<ul>';
    for (var key in errors)
    {
        html += "<li>" + errors[key] + "</li>";
    }
    html += '</ul>';
    toastr.error(html, 'Error')

}

function initForm()
{
    $("input[name=txtCodigo]").val("");
    $("input[name=txtDescripcion]").val("");
    $("select[name=cmbIdTipoServicio]").val("1");
    $("input[name=txtHoraInicio]").val("");
    $("input[name=txtHoraFin]").val("");
    habilitarForm(false);
}

function formCreate()
{
    initForm();
    habilitarForm(true);
    openModalCrud('CREATE');
}

function formShow(idTurno)
{
    initForm();
    cargarDatos(idTurno);
    habilitarForm(false);
    openModalCrud('SHOW');
}

function formEdit(idTurno)
{
    initForm();
    cargarDatos(idTurno);
    habilitarForm(true);
    openModalCrud('EDIT', idTurno);
}

function formDelete(idTurno)
{
    initForm();
    cargarDatos(idTurno);
    habilitarForm(false);
    openModalCrud('DELETE', idTurno);
}



function habilitarForm(estado)
{
    $('#form-turno input').each( function() { $(this).prop('readonly', !estado) });
    $('#form-turno select').each( function() { $(this).prop('disabled', !estado) });
}

function cargarDatos(idTurno)
{
    $.ajax({
        data: {}, url: url+'/'+idTurno,
        type:  'GET', dataType: 'json',
        success:  function (response)
        {
            console.log(response);
            $("input[name=txtCodigo]").val(response.Codigo);
            $("input[name=txtDescripcion]").val(response.Descripcion);
            $("select[name=cmbIdTipoServicio]").val(response.IdTipoServicio);
            $("input[name=txtHoraInicio]").val(response.HoraInicio);
            $("input[name=txtHoraFin]").val(response.HoraFin);
        }
    });
}

// Configuración para apertura del formulario
function openModalCrud(accion, idTurno = 0)
{
    $('#listado-turno').toggle();
    $('#form-turno').toggle();
    $('#accion-'+model).val(accion);
    $('#id-'+model).val(idTurno);

    btn_name = '';
    btn_class = '';

    if( accion == 'CREATE' ) {

        btn_class = 'btn-primary';
        btn_name = 'GUARDAR';
        visible = true;
    }

    if( accion == 'EDIT' ) {
        btn_class = 'btn-success';
        btn_name = 'ACTUALIZAR';
        visible = true;
    }

    if( accion == 'DELETE' ) {
        btn_class = 'btn-danger';
        btn_name = 'ELIMINAR';
        visible = true;
    }

    if( accion == 'SHOW' ) {
        btn_class = 'btn-default';
        btn_name = 'SHOW';
        visible = false;
    }

    if( accion == 'CANCEL' )
    {
        btn_class = 'btn-success';
        btn_name = 'CANCEL';
        visible = false;
    }
    $('.btn-save').removeClass( ['btn-primary', 'btn-default', 'btn-danger', 'btn-success'] ).addClass( [btn_class] ).html( btn_name);
    visible? $('.btn-save').show(): $('.btn-save').hide();
}

// Listar
function listar(nPagina=1)
{
    params  = $('#'+model+'-form-search').serialize();
    params += "&page="+nPagina;

    $.ajax({
        data: params, url: url,
        type:  'GET', dataType: 'html',
        beforeSend: function()
        {
            $('.'+model+'-tbody').html('<tr> <td colspan="12" class="text-center"> <i class="text-blue fa fa-refresh fa-spin"></i> Buscando... </td> </tr>');
        },
        success:  function (response)
        {
            $('.'+model+'-table').html(response);

            $('.'+model+'-paginator .pagination a').click( function (e)
            {
                e.preventDefault();
                $('.firma-paginator li').removeClass('active');
                $(this).parent('.firma-paginator li').addClass('active');
                let page=$(this).attr('href').split('page=')[1];
                listar(page);
            })
        }
    });
}

