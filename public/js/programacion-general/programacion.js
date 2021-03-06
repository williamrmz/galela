var fechaSeleccion = "";

// Se ejecuta cuando carga la página
$(document).ready(function ()
{
    ajaxConfig();
    initEventos();
    initForm();
    cargarComboDepartamento();
    cargarCalendario();
});

function initEventos()
{
    // :: Cada vez que cambia departamentos, traer especialidades
    $('select[name="fcmbIdDepartamento"]').on('select2:select', function (e) {
        cargarComboEspecialidad();
    });

    // :: Cada vez que cambia especialidades, traer medicos
    $('select[name="fcmbIdEspecialidad"]').on('select2:select', function (e) {
        cargarComboMedicos();
    });

    // :: Cada vez que cambie medico, traer programacion dia
    $('select[name=fcmbIdMedico]').on('select2:select', function (e)
    {
        cargarProgramacionDia();
        cargarProgramacionMes();
    });

    // :: Botón crear <- Muestra el formulario para crear un paciente
    $('#' + model + '-btn-create').click(function (e) {
        e.preventDefault();
        formCreate();
    });

    // :: Editar
    $('body').on('click', '.' + model + '-btn-edit', function (e) {
        e.preventDefault();
        idProgramacion = $(this).siblings('input').val();
        var respuesta = puedeModificarseoEliminar(idProgramacion);
        if (respuesta == true)
        {
            formEdit(idProgramacion);
        }
    });

    // :: Eliminar
    $('body').on('click', '.' + model + '-btn-delete', function (e) {
        e.preventDefault();
        idProgramacion = $(this).siblings('input').val();
        var respuesta = puedeModificarseoEliminar(idProgramacion);
        if (respuesta == true)
        {
            formDelete(idProgramacion);
        }
    });

    // :: Botón cancelar
    $(".btn-cancel").click(function (e) {
        e.preventDefault();
        openModalCrud('CANCEL');
    });

    // :: Guarda o actualiza el registro del paciente
    $('body').on('click', '.btn-save', function (e) {
        e.preventDefault();
        actionSave();
    });

    // :: Botón mostrar
    $('body').on('click', '.' + model + '-btn-show', function (e) {
        e.preventDefault();
        idProgramacion = $(this).siblings('input').val();
        formShow(idProgramacion);
    });

    // :: Cada vez que cambie tipo de servicio, cargar combo turno
    $('select[name=cmbIdTipoServicio]').on('select2:select', function (e)
    {
        // Desactivar combo turno si el valor de IdTipoServicio es:  5, 6, 7
        var id = $('select[name=cmbIdTipoServicio]').val();
        var opciones = ["5", "6", "7"];
        var activarCombo = ($.inArray(id, opciones) < 0 )?true:false;
        $('select[name="cmbIdServicio"]').prop('disabled', !activarCombo);

        // Cargar turnos
        cargarComboTurnoPorTipoServicio();
    });

    // :: Cada vez que cambie turno, cargar hora inicio y fin
    $('select[name=cmbIdTurno]').on('select2:select', function (e)
    {
        cargarHora();
    });

    // :: Cada vez que cambie especialidad, cargar servicios
    $('select[name=cmbIdEspecialidad]').on('select2:select', function (e)
    {
        cargarServicioPorEspecialidad();
    });

    // ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    // Eventos de calendario
    // ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    $('select[name=cmbMes],select[name=cmbAnio]').change(function (e) {
        cargarCalendario();
    });
}

function puedeModificarseoEliminar(IdProgramacion)
{
    var rpta = false;

    $.ajax({
        data: {IdProgramacion: IdProgramacion}, url: url + '/api/service?name=puedeModificarse',
        async: false,
        type: 'GET', dataType: 'json',
        success: function (data)
        {
            if(data.estado == true)
            {
                rpta = true;
            }
            else
            {
                toastr.error(data.mensaje, "Error");
                rpta = false;
            }
        },
        error: function (request, status, error)
        {
            rpta = false;
        }
    });

    return rpta;
}

function actionSave()
{
    form = $('#' + model + '-form');
    data = new FormData(form[0]);
    accion = $("#accion-programacion").val();
    id = ($("#id-" + model).val() == "") ? undefined : $("#id-" + model).val();

    // Agregar campos al request
    cmbIdDepartamento = $("select[name=fcmbIdDepartamento]").val();
    data.append("cmbIdDepartamento", cmbIdDepartamento);

    var urlTemp = url;

    if (accion == 'EDIT')
    {
        urlTemp += '/' + id;
        data.append('_method', 'PUT');
    } else if (accion == 'DELETE') {
        urlTemp += '/' + id;
        data.append('_method', 'DELETE');
    }

    $.ajax({
        data: data, url: urlTemp, contentType: false, cache: false, processData: false,
        type: 'POST', dataType: 'json',
        beforeSend: function ()
        {
            /*
                        $(".btn-cancel").addClass('disabled');
                        $(".btn-save").addClass('disabled');

             */
            $(".btn-save").html('<i class="fa fa-spinner fa-spin"></i> ESPERE');
        },
        success: function (response)
        {
            if (response.estado)
            {
                cargarProgramacionDia();
                cargarProgramacionMes();
                toastr.success(response.mensaje, 'Información');
                $('#' + model + '-btn-clear').trigger("click");
                openModalCrud('CANCEL');
            } else {
                toastr.error(response.mensaje, 'Error');
            }

        },
        error: function (request, status, error)
        {
            mostrarErrores(request);
        },
        complete: function (jqXHR, textStatus) {
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
    for (var key in errors) {
        html += "<li>" + errors[key] + "</li>";
    }
    html += '</ul>';
    toastr.error(html, 'Error')

}

function formCreate()
{
    initForm();

    // Verificar que haya seleccionado un medico
    if($("input[name=txtIdMedico]").val() == "")
    {
        toastr.error("Seleccione un médico en los filtros de búsqueda antes de continuar", "");
        return;
    }

    habilitarForm(true);
    openModalCrud('CREATE');
}

function formEdit(IdProgramacion)
{
    initForm();
    cargarDatos(IdProgramacion, false);
    habilitarForm(true);

    // Bloquear campos
    $("input[name=txtFechaInicio]").prop('readonly', true);
    $("input[name=txtFechaFin]").prop('readonly', true);

    openModalCrud('EDIT', IdProgramacion);
}

function formShow(IdProgramacion)
{
    initForm();
    cargarDatos(IdProgramacion);
    habilitarForm(false);
    openModalCrud('SHOW');
}

function formDelete(IdProgramacion) {
    initForm();
    cargarDatos(IdProgramacion, true);
    habilitarForm(false);
    openModalCrud('DELETE', IdProgramacion);
}

function cargarDatos(IdProgramacion)
{
    $.ajax({
        data: {}, url: url + '/' + IdProgramacion,
        type: 'GET', dataType: 'json',
        success: function (response)
        {

            var form = response;
            var programacion = form.programacion;
            var fcmbIdDepartamento = form.fcmbIdDepartamento;
            var fcmbIdEspecialidad = form.fcmbIdEspecialidad;
            var fcmbIdMedico = form.fcmbIdMedico;

            var cmbIdTipoProgramacion = form.cmbIdTipoProgramacion;
            var cmbIdTipoServicio = form.cmbIdTipoServicio;
            var cmbIdEspecialidad = form.cmbIdEspecialidad;
            var cmbIdServicio = form.cmbIdServicio;
            var cmbIdTurno = form.cmbIdTurno;

            // Cargar opcion vacio( "..." ) a los combos en el inicio
            fcmbIdDepartamento.unshift(opcionBlanco);
            fcmbIdEspecialidad.unshift(opcionBlanco);
            fcmbIdMedico.unshift(opcionBlanco);
            cmbIdTipoProgramacion.unshift(opcionBlanco);
            cmbIdTipoServicio.unshift(opcionBlanco);
            cmbIdEspecialidad.unshift(opcionBlanco);
            cmbIdServicio.unshift(opcionBlanco);
            cmbIdTurno.unshift(opcionBlanco);

            // Mostrar informacion en los combos, y aplicar plugin select2
            $('select[name="fcmbIdDepartamento"]').select2({data: fcmbIdDepartamento});
            $('select[name="fcmbIdEspecialidad"]').select2({data: fcmbIdEspecialidad});
            $('select[name="fcmbIdMedico"]').select2({data: fcmbIdMedico});

            $('select[name="cmbIdTipoProgramacion"]').select2({data: cmbIdTipoProgramacion});
            $('select[name="cmbIdTipoServicio"]').select2({data: cmbIdTipoServicio});
            $('select[name="cmbIdEspecialidad"]').select2({data: cmbIdEspecialidad});
            $('select[name="cmbIdServicio"]').select2({data: cmbIdServicio});
            $('select[name="cmbIdTurno"]').select2({data: cmbIdTurno});

            // Agregar datos y seleccion

            $("input[name=txtIdMedico]").val(programacion.IdMedico);
            $("input[name=txtNombreMedico]").val(programacion.NombreMedico);
            $("input[name=txtFechaInicio]").val(programacion.Fecha);
            $("input[name=txtFechaFin]").val(programacion.Fecha);
            $("input[name=txtColor]").val(programacion.Color);
            $("input[name=txtHoraInicio]").val(programacion.HoraInicio);
            $("input[name=txtHoraFin]").val(programacion.HoraFin);
            $("input[name=txtDescripcion]").val(programacion.Descripcion);

            // Cargar combos de manera progresiva

            $('select[name="fcmbIdDepartamento"]').val(programacion.IdDepartamento).trigger('change');
            $('select[name="fcmbIdEspecialidad"]').val(programacion.IdEspecialidad).trigger('change');
            $('select[name="fcmbIdMedico"]').val(programacion.IdMedico).trigger('change');

            $("select[name=fcmbIdDepartamento]").val(programacion.IdTipoServicio).trigger('change');
            $("select[name=cmbIdTipoServicio]").val(programacion.IdTipoServicio).trigger('change');
            $("select[name=cmbIdEspecialidad]").val(programacion.IdEspecialidad).trigger('change');
            $("select[name=cmbIdServicio]").val(programacion.IdServicio).trigger('change');
            $("select[name=cmbIdTipoProgramacion]").val(programacion.IdTipoProgramacion).trigger('change');
            $("select[name=cmbIdTurno]").val(programacion.IdTurno).trigger('change');
        }
    });
}

function cargarHora()
{
    var IdTurno = $('select[name=cmbIdTurno]').val();
    if (IdTurno != null && IdTurno != "" && IdTurno != undefined)
    {
        var regSeleccionado = $('select[name="cmbIdTurno"]').select2('data')[0];
        $("input[name=txtHoraInicio]").val(regSeleccionado.HoraInicio);
        $("input[name=txtHoraFin]").val(regSeleccionado.HoraFin);
    }
}

function habilitarForm(estado)
{
    $('#form-programacion input').each(function () {
        $(this).prop('readonly', !estado)
    });
    $('#form-programacion select').each(function () {
        $(this).prop('disabled', !estado)
    });

    $("input[name=txtNombreMedico]").prop('readonly', true);
}

function initForm()
{
    $("input[name=id-programacion]").val("");
    $("input[name=txtIdMedico]").val("");
    $("input[name=txtNombreMedico]").val("");
    $("input[name=txtFechaInicio]").val("");
    $("input[name=txtFechaFin]").val("");
    $("input[name=txtHoraInicio]").val("");
    $("input[name=txtHoraFin]").val("");
    $("input[name=txtDescripcion]").val("");
    $("input[name=txtColor]").val("#FFFFFF");

    $("select[name=cmbIdTipoServicio]").html("");
    $("select[name=cmbIdEspecialidad]").html("");
    $("select[name=cmbIdServicio]").html("");
    $("select[name=cmbIdTipoProgramacion]").html("");
    $("select[name=cmbIdTurno]").html("");

    copiarDatosMedicosForm();
    cargarCombos();
    habilitarForm(true);
}

function cargarCombos()
{
    var idMedico = $("input[name=txtIdMedico]").val();

    if(idMedico=="") { return; }

    $.ajax({
        data: {IdMedico: idMedico}, url: url + '/api/service?name=getDataForms',
        type: 'GET', dataType: 'json',
        success: function (data)
        {

            var form = data;

            // Cargar opcion vacio( "..." ) a los combos en el inicio
            form.cmbIdTipoProgramacion.unshift(opcionBlanco);
            form.cmbIdTipoServicio.unshift(opcionBlanco);
            form.cmbIdEspecialidad.unshift(opcionBlanco);

            // Mostrar informacion en los combos, y aplicar plugin select2
            $('select[name="cmbIdTipoProgramacion"]').select2({data: form.cmbIdTipoProgramacion});
            $('select[name="cmbIdTipoServicio"]').select2({data: form.cmbIdTipoServicio});
            $('select[name="cmbIdEspecialidad"]').select2({data: form.cmbIdEspecialidad});
            $('input[name="txtFechaInicio"]').val(fechaSeleccion);
            $('input[name="txtFechaFin"]').val(fechaSeleccion);
        }
    });

}

function openModalCrud(accion, IdProgramacion = "")
{
    $('#listado-programacion').toggle();
    $('#form-programacion').toggle();
    $('#accion-' + model).val(accion);
    $('#id-' + model).val(IdProgramacion);

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


function cargarComboDepartamento()
{
    $.ajax({
        data: {}, url: url + '/api/service?name=getDepartamentos',
        type: 'GET', dataType: 'json',
        success: function (data)
        {
            var form = data;
            form.unshift(opcionBlanco);
            $('select[name="fcmbIdDepartamento"]').select2({data: form});
            $('select[name=fcmbIdEspecialidad]').html('');
            $('select[name=fcmbIdMedico]').html('');
        }
    });
}

function cargarComboEspecialidad()
{
    var IdDepartamento = $("select[name=fcmbIdDepartamento]").val();

    if(IdDepartamento=="")
    {
        $('select[name=fcmbIdEspecialidad]').html('');
        $('select[name=fcmbIdMedico]').html('');
        return;
    }

    $.ajax({
        data: {IdDepartamento: IdDepartamento}, url: url + '/api/service?name=getEspecialidades',
        type: 'GET', dataType: 'json',
        success: function (data)
        {
            var form = data;
            form.unshift(opcionBlanco);
            $('select[name="fcmbIdEspecialidad"]').html('').select2({data: form});
            $('select[name=fcmbIdMedico]').html('');
        }
    });
}

function cargarComboMedicos()
{
    var IdDepartamento = $("select[name=fcmbIdDepartamento]").val();
    var IdEspecialidad = $("select[name=fcmbIdEspecialidad]").val();

    $.ajax({
        data: {IdDepartamento: IdDepartamento, IdEspecialidad: IdEspecialidad}, url: url + '/api/service?name=getMedicos',
        type: 'GET', dataType: 'json',
        success: function (data)
        {
            var form = data;
            form.unshift(opcionBlanco);
            $('select[name=fcmbIdMedico]').html('');
            $('select[name="fcmbIdMedico"]').select2({data: form});

        }
    });
}

function cargarProgramacionDia()
{
    var IdMedico = $("select[name=fcmbIdMedico]").val();
    copiarDatosMedicosForm();

    $.ajax({
        data: {IdMedico: IdMedico, Fecha: fechaSeleccion}, url: url + '/api/service?name=getProgramacionDia',
        type: 'GET', dataType: 'html',
        beforeSend: function()
        {
            $(".listado-dia-programacion").html('<div class="text-center"><i class="text-blue fa fa-refresh fa-spin"></i> Buscando...</div>');
        },
        success: function (response)
        {
            $(".listado-dia-programacion").html(response);
        }
    });
}

function copiarDatosMedicosForm()
{
    var IdMedico    = $("select[name=fcmbIdMedico]").val();
    var nombre      = "";
    if(IdMedico != null && IdMedico!="" && IdMedico!=undefined)
    {
        nombre = $('select[name="fcmbIdMedico"]').select2('data')[0].text;
    }
    else
    {
        nombre = "";
    }

    $("input[name=txtIdMedico]").val(IdMedico);
    $("input[name=txtNombreMedico]").val(nombre);
}

function cargarComboTurnoPorTipoServicio()
{
    var IdTipoServicio = $("select[name=cmbIdTipoServicio]").val();

    $.ajax({
        data: {IdTipoServicio: IdTipoServicio}, url: url + '/api/service?name=getTurnos',
        type: 'GET', dataType: 'json',
        success: function (data)
        {
            var form = data;
            form.unshift(opcionBlanco);
            $('select[name="cmbIdTurno"]').html('');
            $('select[name="cmbIdTurno"]').select2({data: form});
        }
    });

}

function cargarServicioPorEspecialidad()
{
    var IdEspecialidad = $("select[name=cmbIdEspecialidad]").val();

    $.ajax({
        data: {IdEspecialidad: IdEspecialidad}, url: url + '/api/service?name=getServicios',
        type: 'GET', dataType: 'json',
        success: function (data)
        {
            var form = data;
            form.unshift(opcionBlanco);
            $('select[name="cmbIdServicio"]').html('');
            $('select[name="cmbIdServicio"]').select2({data: form});
        }
    });

}

// ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Funciones relacionadas a calendario
// ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function cargarCalendario()
{
    var IdMes       = $("select[name=cmbMes]").val();
    var IdAnio      = $("select[name=cmbAnio]").val();
    var fecha       = '01-'+IdMes+'-'+IdAnio;
    var urlTemp     = url +'/api/service?name=getCalendario';

    $.ajax({
        data: { Fecha:fecha }, url: urlTemp,
        type:  'GET', dataType: 'json',
        success:  function (response)
        {
            renderizarCalendario( response );
        }
    });
}

function renderizarCalendario( calendario )
{
    html = '';
    let loop = 1;

    // ::: Si ya existe fecha de seleccion previa
    if(fechaSeleccion != "")
    {
        // :: Indicar que el dia de la fecha seleccion debe mantener
        let dia = fechaSeleccion.split("-")[2];
        calendario.sistema_dia_actual = dia;
        calendario.sistema_mes_actual = calendario.mes_actual;
        calendario.sistema_anio_actual = calendario.anio_actual;
        calendario.sistema_fecha_actual = calendario.anio_actual +"-"+ calendario.mes_actual +"-"+ dia;
    }

    calendario.dias.forEach(item =>
    {

        // console.log( item );
        if( loop == 1) html += '<tr>';

        html += '<td style="padding:0" align="center">';
        if( item.valido )
        {
            var seleccion = "";

            if(calendario.sistema_anio_actual == calendario.anio_actual && calendario.sistema_mes_actual == calendario.mes_actual && calendario.sistema_dia_actual == item.dia)
            {
                fechaSeleccion = calendario.sistema_fecha_actual;
                seleccion = "btn-warning";
            }

            html += '<div class="btn btn-default btn-block btn-dia '+seleccion+'" style="padding:1px;">';
            html += '<input type="hidden" class="dia-data" value=\''+JSON.stringify(item)+'\'>';
            html += '<input type="hidden" class="prog-index prog-index-'+item.dia+'" value="">';
            html += '<table >';
            html += '<tr height="50px;">';
            html += '<td style="width:30px;">';
            html += '<div class="label label-primary" id="dia-numero-'+item.dia+'" style="width:100px">'+item.dia+'</div> ';
            html += '</td>';
            html += '<td style="width:0px;"></td>';
            html += '</tr>';
            html += '<tr height="22px;">';
            html += '<td colspan="2" width="53px;"> ';
            html += '<i class="dia-icon dia-icon-'+item.dia+'"></i>';
            html += '<span class="dia-programacion dia-programacion-'+item.dia+'"></span>';
            html += '</td>';
            html += '</tr>';
            html += '</table>';
            html += '</div>';
        }
        html += '</td>';

        loop++

        if( loop == 8) { html += '</tr>'; loop=1; }
    });


    $('#tbody-calendario').html( html );

    $('.btn-dia').click( function() { calClick( $(this) ); });

    // Listar programacion si existe medico seleccionado y fechaSeleccion
    let IdMedico = $("select[name=fcmbIdMedico]").val();

    if(IdMedico != "" && IdMedico != null && fechaSeleccion != "")
    {
        cargarProgramacionDia();
        cargarProgramacionMes();
    }
}

function leftPad(value, length)
{
    return ('0'.repeat(length) + value).slice(-length);
}

function cargarProgramacionMes()
{
    let IdMedico = $("select[name=fcmbIdMedico]").val();
    let mes = $('select[name=cmbMes]').val();
    let anio = $('select[name=cmbAnio]').val();

    $.ajax({
        data: { IdMedico: IdMedico, mes: mes, anio: anio}, url: url + '/api/service?name=cargarProgramacionMes',
        type:  'GET', dataType: 'json',
        success:  function (response)
        {
            renderProg( response );
        }
    });
}

function calClick( btn )
{
    // Remover clave warning de todos los botones
    $('.btn-dia').each( function() {  $(this).removeClass('btn-warning'); });
    // Agregar clase sobre la opcion en la cual se hizo click
    btn.addClass('btn-warning');

    // Obtener la informacion del dia
    let infoDia = btn.find('.dia-data').val();
    // Obtener dia del mes|
    let dia = JSON.parse(infoDia).dia;
    dia = leftPad(dia, 2);

    // Construir fecha
    let anio = $("select[name=cmbAnio]").val();
    let mes = $("select[name=cmbMes]").val();
    let fecha = anio +"-"+ mes +"-"+ dia;
    fechaSeleccion = anio+"-"+mes+"-"+dia;

    // :: Verificar que haya seleccionado un medico para cargar la programacion del dia
    if( $("select[name=fcmbIdMedico]").val() == "" || $("select[name=fcmbIdMedico]").val() == null )
    {
        toastr.clear();
        toastr.warning("Debe seleccionar un médico en el filtro de búsqueda para cargar la programación por día", "");
        return;
    }

    cargarProgramacionDia();
}

// muestra la programacion del medico en el calendario
function renderProg( data )
{
    clearProg();
    data.forEach( (item, index ) =>{
        $('.dia-icon-'+item.dia ).addClass('glyphicon glyphicon-calendar');
        $('.dia-programacion-'+item.dia ).html(' ('+item.Programacion.length+')');
        $('.dia-programacion-'+item.dia ).prop('title',item.Resumen+'');
        $('.prog-index-'+item.dia ).val( index );
    } );
}

// Limpia datos de una programacion en el calendario
function clearProg(){
    $('.prog-index').each( function() { $(this).val('') });
    $('.dia-icon').each( function() { $(this).removeClass('glyphicon glyphicon-calendar') });
    $('.dia-programacion').each( function() { $(this).html('') });
}


