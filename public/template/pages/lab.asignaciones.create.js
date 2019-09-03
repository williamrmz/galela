

$(function(){
    // $(".input-cant-enviar").numeric();

    
    $("#my-form").submit( function (e) {
        e.preventDefault();
        store();
    });

    $(".btn-calcular-consumo").click( function (e) {
        e.preventDefault();
        openBuscarCodigos();
        $(this).blur();
    });

    $(".btn-limpiar-consumo").click (function(e) {
        e.preventDefault();
        let consumos = $(".input-cant-consumida");
        consumos.each( function() {
            tr = $(this).closest("tr");
            inputSaldo = tr.find(".input-saldo");
            inputConsumo = tr.find(".input-cant-consumida");
            inputEnvio = tr.find(".input-cant-enviar");
            inputConsumo.val(inputSaldo.val());
            inputEnvio.val(0);
            inputEnvio.css("color","inherit");
        });
        $(this).blur();
    });


    $(".responsable-btn-open-buscar").click( function (e) {
        e.preventDefault();
        verResponsables(1, true);
    });

    $(".responsable-btn-buscar").click( function (e) {
        e.preventDefault();
        verResponsables();
    });

    $(".responsable-btn-limpiar").click( function (e) {
        e.preventDefault();
        $("#responsable-form-buscar").trigger('reset');
        verResponsables();
    });

    showResponsable();
    $("#almacenId").change( function (e) {
        showResponsable();
    });

    $(".btn-enviar").click( function(e) {
        e.preventDefault();
        $("#my-form").submit();
    });

    $(".input-cant-enviar").change( function () {
        calTotal($(this));
    });

    $(".btn-clear-select").click( function(e) {
        e.preventDefault();
        $(this).siblings('select').empty();
    });

    $("#IdResponsable").select2({
        ajax: {
            delay: 500,
            url: basePath+'/api?service=getLabEmpleados',
            data: function (params) {
                var query = {
                    search: params.term,
                    page: params.page || 1
                }
                return query;
            },

            processResults: function (response) {
                console.log(response);
                elements = [];
                response.data.forEach(element => {
                    elements.push({
                        id: element.idEmpleado,
                        text: element.nombres+' '+element.apellidoPaterno+' '+element.apellidoMaterno,
                        dni: element.dni,
                    })
                });
                return {
                    results: elements,
                    pagination: {
                        more: response.current_page < response.last_page,
                    },
                };
            },
            cache: true,
        },
        placeholder: 'Seleccione un responsable',
        escapeMarkup: function (markup) { return markup; },
        minimumInputLength: 0,
        templateResult: formatRepoEmpleado,
        templateSelection: formatRepoSelectionEmpleado,
    });
});

function store()
{
    url = getPathCtrl();
    params  = $("#my-form").serialize();
    $.ajax({
        data: params, url: url,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            console.log(response);
            if(response.status){
                toastr.success(response.message, 'Success');
                window.location.href = basePath+'/laboratorio/insumos/asignaciones/create';
            }else{
                toastr.error(response.message, 'Error');
            }
            
        }
    });
}

function serachConsumos(codigos, rangoFecha){
    console.log(codigos, rangoF)
}

function showResponsable()
{
    if( $("#almacenId").val() == 13 ){
        $(".responsable-lab").show();
    }else if( $("#almacenId").val() == 12 ){
        $(".responsable-lab").hide();
    }
}

function verResponsables(page=1, openModal=false)
{
    url = getPathCtrl()+'/partial/responsables';
    params  = $("#responsable-form-buscar").serialize();
    params += "&page="+page;

    $.ajax({
        data: params, url: url,
        type:  'GET', dataType: 'html',
        success:  function (response) {
            console.log(response);
            if(openModal){
                $("#modal-responsables-title").html('Buscar Empleados');
                $("#modal-responsables").modal('show');
            }

            $("#modal-responsables-results").html(response);

            $(".responsables-paginator .pagination a").click( function (e) {
                e.preventDefault();
                $('.firma-paginator li').removeClass('active');
                $(this).parent('.firma-paginator li').addClass('active');
                let page=$(this).attr('href').split('page=')[1];
                verResponsables(page);
            })

            $(".responsable-btn-select").click( function (e) {
                e.preventDefault();
                responsable = $(this).siblings('input').val();
                respansable = JSON.parse(responsable);
                seleccionarResponsable(respansable);
            });

        }
    });
}

function seleccionarResponsable(responsable)
{
    fullname = responsable.Nombres+' '+responsable.ApellidoPaterno+' '+responsable.ApellidoMaterno;
    $("#responsableFullname").val(fullname);
    $("#responsableId").val(responsable.IdEmpleado);
    $("#modal-responsables").modal('hide');
}

function getPathCtrl()
{
    url = $("input[name='InsumoAsignacionController']").val();
    return url;
}

function calTotal(inputCantEnviar)
{
    tr = inputCantEnviar.closest("tr");
    inputSaldo = tr.find(".input-saldo");
    inputCantConsumida = tr.find(".input-cant-consumida");
    inputPrecio = tr.find(".input-precio");
    inputTotal = tr.find(".input-total");

    saldo = inputSaldo.val();
    cantConsumida = inputCantConsumida.val();
    cantEnviar = inputCantEnviar.val();
    precio = inputPrecio.val();
    total = inputTotal.val();

    cantConsumida = saldo - cantEnviar;
    if(cantConsumida < 0 || cantEnviar.length == 0) {
        cantConsumida = saldo;
        cantEnviar = 0;
    }
    total = parseFloat(cantEnviar * precio).toFixed(2);
    inputCantConsumida.val( cantConsumida );
    inputCantEnviar.val( cantEnviar );
    inputTotal.val( total );

    if( cantEnviar < 0 ){
        inputCantEnviar.css("color","red");
    }else{
        inputCantEnviar.css("color","inherit");
    }
}

// SELECT 2 CONFIG
function formatRepoEmpleado (repo) {
    if (repo.loading) {
        return repo.text;
    }

    var markup = "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" + repo.text + "</div>";

    if (repo.description) {
        markup += "<div class='select2-result-repository__description'>" + 'hola.' + "</div>";
    }

    markup += "<div class='select2-result-repository__statistics'>" +
        "<div class='select2-result-repository__watchers'><b>DNI:</b> " + repo.dni + "</div>" +
    "</div>" +
    "</div></div>";

    return markup;
}

function formatRepoSelectionEmpleado (repo) {
    return repo.text;
}

function openBuscarCodigos()
{
    url = getPathCtrl()+'/partial/modal-consumos';
    params  = null;
    $.ajax({
        data: params, url: url,
        type:  'GET', dataType: 'html',
        success:  function (response) {
            // console.log(response);
            $("#modalConsumos").modal('show');
            $("#modalConsumosTitle").html('Buscar consumos');
            $("#modalConsumosBody").html(response);

            $("#form-serach-consumos").submit( function (e) {
                e.preventDefault();
                buscarConsumos();
            });

            let dataRange = getDateRange();

            $('#rangoFecha').daterangepicker({
                startDate: dataRange.desde,
                endDate: dataRange.hasta,
                timePicker: true,
                timePicker24Hour: true,
                autoUpdateInput: false,
                timePickerIncrement: 1,
                locale: {
                    format: 'DD/MM/YYYY HH:mm',
                    daysOfWeek: [ 'Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa' ],
                    monthNames: [
                        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ],
                    applyLabel: 'Aceptar',
                    cancelLabel: 'Cancelar',
                    fromLabel: 'Desde',
                    toLabel: 'Hasta',
                }
            });

            $('#rangoFecha').on('apply.daterangepicker', function(ev, picker) {
                rango = ''
                desde = picker.startDate.format('DD/MM/YYYY HH:mm');
                hasta = picker.endDate.format('DD/MM/YYYY HH:mm');
                rango = desde + ' - ' + hasta;
                $('#rangoFecha').val(rango);
            });

            $('#rangoFecha').on('cancel.daterangepicker', function(ev, picker) {
                $('#rangoFecha').val('');
            });

            $(".btn-pull-consumos").click( function(e) {
                e.preventDefault();
                setAutoCalculo();
                $("#modalConsumos").modal('hide');
            })

            $("#rangoFecha").val(dataRange.rango);
        }
    });
}

function buscarConsumos()
{
    productoCodigos = [];
    $(".input-codigo").each( function() {
        productoCodigos.push($(this).val());
    });

    url = getPathCtrl()+'/partial/tbody-consumos';
    params  = {
        codigos: productoCodigos,
        rangoFecha: $("#rangoFecha").val()
    }

    $.ajax({
        data: params, url: url,
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $("#tbody-consumos").html(response);
        }
    });
}

function setAutoCalculo()
{
    consumosLab = [];
    $('.consumos-lab').each ( function () {
        consumosLab.push( JSON.parse($(this).val()) );
    });
    // console.log(consumosLab);

    $('.input-codigo').each( function() {
        inputCodigo = $(this);
        let found = false;
        tr = inputCodigo.closest("tr");
        inputSaldo = tr.find(".input-saldo");
        inputConsumo = tr.find(".input-cant-consumida");
        inputEnvio = tr.find(".input-cant-enviar");

        cantConsumoLab = 0;
        for (i in consumosLab){
            if( $.trim(consumosLab[i].codigo) == inputCodigo.val() ){
                // cantConsumoLab = parseFloat(consumosLab[i].cantidad) + 3.263;
                cantConsumoLab = parseFloat(consumosLab[i].cantidad);
                console.log(cantConsumoLab);
                break;
            }
        }

        cantConsumoLab = parseFloat(cantConsumoLab).toFixed(0);
        cantEnvio = parseFloat(inputSaldo.val() - cantConsumoLab).toFixed(0);

        inputConsumo.val(cantConsumoLab);
        inputEnvio.val(cantEnvio );
        if( cantEnvio < 0 ){
            inputEnvio.css("color","red");
        }else{
            inputEnvio.css("color","inherit");
        }
    });
}

function getDateRange()
{
    let data = { desde: null, hasta: null };

    now =  new Date();
    y = now.getFullYear();
    m = now.getMonth() + 1;
    d = now.getDate();
    h = now.getHours();

    h = (h < 19)? 7: 19
    now.setHours(h);

    m = ('0'+m).slice(-2);
    d = ('0'+d).slice(-2);
    h = ('0'+h).slice(-2);
    desde = d+"/"+m+"/"+y+' '+h+':00';

    now.setHours(now.getHours()+12);
    y = now.getFullYear();
    m = now.getMonth() + 1;
    d = now.getDate();
    h = now.getHours();
    m = ('0'+m).slice(-2);
    d = ('0'+d).slice(-2);
    h = ('0'+h).slice(-2);
    hasta = d+"/"+m+"/"+y+' '+h+':30';

    data.desde = desde;
    data.hasta = hasta;
    data.rango = desde+' - '+hasta;
    return data;
}