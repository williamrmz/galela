$(document).ready(function ()
{
    ajaxConfig();
    initEventos();
    $('#'+model+'-form-search').trigger('submit');
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
        $("input[name=ftxtNroHistoria]").val("");
        $("input[name=ftxtApellidoPaterno]").val("");
        $("input[name=ftxtApellidoMaterno]").val("");
        $("input[name=ftxtDni]").val("");
        $("input[name=ftxtNroCuenta]").val("");
        $("select[name=cmbFechaTriaje]").val($("select[name=cmbFechaTriaje] option:first").val());
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
        idAtencion = $(this).siblings('input').val();
        formShow(idAtencion);
    });

    // :: Botón cancelar
    $(".btn-cancel").click( function(e)
    {
        e.preventDefault();
        openModalCrud('CANCEL');
    });

    // :: Buscar número de cuenta
    $(".btn-buscar-nrocuenta").click( function(e)
    {
        buscarNroCuenta();
    });

    // :: txtNroCuenta -> Pierde foco
    $("input[name=txtNroCuenta]").focusout( function(e)
    {
        if(this.value != "" && $("input[name=txtNroCuenta]").prop("readonly") == false)
        {
            buscarNroCuenta();
        }
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
        idAtencion = $(this).siblings('input').val();
        formEdit(idAtencion);
    });

    // :: Eliminar
    $('body').on('click', '.'+model+'-btn-delete', function (e)
    {
        e.preventDefault();
        idAtencion = $(this).siblings('input').val();
        formDelete(idAtencion);
    });


}

function formEdit(idAtencion)
{
    initForm();
    cargarDatos(idAtencion, false);
    habilitarForm(true);
    $("input[name=txtNroCuenta]").prop("readonly", true);
    $(".btn-buscar-nrocuenta").prop("disabled", true);
    openModalCrud('EDIT', idAtencion);
}

function formDelete(idAtencion) {
    initForm();
    cargarDatos(idAtencion, true);
    habilitarForm(false);
    openModalCrud('DELETE', idAtencion);
}

function buscarNroCuenta()
{
    let nroCuenta = $("input[name=txtNroCuenta]").val();
    if(nroCuenta=="")
    {
        toastr.error("Ingrese número de cuenta para poder realizar la búsqueda", "Error");
        return;
    }

    $.ajax({
        data: { nro_cuenta: nroCuenta }, url: url + '/api/service?name=getNroCuenta',
        type: 'GET', dataType: 'json',
        success: function (response)
        {
            if (response.estado)
            {
                datos = response.datos;
                $("input[name=txtNombreInformacion]").val(datos.DatosCuenta);
                $("input[name=txtPlanInformacion]").val(datos.DatosPlan);
                $("input[name=txtCitaInformacion]").val(datos.DatosProcedencia);
                $("input[name=txtTalla]").val(datos.TriajeTalla);
            } else
            {
                toastr.clear();
                toastr.error(response.mensaje, 'Error');
                $("input[name=txtNombreInformacion]").val("");
                $("input[name=txtPlanInformacion]").val("");
                $("input[name=txtCitaInformacion]").val("");
            }

        },
        error: function (request, status, error)
        {
            mostrarErrores(request);
        }
    });
}

function formShow(idAtencion)
{
    initForm();
    cargarDatos(idAtencion);
    habilitarForm(false);
    openModalCrud('SHOW');
}

function cargarDatos(idAtencion)
{
    $.ajax({
        data: {}, url: url + '/' + idAtencion,
        type: 'GET', dataType: 'json',
        success: function (response)
        {
            if(response.estado)
            {
                datos = response.datos;
                $("input[name=txtNombreInformacion]").val(datos.DatosCuenta);
                $("input[name=txtPlanInformacion]").val(datos.DatosPlan);
                $("input[name=txtCitaInformacion]").val(datos.DatosProcedencia);

                atencion = datos.atencion;

                $("input[name=txtNroCuenta]").val(atencion.idAtencion);
                $("input[name=txtPulso]").val(atencion.TriajePulso);
                $("input[name=txtTemperatura]").val(atencion.TriajeTemperatura);
                $("input[name=txtPresionArterial]").val(atencion.TriajePresion);
                $("input[name=txtFreRespiratoria]").val(atencion.TriajeFrecRespiratoria);
                $("input[name=txtTalla]").val(atencion.TriajeTalla);
                $("input[name=txtPeso]").val(atencion.TriajePeso);
            }
        }
    });
}

function mostrarErrores(request)
{
    errors = request.responseJSON.errors;
    html = '<ul>';
    for (var key in errors) {
        html += "<li>" + errors[key] + "</li>";
    }
    html += '</ul>';
    toastr.error(html, 'Error')

}

function formCreate()
{
    initForm();
    habilitarForm(true);
    openModalCrud('CREATE');
}

function initForm()
{
    $("input[name=txtNroCuenta]").val("");
    $("input[name=txtNombreInformacion]").val("");
    $("input[name=txtPlanInformacion]").val("");
    $("input[name=txtCitaInformacion]").val("");
    $("input[name=txtPulso]").val("");
    $("input[name=txtTemperatura]").val("");
    $("input[name=txtPresionArterial]").val("");
    $("input[name=txtFreRespiratoria]").val("");
    $("input[name=txtPeso]").val("");
    $("input[name=txtTalla]").val("");
    habilitarForm(false);
}

function openModalCrud(accion, IdRegistro = "")
{
    $('#listado-registro-triaje').toggle();
    $('#form-registro-triaje').toggle();
    $('#accion-' + model).val(accion);
    $('#id-' + model).val(IdRegistro);

    btn_name = '';
    btn_class = '';

    switch (accion)
    {
        case 'CREATE'   :  { btn_class = 'btn-primary'; btn_name = 'GUARDAR'; visible = true; } break;
        case 'EDIT'     :  { btn_class = 'btn-success'; btn_name = 'ACTUALIZAR'; visible = true; } break;
        case 'DELETE'   :  { btn_class = 'btn-danger'; btn_name = 'ELIMINAR'; visible = true; } break;
        case 'SHOW'     :  { btn_class = 'btn-default'; btn_name = ''; visible = false; } break;
        case 'CANCEL'   :  { btn_class = 'btn-default'; btn_name = ''; visible = false; } break;
    };

    $('.btn-save').removeClass(['btn-primary', 'btn-default', 'btn-danger', 'btn-success']).addClass([btn_class]).html(btn_name);
    visible ? $('.btn-save').show() : $('.btn-save').hide();
}

function habilitarForm(estado)
{
    $('#form-registro-triaje input').each( function() { $(this).prop('readonly', !estado) });
    $('#form-registro-triaje button').each( function() { $(this).prop('disabled', !estado) });
}

function actionSave()
{
    if($("input[name=txtNombreInformacion]").val() == "")
    {
        toastr.clear();
        toastr.error("Debe buscar los datos asociados al número de cuenta antes de realizar algún registro o modificación", "Error");
        return;
    }

    form = $('#'+model+'-form');
    data = new FormData(form[0]);

    if($("input[name=txtFreRespiratoria]").val() == "")
    {
        data.delete("txtFreRespiratoria");
    }

    if($("input[name=txtPeso]").val() == "")
    {
        data.delete("txtPeso");
    }

    if($("input[name=txtTalla]").val() == "")
    {
        data.delete("txtTalla");
    }

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
            // $(".btn-cancel").addClass('disabled');
            // $(".btn-save").addClass('disabled');
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


function listar()
{
    var cmbFecha    = $("select[name=cmbFechaTriaje]").val();
    var nroHistoria = $("input[name=ftxtNroHistoria]").val();
    var nroCuenta   = $("input[name=ftxtNroCuenta]").val();
    var dni         = $("input[name=ftxtDni]").val();
    var apePat      = $("input[name=ftxtApellidoPaterno]").val();
    var apeMat      = $("input[name=ftxtApellidoMaterno]").val();

    if(cmbFecha == "" && nroHistoria == "" && nroCuenta=="" && dni=="" && apePat=="" && apeMat == "")
    {
        toastr.clear();
        toastr.error("Ingrese al menos un campo de búsqueda", "Error");
        return;
    }

    params  = $('#'+model+'-form-search').serialize();

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
        }
    });
}