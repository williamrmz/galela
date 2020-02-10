
var model="citasAdmision";

//almacena datos de la programacion de un medico en el front 
var programacion = [];

$(function(){

    getConfig();
    
});

function calClick( btn ){
    
    $('.btn-dia').each( function() {  $(this).removeClass('btn-warning'); });
    btn.addClass('btn-warning');

    // let dia = JSON.parse( btn.find('input.dia-data').val() );
    let indexProg = btn.find('input.prog-index').val();

    showPacientes( indexProg );

    renderCitas( indexProg );

    // getProgramacion(0, 0);
}

// Obtiene 42 dias de acuerdo al mes y anio
function getCalendario()
{
    let fecha = '01-'+$('#cmbMes').val()+'-'+$('#cmbAnio').val();
    $.ajax({
        data: { fecha }, url: getPathCtrl()+'/api/service?name=getCalendario',
        type:  'GET', dataType: 'json',
        success:  function (response) {
           renderDias( response );
           clearPacientes();
        }
    });
}

// Dibuja la tabla con 42 configurada para el mes y anio
function renderDias( calendario )
{

    html = '';
    let loop = 1;
    calendario.dias.forEach(item => {

        // console.log( item );
        if( loop == 1) html += '<tr>';
        
        html += '<td style="padding:0" align="center">';
            if( item.valido ){
            html += '<div class="btn btn-default btn-block btn-dia" style="padding:1px;">';
                    html += '<input type="hidden" class="dia-data" value=\''+JSON.stringify(item)+'\'>';
                    html += '<input type="hidden" class="prog-index prog-index-'+item.dia+'" value="">';
                    html += '<table >';
                        html += '<tr height="22px;">';
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
    } );
}

// Limpia datos de una programacion en el calendario
function clearProg(){
    $('.prog-index').each( function() { $(this).val('') });
    $('.dia-icon').each( function() { $(this).removeClass('glyphicon glyphicon-time') });
    $('.dia-citas').each( function() { $(this).html('') });
}

function getConfig()
{
    $.ajax({
        data: {}, url: getPathCtrl()+'/api/service?name=getConfig',
        type:  'GET', dataType: 'json',
        success:  function (response) {

            $('#cmbAnio').select2({ data: response.anios });
            $('#cmbAnio').val( parseInt(response.anio_actual) ).trigger('change');

            $('#cmbMes').select2({ data: response.meses });
            $('#cmbMes').val( parseInt(response.mes_actual) ).trigger('change');

            let serviciosData = JSON.parse( JSON.stringify(response.servicios)); 
            serviciosData.unshift({ id: '', text: 'Seleccione...' } );
            $('#cmbServicios').select2({ data: serviciosData });

            $('#cmbServicios').change( function() {
                clearProg();
                clearPacientes();
                clearBtnDia();
                let idServicio = $(this).val();
                if( idServicio != '' ) getMedicos( idServicio );
            })

            $('#cmbAnio').change( () => {
                getServicios();
                getCalendario();
            });
            $('#cmbMes').change( () => {
                getServicios();
                getCalendario();
            });

            renderDias( response.calendario );
        }
    });
}

function clearBtnDia(){
    $('.btn-dia').each ( function () {
        $(this).removeClass('btn-warning') ;
    });
}

function getServicios( idServicio, idMedico)
{
    let fecha = '01-'+$('#cmbMes').val()+'-'+$('#cmbAnio').val();
    $.ajax({
        data: { fecha }, url: getPathCtrl()+'/api/service?name=getServicios',
        type:  'GET', dataType: 'json',
        success:  function (response) {
            let serviciosData = JSON.parse( JSON.stringify( response) ); 
            serviciosData.unshift({ id: '', text: 'Seleccione...' } );
            $('#cmbServicios').html ('').select2({ data: serviciosData });
            $("#tbody-medicos").html( '<tr> <td colspan="3" align="center">Sin resultados</td> </tr>' );
        }
    });
}

function getMedicos( idServicio )
{
    let fecha = '01-'+$('#cmbMes').val()+'-'+$('#cmbAnio').val();
    $.ajax({
        data: { fecha, idServicio }, url: getPathCtrl()+'/api/service?name=getMedicos',
        type:  'GET', dataType: 'json',
        success:  function (response) {
            html = '';
            if( response.length > 0){
                response.forEach( item => {
                    html += '<tr>';
                        html += '<td>'+item.medico+'</td>';
                        html += '<td>'+item.horaInicio+' - '+item.horaFin+'</td>';
                        html += '<td>';
                            html += '<input type="hidden" value=\''+JSON.stringify(item)+'\'>';
                            html += '<input type="radio" name="medicoSeleccionado" value="1">';
                        html += '</td>';
                    html += '/<tr>';
                    
                });
                $("#tbody-medicos").html( html );

                $('input[name="medicoSeleccionado"]').change( function() {
                    let medico = JSON.parse( $(this).siblings('input').val() );
                    getProgramacion( idServicio, medico.idMedico );
                    clearBtnDia();
                    clearPacientes();
                })

                
            }
        }
    });
}

function getProgramacion( idServicio, idMedico)
{
    let fecha = '01-'+$('#cmbMes').val()+'-'+$('#cmbAnio').val();
    $.ajax({
        data: { fecha, idServicio, idMedico }, url: getPathCtrl()+'/api/service?name=getProgramacion',
        type:  'GET', dataType: 'json',
        success:  function (response) {
            programacion = JSON.parse(JSON.stringify(response));
            
            renderProg( response );
        }
    });
}

// Muestra los pacientes en cita para un dia
function showPacientes( index )
{
    let atenciones = index != ''? JSON.parse( JSON.stringify(programacion[index].atenciones)): [];

    html = '';

    if( atenciones.length > 0 ){
        atenciones.forEach( item => {
            html += '<tr>';
                html += '<td>'+item.horaInicio+'</td>';
                html += '<td>'+item.horaFin+'</td>';
                html += '<td>'+item.apellidoMaterno+'</td>';
                html += '<td>'+item.apellidoPaterno+'</td>';
                html += '<td>'+item.primerNombre+'</td>';
                html += '<td>'+item.fechaSolicitud+'</td>';
                html += '<td>'+item.horaSolicitud+'</td>';
            html += '</tr>';
        });

    }else{
        html += '<tr> <td colspan="7" align="center">Sin resultados</td></tr>';
    }
    
    $('.tbody-pacientes').html( html );
}

function clearPacientes()
{
    this.programacion = [];
    showPacientes('');
}

function getPathCtrl()
{
    return $("input[name='"+model+"-path-ctrl']").val();
}

//dibuja la tabla de citas cada ves que se eleccionda un dia de programacion
function renderCitas( index ){
    let data = index != ''? JSON.parse( JSON.stringify(programacion[index])): [];

    if( data.length == 0 ){
        $('.tbody-citas').html('<tr><td colspan="2" align="center">Sin programacion</td></tr>');
        return;
    }
    let tiempoPromedio = parseInt(data.tiempoPromedioAtencion);
    let tiempoBase = 5;
    
    minutoi = horasAMinunos(data.horaInicio);
    minutof = horasAMinunos(data.horaFin);

    
    periodos = (minutof - minutoi) / tiempoPromedio;

    let horas = [ minutosAHoras(minutoi) ];
    while( minutoi  <  minutof){
        minutoi += tiempoBase;
        horas.push( minutosAHoras(minutoi) );
    }

    let tbase = 0; //

    let filas = [];
    let fila = [];
    let indexRow  = 0;
    for( let i in horas){
        if( tbase == 0)  fila = [];

        fila.push( horas[i] );

        tbase += tiempoBase;

        if( tbase >= tiempoPromedio){
            indexRow++;
            filas.push( {
                index: indexRow<10? '0'+indexRow: ''+indexRow,
                horas: fila,
            });
            tbase = 0;
        }
    }

    // Dibujar rows
    html = '';
    for( let i in filas){
        html += '<tr>';
            html += '<td class="bg-gray"> <table align="center">';
            let horas = filas[i].horas;
            for(let j in horas){
                html += '<tr><td>'+horas[j]+'</td><tr>';
            }
            html += '</table></td>';
            html += '<td>'+ filas[i].index+' </td>';
        html += '</tr>';
    }

    $('.tbody-citas').html(html);
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

