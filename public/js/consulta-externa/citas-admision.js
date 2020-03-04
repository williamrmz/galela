var fechaSeleccion = "";
var CONFIG_IDMEDICO = "";

//almacena datos de la programacion de un medico en el front
var programacion = [];

$(function()
{
    ajaxConfig();
    initConfiguracionCita();
    initEventos();

});

function initConfiguracionCita()
{
    $.ajax({
        data: {}, url: url+'/api/service?name=getConfig',
        type:  'GET', dataType: 'json',
        success:  function (response)
        {
            let serviciosData = response.servicios;
            serviciosData.unshift(opcionBlanco);
            $('select[name=cmbIdServicio]').select2({ data: serviciosData });
            renderizarCalendario( response.calendario);
        }
    });
}

function getAtencionesDias()
{
    idServicio = $("select[name=cmbIdServicio]").val();
    idMedico = CONFIG_IDMEDICO;
    fecha = fechaSeleccion;

    if(idServicio == "" || idMedico == "" || fecha == "")
    {
        toastr.clear();
        toastr.error("No se puede listar las atenciones del día debido a que no se ha indicado fecha, médico o servicio");
        return;
    }

    $.ajax({
        data: {idServicio, idMedico, fecha}, url: url+'/api/service?name=getAtencionesDia',
        type:  'GET', dataType: 'html',
        success:  function (response)
        {
            $(".atenciones-cronograma-dia").html(response);
            getListaPacientesDia();
        }
    });
}

function getListaPacientesDia()
{
    idServicio = $("select[name=cmbIdServicio]").val();
    idMedico = CONFIG_IDMEDICO;
    fecha = fechaSeleccion;

    if(idServicio == "" || idMedico == "" || fecha == "")
    {
        toastr.clear();
        toastr.error("No se puede listar las atenciones del día debido a que no se ha indicado fecha, médico o servicio");
        return;
    }

    $.ajax({
        data: {idServicio, idMedico, fecha}, url: url+'/api/service?name=getListaPacientesDias',
        type:  'GET', dataType: 'html',
        success:  function (response)
        {
            $(".atenciones-listado-dia").html(response);
        }
    });
}

function cargarComboServicios()
{
    let mes = $("select[name=cmbMes]").val();
    let anio = $("select[name=cmbAnio]").val();
    let fecha = '01-'+mes+'-'+anio;
    $.ajax({
        data: { fecha: fecha }, url: url+'/api/service?name=getServicios',
        type:  'GET', dataType: 'json',
        success:  function (response)
        {
            let serviciosData = JSON.parse( JSON.stringify( response) );
            serviciosData.unshift({ id: '', text: 'Seleccione...' } );
            $('select[name=cmbIdServicio]').html ('').select2({ data: serviciosData });
            $("#tbody-medicos").html( '<tr> <td colspan="2" align="center">Sin resultados</td> </tr>' );
        }
    });
}

function getCalendario()
{
    let mes = $("select[name=cmbMes]").val();
    let anio = $("select[name=cmbAnio]").val();
    let fecha = '01-'+mes+'-'+anio;

    $.ajax({
        data: { fecha }, url: url+'/api/service?name=getCalendario',
        type:  'GET', dataType: 'json',
        success:  function (response) {
            renderizarCalendario( response );
            renderizarCalendario( response );
            limpiarProgramacion();
        }
    });
}

function getMedicos()
{
    let idServicio = $("select[name=cmbIdServicio]").val();

    if(idServicio == "")
    {
        console.error(":: E :: getMedicos no ha podido ejecutarse por no disponer de idServicio");
        return;
    }

    let mes = $("select[name=cmbMes]").val();
    let anio = $("select[name=cmbAnio]").val();
    let fecha = '01-'+mes+'-'+anio;

    $.ajax({
        data: { fecha, idServicio }, url: url+'/api/service?name=getMedicos',
        type:  'GET', dataType: 'json',
        success:  function (response) {
            html = '';
            if( response.length > 0)
            {
                for(let i = 0; i<response.length; i++)
                {
                    let item = response[i];
                    html += '<tr>';
                    html += '<td>'+item.medico+'</td>';
                    html += '<td>';
                    html += '<input type="hidden" value=\''+JSON.stringify(item)+'\'>';
                    html += '<input type="radio" name="medicoSeleccionado" value="1" id="idmedico-'+item.IdMedico+'">';
                    html += '</td>';
                    html += '/<tr>';
                }

                $("#tbody-medicos").html( html );

                if(response.length==1)
                {
                    let item = response[0];
                    $("#idmedico-"+item.IdMedico).click();
                }
            }
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
    dia = ('0'.repeat(2) + dia).slice(-2);

    // Construir fecha
    let anio = $("select[name=cmbAnio]").val();
    let mes = $("select[name=cmbMes]").val();
    let fecha = anio +"-"+ mes +"-"+ dia;
    fechaSeleccion = anio+"-"+mes+"-"+dia;

    // :: Verificar que haya seleccionado un medico para cargar la programacion del dia
    getAtencionesDias();

    let indexProg = btn.find('input.prog-index').val();
}

// Dibuja la tabla con 42 configurada para el mes y anio
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
            html += '<span class="dia-citas dia-citas-'+item.dia+'"></span>';
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
}

// muestra la programacion del medico en el calendario
function renderProg( data )
{
    clearProg();
    data.forEach( (item, index ) =>{
        $('.dia-icon-'+item.dia ).addClass('glyphicon glyphicon-time');
        $('.dia-citas-'+item.dia ).html('('+item.atenciones.length+')');
        $('.prog-index-'+item.dia ).val( index );
        console.log("ATENCIONES", item.atenciones.length);
    } );
}

// Limpia datos de una programacion en el calendario
function clearProg()
{
    $('.prog-index').each( function() { $(this).val('') });
    $('.dia-icon').each( function() { $(this).removeClass('glyphicon glyphicon-time') });
    $('.dia-citas').each( function() { $(this).html('') });
}

function initConfiguracionCita()
{
    $.ajax({
        data: {}, url: url+'/api/service?name=getConfig',
        type:  'GET', dataType: 'json',
        success:  function (response)
        {
            let serviciosData = response.servicios;
            serviciosData.unshift(opcionBlanco);
            $('select[name=cmbIdServicio]').select2({ data: serviciosData });
            renderizarCalendario( response.calendario);
        }
    });
}

function clearBtnDia(){
    $('.btn-dia').each ( function () {
        $(this).removeClass('btn-warning') ;
    });
}





function initEventos()
{
    $("body").on("change", 'input[name="medicoSeleccionado"]', function ()
    {
        let medico = JSON.parse( $(this).siblings('input').val() );
        CONFIG_IDMEDICO = medico.IdMedico;
        getProgramacion();
        getAtencionesDias();
        limpiarProgramacion();
    });

    // Cuando cambia comobo de servicios
    $('select[name=cmbIdServicio]').change( function() {
        clearProg();
        limpiarProgramacion();
        getMedicos();
    })

    // Cuando cambia año
    $("select[name=cmbAnio]").change(function () {
        cargarComboServicios();
        getCalendario();
    });

    // Cuando cambia mes
    $("select[name=cmbMes]").change(function () {
        cargarComboServicios();
        getCalendario();
    });
}

function getProgramacion()
{
    idServicio = $("select[name=cmbIdServicio]").val();
    idMedico = CONFIG_IDMEDICO;

    $.ajax({
        data: { fecha: fechaSeleccion, idServicio, idMedico }, url: url+'/api/service?name=getProgramacion',
        type:  'GET', dataType: 'json',
        success:  function (response)
        {
            renderProg(response);
        }
    });
}

function limpiarProgramacion()
{
    this.programacion = [];
    html = '<tr> <td colspan="7" align="center">Sin resultados</td></tr>';
    $('.tbody-atenciones-listado-dia').html( html );
    html = '<tr> <td colspan="3" align="center">Sin resultados</td></tr>';
    $('.tbody-atenciones-cronograma-dia').html( html );

}

function horasAMinunos( hora )
{
    horaArray = hora.split(':');
    minutos = ( parseInt(horaArray[0]) * 60 ) + parseInt(horaArray[1]);
    return minutos;
}

function minutosAHoras( minutos )
{
    horas = parseInt(minutos / 60);
    min = minutos % 60;
    if (min < 10 ) min = '0'+min;
    hora = horas+':'+min;
    return hora;
}

